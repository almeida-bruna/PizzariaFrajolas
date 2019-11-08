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
    
    $idCategoria=$_GET['idCategoria'];
    
    if($modo=='excluir'){
        //selejct no banco para excluir
        $sql = "delete from tbl_categoria where idCategoria=".$idCategoria;
        //salvando no banco
        mysql_query($sql);
        //retornando para a pagina
        header('location:categoria_CMS.php');
    //modo ativa no site
    }else if($modo=='editar'){
        //botao atualizar para chamar o modo editar
        $botao = 'Atualizar';
        
        $idCategoria=$_GET['idCategoria'];
        
        $_SESSION['idCategoria']=$idCategoria;
        
        $sql="select * from tbl_categoria where idCategoria=".$idCategoria;
        
        $select = mysql_query($sql);
        //chamnd todas as variaveis possiveis de ediçao
        if($rs = mysql_fetch_array($select)){
            $nome=$rs['nomeCategoria'];
        }  
    }
}

if(isset($_POST['btnsalvar'])){
	
    //variaveis que sao os nomes das imagem
	$nome=$_POST['txtnome'];
	
        if($_POST["btnsalvar"]=='Salvar'){
						
                //insert no banco para salvar
            $sql="insert into tbl_categoria(nomeCategoria)
				values ('".$nome."')";

				//update no banco para editar
				}else if($_POST["btnsalvar"]=='Atualizar'){
            
                $sql="update tbl_categoria set nomeCategoria='".$nome."'
                 where idCategoria=".$_SESSION['idCategoria'];}

        mysql_query($sql);
        //echo($sql);
        header('location:categoria_CMS.php');			
	
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Cadastro de Categoria da Home CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_categoriaCMS.css"/>
		
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
					<div>Cadastro de Categorias</div>
				</div>
                
				<div id="conteiner">
                    <div id="cad">
						<form name="frmupload" method="post" enctype="multipart/form-data" action="categoria_CMS.php">
                            
                            <div class="caixa">Nome da Categoria:</div><input class="caixa" type="text" name="txtnome" value="<?php echo($nome) ?>" maxlength="140"><br><br>
							
							<input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
							
						</form> 
					</div>
					
					<div id="seguraTabela">
					<table id="tabela">
						<tr >
							<td class="titulo2" colspan="2">
								Lista de Categorias Cadastrados
							</td>
						</tr>
						
						<tr class="linha">
							<td class="coluna">
								Nome
							</td>
							
							<td class="coluna">
								Opções
							</td>
						</tr>
						<?php
                                $sql="select * from tbl_categoria order by idCategoria desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>
						
						<tr class="linha">
							<td class="coluna">
								<?php echo($rs['nomeCategoria'])?>
							</td>
							
							<td class="coluna">
								<a href="categoria_CMS.php?modo=editar&idCategoria=<?php
                                   echo($rs['idCategoria'])?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="categoria_CMS.php?modo=excluir&idCategoria=<?php
                                   echo($rs['idCategoria'])?>">
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