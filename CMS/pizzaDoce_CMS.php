<?php

//chamando o caminho do banco de dados
    require_once('modulo.php');
//conexao com o banco de dados
    Conexao_Database();

if(isset($_POST['btnsalvar'])){
	
	$nome1=$_POST['txtnome1'];
	$nome2=$_POST['txtnome2'];
	$nome3=$_POST['txtnome3'];
	$nome4=$_POST['txtnome4'];
    $nome5=$_POST['txtnome5'];
    $nome6=$_POST['txtnome6'];
	
    $upload_dir="arquivo/";
    
    $nome_arq1 = basename($_FILES['flefoto1']['name']);
	$nome_arq2 = basename($_FILES['flefoto2']['name']);
	$nome_arq3 = basename($_FILES['flefoto3']['name']);
	$nome_arq4 = basename($_FILES['flefoto4']['name']);
    $nome_arq5 = basename($_FILES['flefoto5']['name']);
    $nome_arq6 = basename($_FILES['flefoto6']['name']);
    
    if(strstr($nome_arq1,'.jpg') || strstr($nome_arq1,'.png') || strstr($nome_arq1,'.gif' ||
		$nome_arq2,'.jpg') || strstr($nome_arq2,'.png') || strstr($nome_arq2,'.gif' ||
		$nome_arq3,'.jpg') || strstr($nome_arq3,'.png') || strstr($nome_arq3,'.gif' ||
		$nome_arq4,'.jpg') || strstr($nome_arq4,'.png') || strstr($nome_arq4,'.gif' ||
        $nome_arq5,'.jpg') || strstr($nome_arq5,'.png') || strstr($nome_arq5,'.gif' ||
        $nome_arq6,'.jpg') || strstr($nome_arq6,'.png') || strstr($nome_arq6,'.gif')){
        
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
        
        $extensao6 = substr($nome_arq6,strpos($nome_arq6,"."),5);
        $prefixo6 = substr($nome_arq6,0,strpos($nome_arq6,"."));
        $nome_arq6 = md5($prefixo6).$extensao6;
     
        $upload_file1 = $upload_dir . $nome_arq1;
		$upload_file2 = $upload_dir . $nome_arq2;
		$upload_file3 = $upload_dir . $nome_arq3;
		$upload_file4 = $upload_dir . $nome_arq4;
        $upload_file5 = $upload_dir . $nome_arq5;
        $upload_file6 = $upload_dir . $nome_arq6;
            
        if(move_uploaded_file($_FILES['flefoto1']['tmp_name'], $upload_file1)){
			
			if(move_uploaded_file($_FILES['flefoto2']['tmp_name'], $upload_file2)){
				
				if(move_uploaded_file($_FILES['flefoto3']['tmp_name'], $upload_file3)){
					
					if(move_uploaded_file($_FILES['flefoto4']['tmp_name'], $upload_file4)){
                        
                        if(move_uploaded_file($_FILES['flefoto5']['tmp_name'], $upload_file5)){
                            
                            if(move_uploaded_file($_FILES['flefoto6']['tmp_name'], $upload_file6)){
						
                                $sql="insert into tbl_pizzadoce (imagem1,nome1,imagem2,nome2,
                                imagem3,nome3,imagem4,nome4,imagem5,nome5,
                                imagem6,nome6)
                                values ('".$upload_file1."','".$nome1."','".$upload_file2."','".$nome2."',
                                '".$upload_file3."','".$nome3."','".$upload_file4."','".$nome4."',
                                '".$upload_file5."','".$nome5."','".$upload_file6."','".$nome6."')";

                                mysql_query($sql);
                                //echo($sql);
                                header('location:pizzaDoce_CMS.php');
                         }
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
        
        $sql = "delete from tbl_pizzadoce where id=".$id;
        
        mysql_query($sql);
        
        header('location:pizzaDoce_CMS.php');
        
    }else if($modo=='ativar'){
         
        $sql="update tbl_pizzadoce set ativar='".$modo."'where id='".$id."'";
        
        mysql_query($sql);
        //echo($sql);
        header('location:pizzaDoce_CMS.php');
    }
    
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Pizzas Doces CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_pizzaDoceCMS.css"/>
		
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
						<a href="cms.php">
						<div class="rotulos">
							Adm. Conteúdo
						</div>
						</a>
						
                        <a href="faleConoscoAdm.php">
						<div class="rotulos">
							Adm. Fale Conosco
						</div>
                        </a>
                        
                        <a href="produtos_CMS.php">
						<div class="rotulos">
							Adm. Produtos
						</div>
                        </a>
						
						<a href="usuarios.php"> <div class="rotulos">
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
					<div>Pizzas Doces</div>
				</div>

				<div class="conteiner">
                    <div id="cad">
						<div id="title">Pizzas Doces</div>
                        <form name="frmupload" method="post" enctype="multipart/form-data" action="pizzaDoce_CMS.php">
							
							<div class="caixa">Nome da foto1:</div><input class="caixa" type="text" name="txtnomeo1"><br>
							
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto1"><br>
							
							<div class="caixa">Nome da foto2:</div><input class="caixa" type="text" name="txtnomeo2"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto2"><br>
							
							<div class="caixa">Nome da foto3:</div><input class="caixa" type="text" name="txtnomeo3"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto3"><br>
							
							<div class="caixa">Nome da foto4:</div><input class="caixa" type="text" name="txtnomeo4"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto4"><br>
                            
                            <div class="caixa">Nome da foto5:</div><input class="caixa" type="text" name="txtnomeo5"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto5"><br>
                            
                            <div class="caixa">Nome da foto6:</div><input class="caixa" type="text" name="txtnomeo6"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto6"><br>
                            
                            
                            
                            <input id="salvar" type="submit" name="btnsalvar2" value="Salvar">
                        </form>
                    </div>
                    
                    <table id="tabela2">
                        <tr class="linha1">
                            <td colspan="7" id="titulo2">
                                Lista
                            </td>
                        </tr>
						
                        <tr class="linha1">
                            <td class="td">Img1</td>
                            <td class="td">Img2</td>
                            <td class="td">Img3</td>
                            <td class="td">Img4</td>
                            <td class="td">Img5</td>
                            <td class="td">Img6</td>
                            <td class="td">Opções</td>
                        </tr>
						
						<?php
                                $sql="select * from tbl_pzzadoce order by id desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){
                            ?>
						
                        <tr class="linha2">
                            <td class="td2"><img src="<?php echo($rs['imagem1']) ?>" width="50" height="50"></td>
							
                            <td class="td2"><img src="<?php echo($rs['imagem2']) ?>" width="50" height="50"></td>
							
							<td class="td2"><img src="<?php echo($rs['imagem3']) ?>" width="50" height="50"></td>
							
                            <td class="td2"><img src="<?php echo($rs['imagem4']) ?>" width="50" height="50"></td>
                            
                            <td class="td2"><img src="<?php echo($rs['imagem5']) ?>" width="50" height="50"></td>
                            
                            <td class="td2"><img src="<?php echo($rs['imagem6']) ?>" width="50" height="50"></td>
							
                            <td class="td">
								<a href="pizzaDoce_CMS.php?modo=ativar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/accept.png" alt="selecionado"/>
                                </a>
                                
                                <a href="pizzaDoce_CMS.php?modo=excluir&id=<?php
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