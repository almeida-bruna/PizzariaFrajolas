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

$nome = null;
$upload_dir = null;
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
    
    if($modo=='excluir'){
        
        $id=$_GET['id'];
        
        $sql = "delete from tbl_pizzames where id=".$id;
        
        mysql_query($sql);
        
        header('location:pizzaMes_CMS.php');
        
    }else if($modo=='ativar'){
        
        $id=$_GET['id'];
        
        $sql="update tbl_pizzames set ativar='1' where id='".$id."'";
        
        mysql_query($sql);
            
        header('location:pizzaMes_CMS.php');
        
    }else if($modo=='editar'){
        
        $botao = 'Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_pizzames where id=".$id;
        
        $select = mysql_query($sql);
        
        if($rs = mysql_fetch_array($select)){
            $nome=$rs['nome'];
            $upload_file=$rs['imagem'];
            
        }  
    }
}

if(isset($_POST['btnsalvar'])){
    
    $nome=$_POST['txtnome'];
    $upload_dir="arquivo/";
    
    $nome_arq = basename($_FILES['flefoto']['name']);
    
    if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif')){
        
        $extensao = substr($nome_arq,strpos($nome_arq,"."),5);
        $prefixo = substr($nome_arq,0,strpos($nome_arq,"."));
        $nome_arq = md5($prefixo).$extensao;
     
        $upload_file = $upload_dir . $nome_arq;
            
        if (move_uploaded_file($_FILES['flefoto']['tmp_name'], $upload_file)){
            
            if($_POST["btnsalvar"]=='Salvar'){
            
            $sql="insert into tbl_pizzames (nome,imagem)
            values ('".$nome."','".$upload_file."');";
            
            
            }else if($_POST["btnsalvar"]=='Atualizar'){
                
                    $sql="update tbl_pizzames set nome='".$nome."',imagem='".$upload_file."' where id=".$_SESSION['id'];
                }
            }
            
            mysql_query($sql);
            //echo($sql);
            header('location:pizzaMes_CMS.php');
    	}
	}
	



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Pizza do Mes CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_pizzaMesCMS.css"/>
		<script type="text/javascript">
        function validar(caracter,blockType,campo)
        {
            
            //Tratamento para verificar por qual navegador esta vindo 
            //o evento, caso seja pelo IE o evento retorna pela 
            //propriedade window.event
            if(window.event)
                {
                    //Transforma em ascii, caso a entrada de dados for pelo IE
                    //var letra=caracter.keyCode;
                    var letra=caracter.charCode;
                                    
                }else
                {
                    //Transforma em ascii, caso a entrada de dados for pelo 
                    //Firefox e chrome
                    var letra=caracter.which;
                }
            
                //Tratamento para verificar qual o tipo de bloqueio
                if (blockType=='number')
                    {
                    //Bloqueio de Numeros de 0 até 9
                    if(letra>=48 && letra<=57)
                        {
                            return false;
                        }
                    }else if (blockType=='caracter')
                    {
                        //Bloqueio de Caracteres
                       if(letra<48 || letra >57)
                           {
                               //Ativar algumas teclas necessárias
                               //traço = 45 , espaço = 32 e backspace = 8
                               if(letra!=45 && letra!=32 && letra!=8)
                                {
                                   //document.getElementById('campo').style="background-color:red;border:10;border-color:blue;";
                                    
                                    document.getElementById(campo).style="background-color:red;border:10;border-color:blue;";
                                       
                                   return false;
                                    
                                }
                           }else
                               {
                                  document.getElementById(campo).style="background-color:#ffffff;";
                                   
                               }
                    } 
        }
    </script>
		
    </head>
	
    <body>
        <div id="principal">
            <header>
				<div id="titulo">
					<strong>CMS</strong> - Sistema de Gerenciamento do Site
				</div>
				
				<div id="logo">
					<img id="imagem-logo" alt="log" src="Imagens/logo.png"/>
				</div>
            </header>
            
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
					<div id="titol">Pizza do Mês</div>
					
				</div>
				
				<div class="conteiner">
                    <div id="cad">
                        <form name="frmupload" method="post" enctype="multipart/form-data" action="pizzaMes_CMS.php">
                            
                            <div class="caixa">Nome da Foto:</div><input class="caixa" type="text" name="txtnome" value="<?php echo($nome) ?>" maxlength="190"><br><br>
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto" value="<?php echo($upload_file) ?>"><br><br>
                            <div id="foto">
                            </div><br>
                            <input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
                        </form>
                    </div>
				</div>
				
				<div class="conteiner2">
					<table id="tabela2">
                        <tr class="linha">
                            <td colspan="3" id="titulo2">
                                lista de imagens já cadastradas
                            </td>
                        </tr>

                        <tr class="linha">
                            <td class="td" >Nome </td>

                            <td class="td"> Foto </td>

                            <td class="td"> Opçoes </td>
                        </tr>
                            <?php
                                $sql="select * from tbl_pizzames order by id desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>

                        <tr class="linha">
                            <td class="td"><?php echo($rs['nome']) ?></td>

                        <td class="td"><img src="<?php echo($rs['imagem'])?>" width="50" height="50"></td>

                            <td class="td">
                                
                                <a href="pizzaMes_CMS.php?modo=ativar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/accept.png" alt="selecionado"/>
                                </a>
                                
                                <a href="pizzaMes_CMS.php?modo=editar&id=<?php
                                echo($rs['id']) ?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
									
                                </a>
                                
                                <a href="pizzaMes_CMS.php?modo=excluir&id=<?php
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