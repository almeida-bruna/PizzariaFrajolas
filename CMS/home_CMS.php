<?php
session_start();
//chamando o caminho do banco de dados
    require_once('modulo.php');
//conexao com o banco de dados
    Conexao_Database();

//definindo como a variavel deve vir

$trava_conteudo = "";
$trava_fale_conosco = "";
$trava_produto = "";
$trava_usuarios = "";

$nome1=null;
$nome2=null;
$nome3=null;
$nome4=null;
$nome5=null;

$upload_file1=null;
$upload_file2=null;
$upload_file3=null;
$upload_file4=null;
$upload_file5=null;

$botao='Salvar';

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

//*********************************************************************************************
//                                      IMAGENS DO SLIDE
//*********************************************************************************************
if(isset($_POST['btnsalvar'])){
	
	$nome1=$_POST['txtnome1'];
	$nome2=$_POST['txtnome2'];
	$nome3=$_POST['txtnome3'];
	$nome4=$_POST['txtnome4'];
    $nome5=$_POST['txtnome5'];
	
    $upload_dir="arquivo/";
    
    $nome_arq1 = basename($_FILES['flefoto1']['name']);
	$nome_arq2 = basename($_FILES['flefoto2']['name']);
	$nome_arq3 = basename($_FILES['flefoto3']['name']);
	$nome_arq4 = basename($_FILES['flefoto4']['name']);
    $nome_arq5 = basename($_FILES['flefoto5']['name']);
    
    if(strstr($nome_arq1,'.jpg') || strstr($nome_arq1,'.png') || strstr($nome_arq1,'.gif' ||
		$nome_arq2,'.jpg') || strstr($nome_arq2,'.png') || strstr($nome_arq2,'.gif' ||
		$nome_arq3,'.jpg') || strstr($nome_arq3,'.png') || strstr($nome_arq3,'.gif' ||
		$nome_arq4,'.jpg') || strstr($nome_arq4,'.png') || strstr($nome_arq4,'.gif' ||
        $nome_arq5,'.jpg') || strstr($nome_arq5,'.png') || strstr($nome_arq5,'.gif')){
        
        $extensao1 = substr($nome_arq1,strpos($nome_arq1,"."),5);
        $prefixo1 = substr($nome_arq1,0,strpos($nome_arq1,"."));
        $nome_arq1 = md5($prefixo1).$extensao1;
		
		$extensao2 = substr($nome_arq2,strpos($nome_arq2,"."),5);
        $prefixo2 = substr($nome_arq2,0,strpos($nome_arq2,"."));
        $nome_arq2 = md5($prefixo2).$extensao2;
		
		$extensao3 = substr($nome_arq3,strpos($nome_arq3,"."),5);
        $prefixo3 = substr($nome_arq3,0,strpos($nome_arq3,"."));
        $nome_arq3 = md5($prefixo3).$extensao3;
		
		$extensao4 = substr($nome_arq4,strpos($nome_arq4,"."),5);
        $prefixo4 = substr($nome_arq4,0,strpos($nome_arq4,"."));
        $nome_arq4 = md5($prefixo4).$extensao4;
        
        $extensao5 = substr($nome_arq5,strpos($nome_arq5,"."),5);
        $prefixo5 = substr($nome_arq5,0,strpos($nome_arq5,"."));
        $nome_arq5 = md5($prefixo5).$extensao5;
     
        $upload_file1 = $upload_dir . $nome_arq1;
		$upload_file2 = $upload_dir . $nome_arq2;
		$upload_file3 = $upload_dir . $nome_arq3;
		$upload_file4 = $upload_dir . $nome_arq4;
        $upload_file5 = $upload_dir . $nome_arq5;
            
        if(move_uploaded_file($_FILES['flefoto1']['tmp_name'], $upload_file1)){
			
			if(move_uploaded_file($_FILES['flefoto2']['tmp_name'], $upload_file2)){
				
				if(move_uploaded_file($_FILES['flefoto3']['tmp_name'], $upload_file3)){
					
					if(move_uploaded_file($_FILES['flefoto4']['tmp_name'], $upload_file4)){
                        
                        if(move_uploaded_file($_FILES['flefoto5']['tmp_name'], $upload_file5)){
                            
                            if($_POST["btnsalvar"]=='Salvar'){
						
                                $sql="insert into tbl_homeslide (imagem1,nomeimagem1,imagem2,nomeimagem2,
                                imagem3,nomeimagem3,imagem4,nomeimagem4,imagem5,nomeimagem5)
                                values ('".$upload_file1."','".$nome1."','".$upload_file2."','".$nome2."',
                                '".$upload_file3."','".$nome3."','".$upload_file4."','".$nome4."','".$upload_file5."','".$nome5."')";

                                
                               }else if($_POST["btnsalvar"]=='Atualizar'){
                                $sql="update tbl_homeslide set imagem1='".$upload_file1."',nomeimagem1='".$nome1."',
                                imagem2='".$upload_file2."',nomeimagem2='".$nome2."',
                                imagem3='".$upload_file3."',nomeimagem3='".$nome3."',
                                imagem4='".$upload_file4."',nomeimagem4='".$nome4."',
                                imagem5='".$upload_file5."',nomeimagem5='".$nome5."'
                                where id=".$_SESSION['id'];
                            }
                            mysql_query($sql);
                                //echo($sql);
                                header('location:home_CMS.php');
                   }
				}	
			} 
        }
    }
}
}

