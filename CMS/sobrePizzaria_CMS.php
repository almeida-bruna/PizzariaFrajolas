<?php

//a session é responsavel por dar o ok na pagina home e encaminha a 
//pagina cms
    session_start();
//chamando o caminho do banco de dados
    require_once('modulo.php');
//conexao com o banco de dados
    Conexao_Database();

$trava_conteudo = "";
$trava_fale_conosco = "";
$trava_produto = "";
$trava_usuarios = "";

$nome1=null;
$nome2=null;
$texto1=null;
$texto2=null;
$texto3=null;
$texto4=null;
$texto5=null;
$texto6=null;
$texto7=null;

$botao = "Salvar";


if($_SESSION['idNivelUsuario'] != 0){
    
    $sql = "SELECT * FROM tbl_nivel WHERE idNivel = ".$_SESSION['idNivelUsuario'];
    $select = mysql_query($sql);
    $rsN = mysql_fetch_array($select);
    $conteudo = $rsN['conteudo'];
    $f_c = $rsN['faleConosco'];
    $produto = $rsN['produtos'];
    $usuario = $rsN['usuario'];
    
    if($conteudo == 1)
    {
        $trava_conteudo = " href='cms.php' ";
    }else{
        $trava_conteudo = "";
    }
    
    if($f_c == 1)
    {
        $trava_fale_conosco = " href='faleConoscoAdm.php' ";
    }else{
        $trava_fale_conosco = "";
    }
    
    if($produto == 1)
    {
        $trava_produto = " href='produtos_CMS.php' ";
    }else{
        $trava_produto = "";
    }
    
    if($usuario == 1)
    {
        $trava_usuarios = " href='usuarios.php' ";
    }else{
        $trava_usuarios = "";
    }
}

if(isset($_GET['modo'])){
    
    $modo = $_GET['modo'];
    
    $id=$_GET['id'];
    
    if($modo=='excluir'){
        
        $sql = "delete from tbl_sobrepizzaria where id=".$id;
        
        mysql_query($sql);
        
        header('location:sobrePizzaria_CMS.php');
        
    }else if($modo=='ativar'){
         
        $sql="update tbl_sobrepizzaria set ativar='".$modo."'where id='".$id."'";
        
        mysql_query($sql);

        header('location:sobrePizzaria_CMS.php');
        
    }else if($modo=='editar'){
        
        $botao = 'Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_sobrepizzaria where id=".$id;
        
        $select = mysql_query($sql);
        
        if($rs = mysql_fetch_array($select)){
            $nome1=$rs['nome1'];
            $nome2=$rs['nome2'];
            $upload_file1=$rs['imagem1'];
            $upload_file2=$rs['imagem2'];
            $texto1=$rs['texto1'];
            $texto2=$rs['texto2'];
            $texto3=$rs['texto3'];
            $texto4=$rs['texto4'];
            $texto5=$rs['texto5'];
            $texto6=$rs['texto6'];
            $texto7=$rs['texto7'];
            
        }
    } 
}

