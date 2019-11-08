<?php

//a session é responsavel por dar o ok na pagina home e encaminha a 
//pagina cms
    session_start();

$trava_conteudo = "";
$trava_fale_conosco = "";
$trava_produto = "";
$trava_usuarios = "";

$nome=null;
$telefone=null;
$email=null;
$usuario=null;
$senha=null;
$botao="Salvar";

$conexao=mysql_connect('localhost','root','bcd127');

mysql_select_db('pizzaria');

if($_SESSION['idNivelUsuario'] != 0){
    
    $sql = "SELECT * FROM tbl_nivel WHERE idNivel = ".$_SESSION['idNivelUsuario'];
    $select = mysql_query($sql);
    $rs = mysql_fetch_array($select);
    $conteudo = $rs['conteudo'];
    $f_c = $rs['faleConosco'];
    $produto = $rs['produtos'];
    $usuario = $rs['usuario'];
    
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
    
    $modo=$_GET['modo'];
    
    if($modo=='excluir'){
        
        $id=$_GET['id'];
        
        $sql = "delete from tbl_usuario where id=".$id;
        
        mysql_query($sql);
        
        header('location:usuarios.php');
		
    }else if($modo=='consulta_editar'){
        
        $botao='Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_usuario where id=".$id;
        
        $select = mysql_query($sql);
        
        if($rs = mysql_fetch_array($select)){
            $nome=$rs['nome'];
            $telefone=$rs['telefone'];
            $email=$rs['email'];
            $usuario=$rs['usuario'];
            $senha=$rs['senha'];
    }
}
    
}

if(isset($_POST["btnsalvar"])){
    
    $nome=$_POST["txtnome"];
    $telefone=$_POST["txttelefone"];
    $email=$_POST["txtemail"];
    $usuario=$_POST["txtusuario"];
    $senha=$_POST["txtsenha"];
    $combo=$_POST["combo"];
    
    if($_POST["btnsalvar"]=='Salvar'){
      
        $sql="insert into tbl_usuario (nome,telefone,email,usuario,senha,idNivel)
            values('".$nome."','".$telefone."','".$email."',
                   '".$usuario."','".$senha."','".$combo."')";
        
        
    }else if($_POST["btnsalvar"]=='Atualizar'){
        $sql="update tbl_usuario set nome='".$nome."',telefone='".$telefone."',
             email='".$email."',usuario='".$usuario."',
            senha='".$senha."', idNivel='".$combo."' where id=".$_SESSION['id'];
	
    }
    mysql_query($sql);
    
    header('location:usuarios.php');
   

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Usuario</title>
        <link rel="stylesheet" type="text/css" href="Css/style_usuario.css"/>
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
                <div id="seguratabela">
                <table id="tabela2">
                    <tr>
                        <td colspan="5" id="titulo2">
                            lista de Usuarios
                        </td>
                    </tr>

                    <tr>
                        <td class="titulo3" width="200px">Nome </td>

                        <td class="titulo3" width="180px">Telefone</td>

                        <td class="titulo3" width="240px"> E-mail </td>

                        <td class="titulo3" width="100px"> Opçoes </td>
                    </tr>

                    <?php
                        $sql="select * from tbl_usuario order by id desc";
                        $select = mysql_query($sql);
                    
                        while($rs=mysql_fetch_array($select)){
                            
                        
                    ?>

                    <tr>
                        <td><?php echo($rs['nome']) ?></td>
                        <td><?php echo($rs['telefone']) ?></td>
                        <td><?php echo($rs['email']) ?></td>
                        <td>
                            <a href="usuarios.php?modo=consulta_editar&id=<?php echo($rs['id']) ?>">
                                <img src="Imagens/editar.png">
                            </a>

                            <a href="usuarios.php?modo=excluir&id=<?php echo($rs['id']) ?>">
                                <img src="Imagens/excluir.png">
                            </a>    
                        </td>
                    </tr>
                
                    <?php
                        }
                    ?>
                </table>
                </div>
                <div id="cadastro">
        	
                    <form name="frmcontatos" method="post" action="usuarios.php">

                        <table id="tblcadastro">
                          <tr>
                            <td colspan="2" class="titulo_tabela">Cadastro de Usuario</td>
                          </tr>
							
                          <tr>
                            <td class="tblcadastro_td">Nome:</td>
                            <td><input class="campos" onkeypress="return validar(event,'number')" placeholder="Digite seu nome"  name="txtnome" pattern="[a-z A-Z ã Ã õ Õ é É ô Ô ç Ç]*" title="Digitação apenas de Letras" type="text"  required  
							value="<?php echo($nome) ?>"/></td>
                          </tr>
							
                          <tr>
                            <td class="tblcadastro_td">Telefone:</td>
                            <td><input class="campos" onkeypress="return validar(event,'caracter','telefone')" pattern="[0-9]{3} [0-9]{4}-[0-9]{4}"  name="txttelefone" type="text" value="<?php echo($telefone) ?>" /></td>
                          </tr>
                          
                          <tr>
                            <td class="tblcadastro_td">Email:</td>
                            <td><input class="campos" name="txtemail" type="email" value="<?php echo($email) ?>" required /></td>
                          </tr>
                            
							<tr>
                            <td class="tblcadastro_td">Usuario:</td>
				            <td>
				                <input class="campos" name="txtusuario" type="text" value=""/>
				            </td>
							</tr>
							
							<tr>
								<td class="tblcadastro_td">Senha:</td>
								<td><input class="campos" type="password" name="txtsenha"
										   value="<?php echo($senha) ?>"/></td>
							</tr>
							<tr>
								<td class="tblcadastro_td">Nivel:</td>
								<td>
                                     
									<select name="combo" id="nivel">
                                        <?php
                                        $sql="select * from tbl_nivel order by idNivel desc";
                                        $select=mysql_query($sql);

                                        while($rs=mysql_fetch_array($select)){

                                    ?>
										<option value="<?php echo($rs['idNivel'])?>" ><?php echo($rs['nome'])?></option>
										    
                                    <?php 

                                        }
                                        ?>
									</select>
                                  
								</td>
							</tr>
                          <tr>
                            <td><input class="botao" name="btnsalvar" type="submit" value="<?php echo($botao) ?>" />
                                <input class="botao" name="btnlimpar" type="reset" value="Limpar" />
                            </td>
                            <td>
							</td>
                          </tr>
                        </table>
                    </form>
                </div>
                
                <a href="niveis.php">
                <div id="botaoNivel">
                    Cadastrar Niveis
                </div>
                </a>
            </div>
            
            <footer>
				Desenvolvido por Bruna Sousa
            </footer>
        </div>
    </body>
</html>