if(isset($_GET['modo'])){
    
    $modo = $_GET['modo'];
    
    $id=$_GET['id'];
    
    if($modo=='excluir'){
        
        $sql = "delete from tbl_homeslide where id=".$id;
        
        mysql_query($sql);
        
        header('location:home_CMS.php');
    }else if($modo=='ativar'){
         
        $id=$_GET['id'];
        
        $sql="update tbl_homeslide set ativar='1' where id='".$id."'";
        
        mysql_query($sql);

        header('location:home_CMS.php');
        
    }else if($modo=='editar'){
        
        $botao = 'Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_homeslide where id=".$id;
        
        $select = mysql_query($sql);
        
        if($rs = mysql_fetch_array($select)){
            
            $nome1=$rs['nomeimagem1'];
            $nome2=$rs['nomeimagem2'];
            $nome3=$rs['nomeimagem3'];
            $nome4=$rs['nomeimagem4'];
            $nome5=$rs['nomeimagem5'];
            $upload_file1=$rs['imagem1'];
            $upload_file2=$rs['imagem2'];
            $upload_file3=$rs['imagem3'];
            $upload_file4=$rs['imagem4'];
            $upload_file5=$rs['imagem5'];
            
        }
        
        
    }
    
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Home CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_homeCMS.css"/>
		
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
					<div>Home</div>
				</div>
<!--*****************************************************************************************--> 
                                        <!--IMAGEMS DO SLIDE-->
<!--*****************************************************************************************--> 
                
				<div id="conteiner">
                    <div id="cad">
						<div id="title">Imagens dos Slides</div>
                        <form name="frmupload" method="post" enctype="multipart/form-data" action="home_CMS.php">
							
							<div class="caixa">Nome da foto1:</div><input class="caixa" type="text" name="txtnome1" value="<?php echo($nome1) ?>"><br>
							
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto1" value="<?php echo($upload_file1) ?>"><br>
							
							<div class="caixa">Nome da foto2:</div><input class="caixa" type="text" name="txtnome2" value="<?php echo($nome2) ?>"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto2" value="<?php echo($upload_file2) ?>"><br>
							
							<div class="caixa">Nome da foto3:</div><input class="caixa" type="text" name="txtnome3" value="<?php echo($nome3) ?>"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto3" value="<?php echo($upload_file3) ?>"><br>
							
							<div class="caixa">Nome da foto4:</div><input class="caixa" type="text" name="txtnome4" value="<?php echo($nome4) ?>"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto4" value="<?php echo($upload_file4) ?>"><br>
                            
                            <div class="caixa">Nome da foto5:</div><input class="caixa" type="text" name="txtnome5" value="<?php echo($nome5) ?>"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto5" value="<?php echo($upload_file5) ?>"><br>
                            
                            
                            
                            <input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
                        </form>
                    </div>
                    
                    
                    <!--*******************************************************************************-->
                    <!--******************************** TABELA DO SLIDE********************************-->
                    <!--*******************************************************************************-->
                    <div id="seguraTablela">
                    <table id="tabela2">
                        <tr class="linha1">
                            <td colspan="6" id="titulo2">
                                lista de Imagens Slides 
                            </td>
                        </tr>
						
                        <tr class="linha1">
                            <td class="td">Img1</td>
                            <td class="td">Img2</td>
                            <td class="td">Img3</td>
                            <td class="td">Img4</td>
                            <td class="td">Img5</td>
                            <td class="td">Opções</td>
                        </tr>
						
						<?php
                                $sql="select * from tbl_homeslide order by id desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>
						
                        <tr class="linha2">
                            <td class="td"><img src="<?php echo($rs['imagem1']) ?>" width="50" height="50"></td>
							
                            <td class="td"><img src="<?php echo($rs['imagem2']) ?>" width="50" height="50"></td>
							
							<td class="td"><img src="<?php echo($rs['imagem3']) ?>" width="50" height="50"></td>
							
                            <td class="td"><img src="<?php echo($rs['imagem4']) ?>" width="50" height="50"></td>
                            
                            <td class="td"><img src="<?php echo($rs['imagem5']) ?>" width="50" height="50"></td>
							
                            <td class="td">
								<a href="home_CMS.php?modo=ativar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/accept.png" alt="selecionado"/>
                                </a>
                                
                                <a href="home_CMS.php?modo=editarr&id=<?php echo($rs['id']) ?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="home_CMS.php?modo=excluir&id=<?php
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

            </div>
            
            <footer>
				Desenvolvido por Bruna Sousa
            </footer>
        </div>
    </body>
</html>