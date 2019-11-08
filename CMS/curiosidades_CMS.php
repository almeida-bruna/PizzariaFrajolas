<?php

	session_start();
//chamando o caminho do banco de dados
    require_once('modulo.php');
//conexao com o banco de dados
    Conexao_Database();

$trava_conteudo = "";
$trava_fale_conosco = "";
$trava_produto = "";
$trava_usuarios = "";


//definindo como a variavel deve vir
$nome1 = null;
$upload_file1 = null;
$nome2 = null;
$upload_file2 = null;
$nome3 = null;
$upload_file3 = null;

$botao = "Salvar";

$texto1 = null;
$texto2 = null;
$texto3 = null;
$texto4 = null;
$texto5 = null;
$texto6 = null;

$video = null;

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


//riando o if modo onde tera excluir,ativar e editar
if(isset($_GET['modo'])){
    
    $modo = $_GET['modo'];
    
    $id=$_GET['id'];
    
    if($modo=='excluir'){
        //selejct no banco para excluir
        $sql = "delete from tbl_curiosidade where id=".$id;
        //salvando no banco
        mysql_query($sql);
        //retornando para a pagina
        header('location:curiosidades_CMS.php');
    //modo ativa no site
    }else if($modo=='ativar'){
         
        $sql="update tbl_curiosidade set ativar='1' where id='".$id."'";
		
		//echo($sql);
        
        mysql_query($sql);

        header('location:curiosidades_CMS.php');
        
        //modo editar
    }else if($modo=='editar'){
        //botao atualizar para chamar o modo editar
        $botao = 'Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_curiosidade where id=".$id;
        
        $select = mysql_query($sql);
        //chamnd todas as variaveis possiveis de ediçao
        if($rs = mysql_fetch_array($select)){
            $upload_file1=$rs['imagem1'];
            $upload_file2=$rs['imagem2'];
            $upload_file3=$rs['imagem3'];
            $nome1=$rs['nome1'];
            $nome2=$rs['nome2'];
            $nome3=$rs['nome3'];
            $texto1=$rs['texto1'];
            $texto2=$rs['texto2'];
            $texto3=$rs['texto3'];
            $texto4=$rs['texto4'];
            $texto5=$rs['texto5'];
            $texto6=$rs['texto6'];
            $video=$rs['nomevideo'];
            
            
        }  
    }
}

