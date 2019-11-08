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

//modo como as variaveis devem vir
$nome1 = null;
$nome2 = null;
$txt1 = null;
$txt2 = null;
$txt3 = null;

//botao para salvar
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

//if para criar os modos editar, ativar e excluir
if(isset($_GET['modo'])){
    
    $modo = $_GET['modo'];
    
	//modo excluir
    if($modo=='excluir'){
        
        $id=$_GET['id'];
        
        $sql = "delete from tbl_nossoambiente where id=".$id;
        
        mysql_query($sql);
        
        header('location:nossosAmbientes_CMS.php');
        //modo ativar
    }else if($modo=='ativar'){
        
        $id=$_GET['id'];
         
        $sql="update tbl_nossoambiente set ativar='1' where id='".$id."'";
        
        mysql_query($sql);

        header('location:nossosAmbientes_CMS.php');
        //modo editar
    }else if($modo=='editar'){
        
        $botao = 'Atualizar';
        
        $id=$_GET['id'];
        
        $_SESSION['id']=$id;
        
        $sql="select * from tbl_nossoambiente where id=".$id;
        
        $select = mysql_query($sql);
        
        if($rs = mysql_fetch_array($select)){
            $nome1=$rs['nome1'];
            $nome2=$rs['nome2'];
            $upload_file1=$rs['imagem1'];
            $upload_file2=$rs['imagem2'];
            $txt1=$rs['texto1'];
            $txt2=$rs['texto2'];
            $txt3=$rs['texto3'];
            
        }
    }  
}

if(isset($_POST['btnsalvar'])){
    
    $nome1=$_POST['txtnome1'];
    $nome2=$_POST['txtnome2'];
    $txt1=$_POST['texto1'];
    $txt2=$_POST['texto2'];
    $txt3=$_POST['texto3'];
    
    $upload_dir="arquivo/";
    
    $nome_arq1 = basename($_FILES['flefoto1']['name']);
	$nome_arq2 = basename($_FILES['flefoto2']['name']);
    
    if(strstr($nome_arq1,'.jpg') || strstr($nome_arq1,'.png') || strstr($nome_arq1,'.gif' ||
		$nome_arq2,'.jpg') || strstr($nome_arq2,'.png') || strstr($nome_arq2,'.gif')){
        
        $extensao1 = substr($nome_arq1,strpos($nome_arq1,"."),5);
        $prefixo1 = substr($nome_arq1,0,strpos($nome_arq1,"."));
        $nome_arq1 = md5($prefixo1).$extensao1;
		
		$extensao2 = substr($nome_arq2,strpos($nome_arq2,"."),5);
        $prefixo2 = substr($nome_arq2,0,strpos($nome_arq2,"."));
        $nome_arq2 = md5($prefixo2).$extensao2;
        
        $upload_file1 = $upload_dir . $nome_arq1;
		$upload_file2 = $upload_dir . $nome_arq2;
        
        if(move_uploaded_file($_FILES['flefoto1']['tmp_name'], $upload_file1)){
            
            if(move_uploaded_file($_FILES['flefoto2']['tmp_name'], $upload_file2)){
                
                if($_POST["btnsalvar"]=='Salvar'){
                
                 $sql="insert into tbl_nossoambiente(nome1,imagem1,nome2,imagem2,texto1,texto2,texto3)values('".$nome1."','".$upload_file1."','".$nome2."','".$upload_file2."','".$txt1."','".$txt2."','".$txt3."')";
                
                }else if($_POST["btnsalvar"]=='Atualizar'){
                    $sql="update tbl_nossoambiente set nome1='".$nome1."',imagem1='".$upload_file1."',
                    nome2='".$nome2."',imagem2='".$upload_file2."',
                    texto1='".$txt1."',texto2='".$txt2."',texto3='".$txt3."' where id=".$_SESSION['id'];
                    
                }
            }
                mysql_query($sql);
                //echo($sql);
                header('location:nossosAmbientes_CMS.php');
        }
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Nossos Ambientes CMS</title>
        <link rel="stylesheet" type="text/css" href="Css/style_nossosAmbientesCMS.css"/>
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
				<div class="conteiner1">
					<div id="titol">Nossos Ambientes</div>
					
				</div>
				
				<div class="conteiner2">
                    <div id="cad">
                        <form name="frmupload" method="post" enctype="multipart/form-data" action="nossosAmbientes_CMS.php">
                            
                            <div class="caixa">Nome da Foto1:</div><input class="caixa" type="text" name="txtnome1" value="<?php echo($nome1) ?>" maxlength="190"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto1" value="<?php echo($upload_file1) ?>"><br>
                            
                            <div class="caixa">Nome da Foto2:</div><input class="caixa" type="text" name="txtnome2" value="<?php echo($nome2) ?>" maxlength="190"><br>
                            
                            <div class="caixa">Escolha a Foto:</div><input class="caixa" type="file" name="flefoto2" value="<?php echo($upload_file2) ?>"><br>
                            
                            <div class="caixa">Texto1:</div><input
                            class="caixa" name="texto1" type="text" value="<?php echo($txt1) ?>"
							maxlength="500"/><br>
                            
                            <div class="caixa">Texto2:</div><input class="caixa" name="texto2" type="text" value="<?php echo($txt2) ?>" maxlength="500"/><br>
                            
                            <div class="caixa">Texto3:</div><input class="caixa" name="texto3" type="text" value="<?php echo($txt3) ?>" maxlength="500"/><br>
                            
                            <input id="salvar" type="submit" name="btnsalvar" value="<?php echo($botao)?>">
                        </form>
                    </div>
				</div>
				
				<div class="conteiner3">
					<table id="tabela2">
                        <tr class="linha">
                            <td colspan="8" id="titulo2">
                                lista 
                            </td>
                        </tr>

                        <tr class="linha">
                            <td class="coluna">imagem1</td>
                            
                            <td class="coluna">nome da imagem1</td>

                            <td class="coluna">imagem2</td>
                            
                            <td class="coluna">nome da imagem2</td>

                            <td class="coluna">texto1</td>

                            <td class="coluna">texto2</td>

                            <td class="coluna">texto3</td>

                            <td class="coluna2">opçoes</td>
                        </tr>
                        
                        <?php
                                $sql="select * from tbl_nossoambiente order by id desc";
                                $select=mysql_query($sql);

                                while($rs=mysql_fetch_array($select)){
                                    
                            ?>

                        <tr class="linha">
                            <td class="coluna"><img src="<?php echo($rs['imagem1'])?>"width="50" height="50"></td>
                            
                            <td class="coluna"><?php echo($rs['nome1'])?></td>
 
                            <td class="coluna"><img src="<?php echo($rs['imagem2'])?>"width="50" height="50"></td>
                            
                            <td class="coluna"><?php echo($rs['nome2'])?></td>

                            <td class="coluna"><?php echo($rs['texto1'])?></td>

                            <td class="coluna"><?php echo($rs['texto2'])?></td>

                            <td class="coluna"><?php echo($rs['texto3'])?></td>

                            <td class="coluna">
                                <a href="nossosAmbientes_CMS.php?modo=ativar&id=<?php
                                   echo($rs['id'])?>">
                                <img src="Imagens/accept.png" alt="selecionado"/>
                                </a>
                                
                                <a href="nossosAmbientes_CMS.php?modo=editar&id=<?php echo($rs['id']) ?>">
                                <img src="Imagens/editar.png" alt="selecionado"/>
                                </a>
                                
                                <a href="nossosAmbientes_CMS.php?modo=excluir&id=<?php
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