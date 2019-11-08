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

$botao = "Salvar";
$nome = null;
$combo = null;


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
    
    $idSubcategoria=$_GET['idSubcategoria'];
    
    if($modo=='excluir'){
        //selejct no banco para excluir
        $sql = "delete from tbl_subcategoria where idSubcategoria=".$idSubcategoria;
        //salvando no banco
        mysql_query($sql);
        //retornando para a pagina
        header('location:subcategoria_CMS.php');
    //modo ativa no site
    }else if($modo=='editar'){
        //botao atualizar para chamar o modo editar
        $botao = 'Atualizar';
        
        $idSubcategoria=$_GET['idSubcategoria'];
        
        $_SESSION['idSubcategoria']=$idSubcategoria;
        
        $sql="select * from tbl_subcategoria where idSubcategoria=".$idSubcategoria;
        
        $select = mysql_query($sql);
        //chamnd todas as variaveis possiveis de ediçao
        if($rs = mysql_fetch_array($select)){
            $nome=$rs['nomeSubcategoria'];
        }  
    }
}

if(isset($_POST['btnsalvar'])){
	
    //variaveis que sao os nomes das imagem
	$nome=$_POST['txtnome'];
    $combo=$_POST["combo"];
	
        if($_POST["btnsalvar"]=='Salvar'){
						
                //insert no banco para salvar
            $sql="insert into tbl_subcategoria(nomeSubcategoria, idCategoria)
				values ('".$nome."', '".$combo."')";
            
            echo($sql);

				//update no banco para editar
				}else if($_POST["btnsalvar"]=='Atualizar'){
            
                $sql="update tbl_subcategoria set nomeSubcategoria='".$nome."', idCtegoria='".$combo."'
                 where idSubcategoria=".$_SESSION['idSubcategoria'];}

        mysql_query($sql);
        
        header('location:subcategoria_CMS.php');			
	
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Cadastro de Subcategoria da Home CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_subcategoriaCMS.css"/>
		
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
					<div>Cadastro de Subcategorias</div>
				</div>
                
				<div id="conteiner">
                    <div id="cad">
						<form name="frmupload" method="post" enctype="multipart/form-data" action="subcategoria_CMS.php">
                            
                            
                            <div class="caixa">Nome da Subcategoria:</div><input class="caixa" type="text" name="txtnome" value="<?php echo($nome) ?>" maxlength="140"><br>
                            
                            <select name="combo" id="combo">
                                <?php
                                        $sql="select * from tbl_categoria order by idCategoria desc";
                                        $select=mysql_query($sql);

                                        while($rs=mysql_fetch_array($select)){

                                    ?>
										<option value="<?php echo($rs['idCategoria'])?>">
                                        <?php echo($rs['nomeCategoria'])?></option>
										    
                                    <?php 

                                        }
                                        ?>
                            </select>
							
							<br><br><br><input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
							
						</form> 
					</div>
					
					<div id="seguraTabela">
					<table id="tabela">
						<tr >
							<td class="titulo2" colspan="3">
								Lista de Produtos Subcadastrados
							</td>
						</tr>
						
						<tr class="linha">
                            <td class="coluna">
							     Nome da Subcategoria
							</td>
							<td class="coluna">
								Nome da Categoria
							</td>
							
							<td class="coluna">
								Opções
							</td>
						</tr>
                        
                        <?php
                                $sql="select * from tbl_subcategoria order by idSubcategoria desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>
						
						<tr class="linha">
                            <td class="coluna">
								<?php echo($rs['nomeSubcategoria'])?>
							</td>
							<td class="coluna">
								<?php echo($rs['idCategoria'])?>
							</td>
							
							<td class="coluna">
								<a href="subcategoria_CMS.php?modo=editar&idSubcategoria=<?php
                                   echo($rs['idSubcategoria'])?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="subcategoria_CMS.php?modo=excluir&idSubcategoria=<?php
                                   echo($rs['idSubcategoria'])?>">
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