<?php
session_start();

$trava_conteudo = "";
$trava_fale_conosco = "";
$trava_produto = "";
$trava_usuarios = "";

$nome=null;
$telefone=null;
$celular=null;
$email=null;
$sexo=null;
$chkmasculino=null;
$chkfeminino="checked";
$homePage=null;
$linkFacebook=null;
$informacoesProdutos=null;
$profissao=null;
$sugestaoCriticas=null;

$botao="Atualizar";

$conexao=mysql_connect('localhost','root','bcd127');

mysql_select_db('pizzaria');

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

if(isset($_GET['modo']))
{
    //Pega o conteudo da variavel modo
    $modo=$_GET['modo'];
    
    //Verifica se a variavel modo = excluir
    if($modo=='excluir')
    {
        //Resgata o codigo passado na URL
        $id=$_GET['id'];
        
        //Deleta no BD o Registro
        $sql = "delete from tbl_faleconosco where id=".$id;
		//echo($sql);
		
        mysql_query($sql);
        
        //Redireciona para a pagina inicial para apagar o GET da url
        header('location:faleConoscoAdm.php');
        
     //Verifica se a variavel modo = consulta_editar
    }else if($modo=='editar'){
        
        //Resgata o codigo passado na URL
        $id=$_GET['id'];
        
        //Essa variavel Global será utilizada no UPDATE do registro
        $_SESSION['id']=$id;
        
        //Monta o select para buscar o registro no BD
        $sql="select * from tbl_faleconosco where id=".$id;
        
        //echo($sql);
        
        //Executa no BD o select
        $select = mysql_query($sql);
        
        //Verifica se o resultado do select tem registros e 
        //converte o resultado em um array
        if($rs=mysql_fetch_array($select)){
            //Resgata todos os dados do BD e guarda em variavel local
            $nome=$rs['nome'];
            $telefone=$rs['telefone'];
            $celular=$rs['celular'];
            $email=$rs['email'];
            $homePage=$rs['homePage'];
            $linkFacebook=$rs['linkFacebook'];
            $informacoesProdutos=$rs['informacoesProdutos'];
            $profissao=$rs['profissao'];
            $sugestaoCriticas=$rs['sugestaoCriticas'];
            $sexo=$rs['sexo'];
                $chkmasculino="";
                $chkfeminino="";

                if($sexo=='F')
                    $chkfeminino="checked";
                else
                    $chkmasculino="checked";
           
        }
    }
}

