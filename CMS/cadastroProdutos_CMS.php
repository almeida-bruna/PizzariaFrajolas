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
$upload_file = null;
$descricao = null;
$preco = null;

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
        //selejct no banco para excluir
        $sql = "delete from tbl_produto where id=".$id;
        //salvando no banco
        mysql_query($sql);
        //retornando para a pagina
        header('location:cadastroProdutos_CMS.php');
    //modo ativa no site
    }else if($modo=='editar'){
        //botao atualizar para chamar o modo editar
        $botao = 'Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_produto where id=".$id;
        
        $select = mysql_query($sql);
        //chamnd todas as variaveis possiveis de ediçao
        if($rs = mysql_fetch_array($select)){
			
            $upload_file=$rs['imagem'];
            $nome=$rs['nome'];
            $descricao=$rs['descricao'];
            $preco=$rs['preco'];
            
        }  
    }
}

if(isset($_POST['btnsalvar'])){
	
    //variaveis que sao os nomes das imagem
	$nome=$_POST['txtnome'];
	$descricao=$_POST['txtdescricao'];
	$preco=$_POST['txtpreco'];
    $combo=$_POST["combo"];
	
   
    //para buscar a imagem na pasta arquivo
    $upload_dir="arquivo/";
    
    $nome_arq = basename($_FILES['flefoto']['name']);

    //if para fazer o tratamento da extençao da imagem
    if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png') || strstr($nome_arq,'.gif')){
        
        $extensao = substr($nome_arq,strpos($nome_arq,"."),5);
        $prefixo = substr($nome_arq,0,strpos($nome_arq,"."));
        $nome_arq = md5($prefixo).$extensao;
		
        $upload_file = $upload_dir . $nome_arq;
		
        //if para ver se as imagens foram selecionadas
            
        if(move_uploaded_file($_FILES['flefoto']['tmp_name'], $upload_file)){
			
			if($_POST["btnsalvar"]=='Salvar'){
						
                //insert no banco para salvar
				$sql="insert into tbl_produto(nome,imagem,descricao,preco,idSubcategoria)
						values ('".$nome."','".$upload_file."','".$descricao."','".$preco."','".$combo."')";

						//update no banco para editar
						}else if($_POST["btnsalvar"]=='Atualizar'){
                        $sql="update tbl_produto set nome='".$nome."',
                            imagem='".$upload_file."',descricao='".$descricao."',preco='".$preco."', idSubcategoria='".$combo."' where id=".$_SESSION['id'];
                        }

             }
             mysql_query($sql);
			//echo($sql);
             header('location:cadastroProdutos_CMS.php');			
	}
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Cadastro de Produdos da Home CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_cadastroProdutosCMS.css"/>
		
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
					<div>Cadastro de Produtos</div>
				</div>
                
				<div id="conteiner">
                    <div id="cad">
						<form name="frmupload" method="post" enctype="multipart/form-data" action="cadastroProdutos_CMS.php">
							
							<div class="caixa">Nome da foto:</div><input class="caixa" type="text" name="txtnome" value="<?php echo($nome) ?>" maxlength="140">
							
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto" value="<?php echo($upload_file) ?>"><br>
							
							<div class="caixa">Descricao:</div><input class="caixa" type="text" name="txtdescricao" value="<?php echo($descricao) ?>" maxlength="100">
							
							<div class="caixa">Preço:</div><input class="caixa" type="text" name="txtpreco" value="<?php echo($preco) ?>" maxlength="5"><br><br>
                            
                            <select name="combo" id="combo">
                                <?php
                                        $sql="select * from tbl_subcategoria order by idSubcategoria desc";
                                        $select=mysql_query($sql);

                                        while($rs=mysql_fetch_array($select)){

                                    ?>
										<option value="<?php echo($rs['idSubcategoria'])?>">
                                        <?php echo($rs['nomeSubcategoria'])?></option>
										    
                                    <?php 

                                        }
                                        ?>
                            </select><br><br>
							
							<input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao) ?>">
							
							<div id="foto">
								<img src="<?php echo($rs['imagem'])?>"width="70" height="70">
							</div>
						</form> 
					</div>
					
					<div id="seguraTabela">
					<table id="tabela">
						<tr >
							<td class="titulo2" colspan="6">
								Lista de Produtos Cadastrados
							</td>
						</tr>
						
						<tr class="linha">
							<td class="coluna">
								Imagem
							</td>
							
							<td class="coluna">
								Nome
							</td>
							
							<td class="coluna">
								Descrição
							</td>
							
							<td class="coluna">
								Preço
							</td>
                            <td class="coluna">
								Subcategoria
							</td>
							
							<td class="coluna">
								Opções
							</td>
						</tr>
						
						<?php
                                $sql="select * from new_view";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>
						
						<tr class="linha">
							<td class="coluna">
								<img src="<?php echo($rs['imagem'])?>"width="50" height="50">
							</td>
							
							<td class="coluna">
								<?php echo($rs['nome'])?>
							</td>
							
							<td class="coluna">
								<?php echo($rs['descricao'])?>
							</td>
                            
                            
							<td class="coluna">
								<?php echo($rs['preco'])?>
							</td>
                            
                            <td class="coluna">
								<?php echo($rs['nomeSubcategoria'])?>
							</td>
							
							
							<td class="coluna">
                                <a href="cadastroProdutos_CMS.php?modo=editar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="cadastroProdutos_CMS.php?modo=excluir&id=<?php
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