//if para dar um insert no banco
if(isset($_POST['btnsalvar'])){
	
    //variaveis que sao os nomes das imagem
	$nome1=$_POST['txtnome1'];
	$nome2=$_POST['txtnome2'];
	$nome3=$_POST['txtnome3'];
    
    //variaveis que sao os nomes dos textos
    $texto1=$_POST["txtarea1"];
	$texto2=$_POST["txtarea2"];
	$texto3=$_POST["txtarea3"];
	$texto4=$_POST["txtarea4"];
	$texto5=$_POST["txtarea5"];
	$texto6=$_POST["txtarea6"];
    
    //variavel video
    $video=$_POST['txtnomevideo'];
    //para buscar a imagem na pasta arquivo
    $upload_dir="arquivo/";
    
    $nome_arq1 = basename($_FILES['flefoto1']['name']);
	$nome_arq2 = basename($_FILES['flefoto2']['name']);
	$nome_arq3 = basename($_FILES['flefoto3']['name']);
    
    //if para fazer o tratamento da extençao da imagem
    if(strstr($nome_arq1,'.jpg') || strstr($nome_arq1,'.png') || strstr($nome_arq1,'.gif' ||
		$nome_arq2,'.jpg') || strstr($nome_arq2,'.png') || strstr($nome_arq2,'.gif' ||
		$nome_arq3,'.jpg') || strstr($nome_arq3,'.png') || strstr($nome_arq3,'.gif')){
        
        $extensao1 = substr($nome_arq1,strpos($nome_arq1,"."),5);
        $prefixo1 = substr($nome_arq1,0,strpos($nome_arq1,"."));
        $nome_arq1 = md5($prefixo1).$extensao1;
		
		$extensao2 = substr($nome_arq2,strpos($nome_arq2,"."),5);
        $prefixo2 = substr($nome_arq2,0,strpos($nome_arq2,"."));
        $nome_arq2 = md5($prefixo2).$extensao2;
		
		$extensao3 = substr($nome_arq3,strpos($nome_arq3,"."),5);
        $prefixo3 = substr($nome_arq3,0,strpos($nome_arq3,"."));
        $nome_arq3 = md5($prefixo3).$extensao3;
		
        $upload_file1 = $upload_dir . $nome_arq1;
		$upload_file2 = $upload_dir . $nome_arq2;
		$upload_file3 = $upload_dir . $nome_arq3;
        
        //if para ver se as imagens foram selecionadas
            
        if(move_uploaded_file($_FILES['flefoto1']['tmp_name'], $upload_file1)){
			
			if(move_uploaded_file($_FILES['flefoto2']['tmp_name'], $upload_file2)){
				
				if(move_uploaded_file($_FILES['flefoto3']['tmp_name'], $upload_file3)){
					
					
                        if($_POST["btnsalvar"]=='Salvar'){
						
                            //insert no banco para salvar
						$sql="insert into tbl_curiosidade (imagem1,imagem2,
						imagem3,nome1,nome2,nome3,texto1,texto2,texto3,texto4,texto5,texto6,nomevideo)
						values ('".$upload_file1."','".$upload_file2."','".$upload_file3."','".$nome1."',
						'".$nome2."','".$nome3."','".$texto1."','".$texto2."','".$texto3."','".$texto4."',
                        '".$texto5."','".$texto6."','".$video."')";

						//update no banco para editar
						}else if($_POST["btnsalvar"]=='Atualizar'){
                        $sql="update tbl_curiosidade set imagem1='".$upload_file1."',
                            imagem2='".$upload_file2."',imagem3='".$upload_file3."',nome1='".$nome1."',nome2='".$nome2."',
                             nome3='".$nome3."',texto1='".$texto1."',texto2='".$texto2."',texto3='".$texto3."',texto4='".$texto4."',
                             texto5='".$texto5."',texto6='".$texto6."',nomevideo='".$video."' where id=".$_SESSION['id']
                        ;
                        }

                    }
                      mysql_query($sql);
						//echo($sql);
                      header('location:curiosidades_CMS.php');
						
			}
            
        }
    }
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Curiosidades CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_curiosidadesCMS.css"/>
		
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
				<div id="conteiner1">
					<div id="titol">Curiosidades</div>
					
				</div>
                
				<div id="conteiner2">
                    <div class="cad">
                        <form name="frmupload" method="post" enctype="multipart/form-data" action="curiosidades_CMS.php">
							
							<div class="caixa">Nome da foto1:</div><input class="caixa" type="text" name="txtnome1" value="<?php echo($nome1) ?>" maxlength="140" >
							
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto1" value="<?php echo($upload_file1) ?>"><br>
							
							<div class="caixa">Nome da foto2:</div><input class="caixa" type="text" name="txtnome2" value="<?php echo($nome2) ?>" maxlength="140">
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto2" value="<?php echo($upload_file2) ?>"><br>
							
							<div class="caixa">Nome da foto3:</div><input class="caixa" type="text" name="txtnome3"  value="<?php echo($nome3) ?>" maxlength="140">
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto3" value="<?php echo($upload_file3) ?>">
                            
                            <div class="caixa">Anos 60 Texto1</div>
							<input class="caixa" name="txtarea1" type="text" value="<?php echo($texto1) ?>" maxlength="500" />
							<br>
							
							<div class="caixa">Anos 60 Texto2</div>
							<input class="caixa" name="txtarea2" type="text" value="<?php echo($texto2) ?>" maxlength="500" />
							
							<div class="caixa">Anos 70 Texto1</div>
							<input class="caixa" name="txtarea3" type="text" value="<?php echo($texto3) ?>" maxlength="500" />
                            
                            <div class="caixa">Anos 70 Texto2</div>
							<input class="caixa" name="txtarea4" type="text" value="<?php echo($texto4) ?>" maxlength="500" /><br>
                            
                            <div class="caixa">Anos 80 Texto1</div>
							<input class="caixa" name="txtarea5" type="text" value="<?php echo($texto5) ?>" maxlength="500"/><br>
                            
                            <div class="caixa">Anos 80 Texto2</div>
							<input class="caixa" name="txtarea6" type="text" value="<?php echo($texto6) ?>" maxlength="500" /><br>
                            
							<div class="caixa">Nome do Video</div>
							<input class="caixa" name="txtnomevideo" type="text" value="<?php echo($video)?>" maxlength="190" placeholder="Digite o codigo do video do youtube" >
                            
                            <input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
                            
                            
                            
                        </form>
                    </div>
                    
				</div>
                
                <div id="conteiner3">
                    <table id="tabela">
                        <tr class="linha">
                            <td id="titulotabela" colspan="12">
                                lista
                            </td>
                        </tr>
                        
                        <tr class="linha">
                            <td class="coluna">
                                Nome da Imgem1
                            </td>
                            
                            <td class="coluna">
                                Imagem1
                            </td>
                            
                            <td class="coluna">
                                Nome da Imgem2
                            </td>
                            
                            <td class="coluna">
                                Imagem2
                            </td>
                            
                            <td class="coluna">
                                Nome da Imgem3
                            </td>
                            
                            <td class="coluna">
                                Imagem3
                            </td>
                            
                            <td class="coluna">
                                Texto1 anos 60
                            </td>
                            
                            <td class="coluna">
                                
                                Texto1 anos 70
                            </td>
                            
                            <td class="coluna">
                                Texto1 anos 80
                            </td>
                            
                            <td class="coluna">
                                Video
                            </td>
                            
                            <td class="coluna">
                                Opçoes
                            </td>
                        </tr>
                        
                        <?php
                                $sql="select * from tbl_curiosidade order by id desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>
                        
                        <tr class="linha">
                            <td class="coluna">
                                <?php echo($rs['nome1'])?>
                            </td>
                            
                            <td class="coluna">
                                <img src="<?php echo($rs['imagem1'])?>"width="50" height="50">
                            </td>
                            
                            <td class="coluna">
                                <?php echo($rs['texto2'])?>
                            </td>
                            
                            <td class="coluna">
                                <img src="<?php echo($rs['imagem2'])?>"width="50" height="50">
                            </td>
                            
                            <td class="coluna">
                                <?php echo($rs['texto3'])?>
                            </td>
                            
                            <td class="coluna">
                                <img src="<?php echo($rs['imagem3'])?>"width="50" height="50">
                            </td>
                            
                            <td class="coluna">
                                <?php echo($rs['texto1'])?>
                            </td>
                            
                            <td class="coluna">
                                <?php echo($rs['texto3'])?>
                            </td>
                            
                            <td class="coluna">
                                <?php echo($rs['texto5'])?>
                            </td>
                            
                            <td class="coluna">
                                <?php echo($rs['nomevideo'])?>
                            </td>
                            
                            <td class="coluna">
                                <a href="curiosidades_CMS.php?modo=ativar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/accept.png" alt="selecionado"/>
                                </a>
                                
                                <a href="curiosidades_CMS.php?modo=editar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="curiosidades_CMS.php?modo=excluir&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/excluir.png" alt="excluir">
                                </a>
                            </td>
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