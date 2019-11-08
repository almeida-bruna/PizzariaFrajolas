<?php

session_start();

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
$botao="Salvar";


    //**************** conexao com mysql ********************
        
        //estabelece a conexao com o DB Mysql
        $conexao = mysql_connect('localhost','root','bcd127');
        //ativa a database utilizada no seu projeto
        mysql_select_db('pizzaria');
        
        //*******************************************************

    
    if(isset($_POST["btnSalvar"])){
        
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
        
        if($_POST['btnSalvar']=='Salvar'){
            
        
        
        $sql = "insert into tbl_faleconosco (nome,telefone,celular,email,homePage,linkFacebook,sugestaoCriticas,
        informacoesProdutos,sexo,profissao) 
        values('".$nome."','".$telefone."','".$celular."','".$email."','".$homePage."','".$linkFacebook."','".$sugestaoCriticas."','".$informacoesProdutos."','".$sexo."','".$profissao."')";
        
        }
        
       mysql_query($sql);
                
       header('location:faleConosco.php');
        //echo($sql);
         
    }
    
?>

<!DOCTYPY html>
<html>
    <head>
        <title>Fale Conosco</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="CSS/style_faleConosco.css">
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/slide.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            
            function validar(caracter, blockType){
                //tratamento para transformar em ascii independente do navegador
                if(window.event){
                    var letra=caracter.charCode;
                    
                }else if(caracter.which){
                    //tarnsforma o caracter digitado em ascii
                    var letra = caracter.which;
                }
                
                
                //verifica se o caracter digitado é numero
                if(blockType=='number'){
                    //verifica se o caracter digitado é numero, ou seja se estiver 
                    //digitado entre 48 e 57 conforme a tabela ascii
                    if(letra>=48 && letra<=57){
                        return false;
                    }
                }else if(blockType=='caracter'){
                    if(letra<48 || letra>57){
                        if(letra!=8 && letra!=45 && letra!=32){
                            return false;
                        }
                    }
                }
                
            }
            
        </script>
    </head>
    
    <body>
        <header>
            <div id="segura_cabecalho">
                <div id="logo">
                    <img src="imagens/logo.png" height="131px" width="201px">
                </div>
                
                
                    <div class="menu">
                    <div class="item_menu">
                        <a class="semLinha" href="home.php"><h4>Home</h4></a>
                    </div>
                    
                    <div class="item_menu">
                        <a class="semLinha" href="curiosidades.php"><h4>Curiosidades</h4></a>
                    </div>
                    
                    <div class="item_menu">
						<a class="semLinha" href="sobreApizzaria.php"><strong>Sobre a Pizzaria</strong></a>
                    </div>
                    
                    <div class="item_menu">
                        <a class="semLinha" href="promocao.php"><h4>Promoções</h4></a>
                    </div>
                    
                    <div class="item_menu">
                        <a class="semLinha" href="nossosAmbientes.php"><strong>Nossos Ambientes</strong></a>
                    </div>
                    
                    <div class="item_menu">
						<strong>A pizza do mês</strong>
                       
                    </div>
              
                </div>
               

                <!--<div id="caixa3">
                    <form name="frmLogin" method="get" action="home.php">
                        <div id="parte_usuario">
                            Usuário: <br>
                            <input type="text" name="txtNome" value="" maxlength="10" size="20px"/>
                        </div>
                        <div id="parte_senha">
                            Senha: <br>
                            <input type="password" name="txtNome" value="" maxlength="10" size="20px"/>
                            <input type="submit" name="btnSalvar" value="OK" size="16px"/>
                        </div>
                    </form>
                </div>-->
            </div>
			
        </header>
        <main>
            <div id="slide">
                Fale Conosco
            </div>
            <div id="produtos">
                     <div id="redeSociais">
                <div class="social">
                    <img src="imagens/fb.png">
                </div>
                <div class="social">
                    <img src="imagens/insta.png">
                </div>
                <div class="social">
                    <img src="imagens/gm.png">
                </div>
            </div>
            <div id="curiosidades">
                <form name="Frmcomentario" method="post" action="FaleConosco.php">
            <table id="table1">
                <tr>
                    <td colspan="2" id="contatos">
                        Cadastro de Contatos
                    </td>
                </tr>
            </table>
            <table >
                <tr>
                    <td class="coluna1">
                       Nome: 
                    </td>
                    <td class="coluna2">
                        <input placeholder="Digite seu nome..." type="text" name="txtNome" value="<?php echo($nome) ?>" size="30px" required pattern="[a-z A-Z ã Ã õ Õ é É ê Ê ô Ô ç Ç]*" title="Permitido apenas Letras" onkeypress="return validar(event,'number')" >

                    </td>
                </tr>
                <tr>
                    <td class="coluna1">
                        Telefone:
                    </td>
                    <td class="coluna2">
                        <input placeholder=" DDD XXXX-XXXX" type="text" name="txtTelefone" value="<?php echo($telefone) ?>" size="30px" pattern="[0-9]{3} [0-9]{4}-[0-9]{4}" title="Formato inválido!" onkeypress="return validar(event,'caracter')">
                    </td>
                </tr>
                <tr>
                    <td class="coluna1">
                        Celular:
                    </td>
                    <td class="coluna2">
                        <input placeholder=" DDD XXXXX-XXXX" type="text" name="txtCelular" value="<?php echo($celular) ?>" size="30px" pattern="[0-9]{3} [0-9]{5}-[0-9]{4}" required>
                    </td>
                </tr>
                <tr >
                    <td class="coluna1">
                        Email:
                    </td>
                    <td class="coluna2">
                        <input placeholder="cadrasto@contatos.com" type="email" name="txtEmail" value="<?php echo($email) ?>" size="30px" required>
                    </td>
                </tr>
                <tr>
                    <td class="coluna1">
                        Home Page:
                    </td>
                    <td class="coluna2">
                        <input type="text" name="txtHomePage" value="<?php echo($homePage) ?>" size="30px">
                    </td>
                </tr>
                <tr>
                    <td class="coluna1">
                        Link no Facebook:
                    </td>
                    <td class="coluna2">
                        <input type="text" name="txtLinkFacebook" value="<?php echo($linkFacebook) ?>" size="30px">
                    </td>
                </tr>
                
                <tr>
                    <td class="coluna1">
                        Sugestão/Criticas:
                    </td>
                    <td class="coluna2">
                        <textarea placeholder="Deixe aqui sua observação..." name="txtSugestaoCriticas" cols="32" rows="5"><?php echo($sugestaoCriticas) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="coluna1">
                        Informações de produtos:
                    </td>
                    <td class="coluna2">
                        <textarea placeholder="Deixe aqui sua observação..." name="txtInformacoesProdutos" cols="32" rows="5"><?php echo($informacoesProdutos) ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="coluna1">
                        Sexo:
                    </td>
                    <td class="coluna2">
                        <input type="radio" name="rdoSexo" value="F" <?php echo($chkfeminino) ?> checked>Feminino
                        <input type="radio" name="rdoSexo" value="M" <?php echo($chkmasculino) ?>>Masculino
                    </td>
                <tr>
                   <td class="coluna1">
                        Profissão:
                    </td>
                    <td  class="coluna2">
                        <input type="text" name="txtProfissao" value="<?php echo($profissao) ?>" size="30px">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="coluna2" id="btns">
                        <input type="submit" name="btnSalvar" value="<?php echo($botao)?>">
                        <input type="submit" name="btnLimpar" value="Limpar">
                    </td>
                </tr>
            </table>
        </form>
             </div>
				
				<footer>
             	<div id="roda">
                	<div class="ca1">
                     <div class="ca2">
                          <a class="semLinha" href="app.php">App</a>   
                     </div>
                     <div class="ca3">
                            <a class="semLinha" href="faleConosco.php">Fale Conosco</a>
                        </div>
                 </div>
                    
                 <div class="ca1">
                     <div class="ca2">
                          <a class="semLinha" href="trabalhe.php">Trablhe Conosco</a>
                     </div>
                    
                     <div class="ca3">
                          <a class="semLinha" href="redesSociais.php">Redes Sociais</a>
                     </div>
					</div>
             	</div>
                
                <div id="roda1">
                    © Copyright 2017 - Frajola's Pizzaria - Todos os direitos reservados
                    Frajola's.com Pizzaria Online S.A
                </div>
			</footer>
				
        </main>
        
    </body>
</html>