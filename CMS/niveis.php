
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
    
    $idNivel=$_GET['idNivel'];
    
    if($modo=='excluir'){
        //selejct no banco para excluir
        $sql = "delete from tbl_nivel where idNivel=".$idNivel;
        //salvando no banco
        mysql_query($sql);
        //retornando para a pagina
        header('location:niveis.php');
    //modo ativa no site
    }else if($modo=='editar'){
        //botao atualizar para chamar o modo editar
        $botao = 'Atualizar';
        
        $idNivel=$_GET['idNivel'];
        
        $_SESSION['idNivel']=$idNivel;
        
        $sql="select * from tbl_nivel where idNivel=".$idNivel;
        
        $select = mysql_query($sql);
        //chamnd todas as variaveis possiveis de ediçao
        if($rs = mysql_fetch_array($select)){
            $nome=$rs['nome'];
        }  
    }
}

if(isset($_POST['btnsalvar'])){
	
    //variaveis que sao os nomes das imagem
	$nome=$_POST['txtnome'];
	
        if($_POST["btnsalvar"]=='Salvar'){
						
                //insert no banco para salvar
            $sql="insert into tbl_nivel(nome)
				values ('".$nome."')";

				//update no banco para editar
				}else if($_POST["btnsalvar"]=='Atualizar'){
            
                $sql="update tbl_nivel set nome='".$nome."'
                 where idNivel=".$_SESSION['idNivel'];}

        mysql_query($sql);
        //echo($sql);
        header('location:niveis.php');			
	
}

?>
<!DOCTYPE html5>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Niveis CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_niveis.css"/>
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
				<div id="cad">
                    <form name="niveis" method="post" enctype="multipart/form-data" action="niveis.php">
                        <div class="caixa">Nome:</div>
                        <input class="caixa" type="text" name="txtnome" value="<?php echo($nome)?>" maxlength="90" ><br><br>
                        
                        <input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao)?>">
                        
                        <div id="atencao">
                        O nome do nivel cadastrado devera tem no maximo 90 caracteres!
                        </div>
                    </form>
                </div>
                
                <div id="seguraTabela">
                    <table id="tabela">
						<tr >
							<td class="titulo2" colspan="2">
								Lista de niveis
							</td>
						</tr>
						
						<tr class="linha">
                            <td class="coluna">
								Nome do nivel
							</td>
                            
							<td class="coluna">
								Opções
							</td>
						</tr>
                        
                          <?php
                                $sql="select * from tbl_nivel order by idNivel desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){

                            ?>
						
                        
						<tr class="linha">
                            <td class="coluna">
								<?php echo($rs['nome'])?>
							</td>
							<td class="coluna">
                                <a href="niveis.php?modo=editar&idNivel=<?php
                                   echo($rs['idNivel'])?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="niveis.php?modo=excluir&idNivel=<?php
                                   echo($rs['idNivel'])?>">
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