if(isset($_POST['btnsalvar'])){
    
    $nome1=$_POST['txtnome1'];
    $nome2=$_POST['txtnome2'];
    $texto1=$_POST['texto1'];
    $texto2=$_POST['texto2'];
    $texto3=$_POST['texto3'];
    $texto4=$_POST['texto4'];
    $texto5=$_POST['texto5'];
    $texto6=$_POST['texto6'];
    $texto7=$_POST['texto7'];
    
    $upload_dir="arquivo/";
    
    $nome_arq1 = basename($_FILES['flefoto1']['name']);
	$nome_arq2 = basename($_FILES['flefoto2']['name']);
    
    if(strstr($nome_arq1,'.jpg') || strstr($nome_arq1,'.png') || strstr($nome_arq1,'.gif' ||
		$nome_arq2,'.jpg') || strstr($nome_arq2,'.png') || strstr($nome_arq2,'.gif')){
        
        $extensao1 = substr($nome_arq1,strpos($nome_arq1,"."),5);
        $prefixo1 = substr($nome_arq1,0,strpos($nome_arq1,"."));
        $nome_arq1 = md5($prefixo1).$extensao1;
		
		$extensao2 = substr($nome_arq2,strpos($nome_arq2,"."),5);
        $prefixo2 = substr($nome_arq2,0,strpos($nome_arq2,"."));
        $nome_arq2 = md5($prefixo2).$extensao2;
        
        $upload_file1 = $upload_dir . $nome_arq1;
		$upload_file2 = $upload_dir . $nome_arq2;
        
        if(move_uploaded_file($_FILES['flefoto1']['tmp_name'], $upload_file1)){
            
            if(move_uploaded_file($_FILES['flefoto2']['tmp_name'], $upload_file2)){
                
                if($_POST["btnsalvar"]=='Salvar'){
                
                $sql="insert into tbl_sobrepizzaria(nome1,imagem1,nome2,imagem2,
                texto1,texto2,texto3,texto4,texto5,texto6,texto7)values('".$nome1."','".$upload_file1."','".$nome2."','".$upload_file2."','".$texto1."',
                '".$texto2."','".$texto3."','".$texto4."','".$texto5."','".$texto6."','".$texto7."')";
                
            }else if($_POST["btnsalvar"]=='Atualizar'){
                        $sql="update tbl_sobrepizzaria set                nome1='".$nome1."',imagem1='".$upload_file1."',
                             nome2='".$nome2."',imagem2='".$upload_file2."',
                            texto1='".$texto1."',texto2='".$texto2."',texto3='".$texto3."',
                            texto4='".$texto4."',texto5='".$texto5."',texto6='".$texto6."',
                            texto7='".$texto7."' where id=".$_SESSION['id'];
            }
                mysql_query($sql);
                //echo($sql);
                header('location:sobrePizzaria_CMS.php');
                
            }
        }
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Sobre a Pizzaria CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_sobrePizzariaCMS.css"/>
		
    </head>
	
    <body>
        <!-- Pricipal responsavel por conter o cabeçalho, menu, corpo e roda pé -->
        <div id="principal">
            <!-- CABEÇALHO-->
            <header>
				<div id="titulo">
					<strong>CMS</strong> - Sistema de Gerenciamento do Site
				</div>
				
				<div id="logo">
					<img id="imagem-logo" alt="log" src="Imagens/logo.png"/>
				</div>
            </header>
            <!-- MENU -->
            <nav>
				<div id="menu">
					<div id="cont-imagens">
						<div class="caixinhas">
							<img class="imagem-caxinha" alt="log" src="Imagens/Apple%20Script.png"/>
						</div>

						<div class="caixinhas">
							<img class="imagem-caxinha" alt="log" src="Imagens/faleConosco.ico"/>
						</div>

						<div class="caixinhas">
							<img class="imagem-caxinha" alt="log" src="Imagens/iconPizza.png"/>
						</div>

						<div class="caixinhas">
							<img class="imagem-caxinha" alt="log" src="Imagens/users.png"/>
						</div>
					</div>
					
					<div id="cont-rotulos">
                        <a <?php echo($trava_conteudo) ?>>
						<div class="rotulos">
							Adm. Conteúdo
						</div>
                        </a>
						
                        <a <?php echo($trava_fale_conosco) ?>>
						<div class="rotulos">
							Adm. Fale Conosco
						</div>
                        </a>
                        
                        <a <?php echo($trava_produto) ?>>
						<div class="rotulos">
							Adm. Produtos
						</div>
                        </a>
						
						<a <?php echo($trava_usuarios) ?>> <div class="rotulos">
							Adm. Usuarios
                        </div>
						</a>
					</div>
				</div>
				
				<div id="user">
					<div id="bemVindo">
						Bem vindo, <?php echo($_SESSION['nomeUsuario']);?>
					</div>
					
					<a href="../home.php">
					<div id="logout">
						Logout
					</div>
					</a>	
				
				</div>
            </nav>
            
            <div id="main">
				<div class="conteiner1">
					<div id="titol">Sobre a pizzaria</div>
					
				</div>
				
				<div class="conteiner2">
                    <div id="cad">
                        <form name="frmupload" method="post" enctype="multipart/form-data" action="sobrePizzaria_CMS.php">
                            <div class="parte1">
                                <br><div class="caixa">Nome da foto1</div><input class="caixa" type="text" name="txtnome1" value="<?php echo($nome1) ?>" maxlength="190"/>
                                
                                <div class="caixa">Escolha a Foto1:</div><input class="caixa" type="file" name="flefoto1" value="<?php echo($upload_file1) ?>"><br><br>
                                
                                <div class="caixa">Nome da foto2</div><input class="caixa" type="text" name="txtnome2" value="<?php echo($nome2) ?>" maxlength="190"/>
                                
                                <div class="caixa">Escolha a Foto2:</div><input class="caixa" type="file" name="flefoto2" value="<?php echo($upload_file2) ?>"><br><br>
                                
                                <div class="caixa">Texto1:</div><input
                                class="caixa" name="texto1" type="text" value="<?php echo($texto1)?>"/><br><br>
                                
                                <div class="caixa">Texto2:</div><input
                                class="caixa" name="texto2" type="text" value="<?php echo($texto2) ?>" maxlength="500"/><br><br>
                            </div>
                            
                            <div class="parte2">
                                <br><div class="caixa">Texto3:</div><input
                                class="caixa" name="texto3" type="text" value="<?php echo($texto3) ?>"
																		   maxlength="500"/>
                                
                                <div class="caixa">Texto4:</div><input
                                class="caixa" name="texto4" type="text" value="<?php echo($texto4) ?>"
																	   maxlength="500"/>
                                
                                <div class="caixa">Texto5:</div><input
                                class="caixa" name="texto5" type="text" value="<?php echo($texto5) ?>"
																	   maxlength="500"/>
                                
                                <div class="caixa">Texto6:</div><input
                                class="caixa" name="texto6" type="text" value="<?php echo($texto6) ?>"
																	   maxlength="500"/>
                                
                                <div class="caixa">Texto7:</div><input
                                class="caixa" name="texto7" type="text" value="<?php echo($texto7) ?>"
																	   maxlength="500"/>
                                
                            </div>
                            
                            <input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
                        </form>
                    </div>
				</div>
				
				<div class="conteiner3">
					<table id="tabela2">
                        <tr class="linha">
                            <td colspan="12" id="titulo2">
                                lista 
                            </td>
                        </tr>

                        <tr class="linha">
                            <td class="coluna">Imagem1</td>
                            
                            <td class="coluna">nome1</td>

                            <td class="coluna">Imagem2</td>
                            
                            <td class="coluna">texto1</td>
                            
                            <td class="coluna">texto2</td>
                            
                            <td class="coluna">texto3</td>
                            
                            <td class="coluna">texto4</td>
                            
                            <td class="coluna">texto5</td>
                            
                            <td class="coluna">texto6</td>
                            
                            <td class="coluna">texto7</td>

                            <td class="coluna">Opções</td>
                        </tr>
                        
                        <?php
                                $sql="select * from tbl_sobrepizzaria order by id desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){
                                    
                            ?>

                        <tr class="linha">
                            <td class="coluna"><img src="<?php echo($rs['imagem1'])?>" width="50" height="50"></td>
                            
                            <td class="coluna"><?php echo($rs['nome1'])?></td>

                            <td class="coluna"><img src="<?php echo($rs['imagem2'])?>" width="50" height="50"></td>
                            
                            <td class="coluna"><?php echo($rs['texto1'])?></td>
                            
                            <td class="coluna"><?php echo($rs['texto2'])?></td>
                            
                            <td class="coluna"><?php echo($rs['texto3'])?></td>
                            
                            <td class="coluna"><?php echo($rs['texto4'])?></td>
                            
                            <td class="coluna"><?php echo($rs['texto5'])?></td>
                            
                            <td class="coluna"><?php echo($rs['texto6'])?></td>
                            
                            <td class="coluna"><?php echo($rs['texto7'])?></td>

                            <td class="coluna">
                                <a href="sobrePizzaria_CMS.php?modo=ativar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/accept.png" alt="selecionado"/>
                                </a>
                                
                                <a href="sobrePizzaria_CMS.php?modo=editar&id=<?php echo($rs['id']) ?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="sobrePizzaria_CMS.php?modo=excluir&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/excluir.png" alt="excluir">
                                </a></td>
                        </tr>
                        
                         <?php 

                            }
                            ?>
                        
                    </table>
				</div>
            </div>
            
            <footer>
				Desenvolvido por Bruna Sousa
            </footer>
        </div>
    </body>
</html>