if(isset($_POST["btnatualizar"])){
    
        $nome=$_POST["txtNome"];
        $telefone=$_POST["txtTelefone"];
        $celular=$_POST["txtCelular"];
        $email=$_POST["txtEmail"];
        $sexo=$_POST["rdoSexo"];
        $sugestaoCriticas=$_POST["txtSugestaoCriticas"];
        $homePage=$_POST["txtHomePage"];
        $linkFacebook=$_POST["txtLinkFacebook"];
        $informacoesProdutos=$_POST["txtInformacoesProdutos"];
        $profissao=$_POST["txtProfissao"];
    
        $sql="update tbl_faleconosco set nome='".$nome."',telefone='".$telefone."',
        celular='".$celular."',email='".$email."',homePage='".$homePage."',linkFacebook=
        '".$linkFacebook."',informacoesProdutos='".$informacoesProdutos."',profissao=
        '".$profissao."',sugestaoCriticas='".$sugestaoCriticas."',sexo='".$sexo."'";
	
		mysql_query($sql);
        
        //Redireciona para a pagina inicial para apagar o GET da url
        header('location:faleConoscoAdm.php');
   
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Fale Conosco</title>
        <link rel="stylesheet" type="text/css" href="Css/style_faleConoscoAdm.css"/>
    </head>
    <body>
        <div class="modalContainer">
	       <div class="modal">
		
	       </div>
        </div>	
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
                <div id="seguratabela">
                    <table id="tabela1">
                        <tr class="linha">
                            <td colspan="4" id="titulo2">
                                lista de Usuarios
                            </td>
                        </tr>

                        <tr class="linha">
                            <td class="coluna">Nome </td>

                            <td class="coluna" >Telefone</td>

                            <td class="coluna"> E-mail </td>

                            <td class="coluna" > Opçoes </td>
                        </tr>
                        <?php
                            $sql="select * from tbl_faleconosco order by id desc";
                            $select = mysql_query($sql);

                        	while($rs = mysql_fetch_array($select)){


                        ?>

                        <tr class="linha">
                            <td class="coluna"><?php echo($rs['nome'])?></td>

                            <td class="coluna"><?php echo($rs['telefone'])?></td>

                            <td class="coluna"><?php echo($rs['email'])?></td>

                            <td class="coluna"> 

                                <a href="faleConoscoAdm.php?modo=editar&id=<?php
                                echo($rs['id'])?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>

                                <a href="faleConoscoAdm.php?modo=excluir&id=<?php 
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
                <table id="tabela2">
                    <?php
                            $sql="select * from tbl_faleconosco order by id desc";
                            $select = mysql_query($sql);

                        if($rsFaleConosco = mysql_fetch_array($select)){


                        ?>
                    <form name="Frmcomentario" method="post" action="faleConoscoAdm.php">
                     
                    <tr class="linha">
                        <td class="coluna">
                            Nome
                        </td>
                        
                        <td class="coluna">
                             <input  type="text" name="txtNome" value="<?php echo($nome) ?>" size="30px" >
                            
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Telefone:
                        </td>
                        
                        <td class="coluna">
                            <input placeholder=" DDD XXXX-XXXX" type="text" name="txtTelefone" value="<?php echo($telefone) ?>" size="30px" pattern="[0-9]{3} [0-9]{4}-[0-9]{4}" title="Formato inválido!" onkeypress="return validar(event,'caracter')">
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Celular:
                        </td>
                        
                        <td class="coluna">
                            <input placeholder=" DDD XXXXX-XXXX" type="text" name="txtCelular" value="<?php echo($celular) ?>" size="30px"  required>
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Email:
                        </td>
                        
                        <td class="coluna">
                            <input placeholder="cadrasto@contatos.com" type="text" name="txtEmail" value="<?php echo($email) ?>" size="30px" required>
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Home page:
                        </td>
                        
                        <td class="coluna">
                            <input type="text" name="txtHomePage" value="<?php echo($homePage) ?>" size="30px">
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Link do Facebook:
                        </td>
                        
                        <td class="coluna">
                            <input type="text" name="txtLinkFacebook" value="<?php echo($linkFacebook) ?>" size="30px">
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Sugestoes/Criticas:
                        </td>
                        
                        <td class="coluna">
                            <textarea placeholder="Deixe aqui sua observação..." name="txtSugestaoCriticas" cols="32" rows="5"><?php echo($sugestaoCriticas) ?></textarea>
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Inforçoes de Produtos
                        </td>
                        
                        <td class="coluna">
                            <textarea placeholder="Deixe aqui sua observação..." name="txtInformacoesProdutos" cols="32" rows="5"><?php echo($informacoesProdutos) ?></textarea>
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            Sexo:
                        </td>
                        
                        <td class="coluna">
                            <input type="radio" name="rdoSexo" value="F" <?php echo($chkfeminino) ?> checked>Feminino
                        <input type="radio" name="rdoSexo" value="M" <?php echo($chkmasculino) ?>>Masculino
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna">
                            profissao:
                        </td>
                        
                        <td class="coluna">
                             <input type="text" name="txtProfissao" value="<?php echo($profissao) ?>" size="30px">
                        </td>
                    </tr>
                    
                    <tr class="linha">
                        <td class="coluna" colspan="2">
                            <input type="submit" name="btnatualizar" value="<?php echo($botao) ?>">
                        </td>
                        
                    </tr>
                    </form>
                    <?php
                        }
                        ?>
                    
                </table>
            </div>
            
			
            <footer>
				Desenvolvido por Bruna Sousa
            </footer>
        </div>
    </body>
</html>