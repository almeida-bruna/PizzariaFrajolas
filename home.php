<?php
    $conexao=mysql_connect('localhost','root','bcd127');
    mysql_select_db('pizzaria');
	session_start();

$valor = 0;
$pesquisa = "";


if(isset($_POST['btpesquisa'])){
    $pesquisa = $_POST['txtpesquisa'];
    $valor = 1;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['click'])){
    $c = $_GET['click'];
    
    
    if($c = "ctd"){
        $valor = 2;  
        $_SESSION['sub'] = $_GET['idSubcategoria'];
    }
}


        if(isset($_POST["btnSalvar"]))
        {
            $usuario = $_POST['txtusuario'];
            $senha = $_POST['txtsenha'];

            addslashes($sql = "SELECT * FROM tbl_usuario WHERE usuario = '".$usuario."' AND senha = '".$senha."';");

            $result = mysql_query($sql);

            if(mysql_num_rows($result) >0){

                $select = mysql_query($sql);

                $rsUsuario = mysql_fetch_array($select);

                $_SESSION['nomeUsuario'] = $rsUsuario['nome'];
                $_SESSION['idNivelUsuario'] = $rsUsuario['idNivel'];

                header('location:CMS/central.php');
            }else{
        ?>
        <script>
            alert("Usuário ou Senha incorretos!!!");
        </script>
        <?php
            }

        }
        ?>
<!doctype html>
<html>
    <head>
		<title>Pizzaria/ Home</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Css/style_home.css"/>
        <link rel="stylesheet" type="text/css" href="Css/style_detalhes.css"/>
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/slide.js" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
              $(".ver").click(function() {
                $(".modalContainer").slideToggle(1000);
              });
				
				
			  $("#menu_mobile").click(function(){
				  $("#nav").slideToggle(1000);
			  });
				
            });
            
            function Modal(idIten){
                $.ajax({
                    type: "POST",
                    url: "detalhes.php",
                    data: {id:idIten},
                    success: function(dados){
                        $('.modal').html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
       <div class="modalContainer">
            <div class="modal">

            </div>
    </div> 
        <header>
            
            
            <div id="segura_cabecalho">
                <div class="logo">
                    <img class="logo1" src="Imagens/logo.png" alt="log" />
                </div>

				<!--menu responsivo-->
				<div id ="menu_mobile">
					<!--
					<input type="checkbox" id="chk_menu"/>
					<label for="bt_menu">&#9776;</label>
					-->
				</div>
                <!----------------MENU----------------->
                <div id="nav">
                    <div id="segura_menu">
                      
                    <ul>
                        <li><a href="home.php"> Home </a></li>
                        <li><a href="curiosidades.php"> Curiosidades </a></li>
                        <li><a href="sobreApizzaria.php"> Sobre a Pizzaria </a></li>
                        <li><a href="promocao.php"> Promoções </a></li>
                        <li><a href="nossosAmbientes.php"> Nossos Ambiente </a></li>
                        <li><a href="pizzaMes.php"> Pizza do mês </a></li>
                    </ul>
                   
                    </div>
                    
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
						<a class="semLinha" href="pizzaMes.php"><strong>A Pizza do Mês</strong></a>
                       
                    </div>
              
                </div>
               
                <div class="caixa3">
                    <form name="frmLogin" method="post" action="home.php">
                        <div id="parte_usuario">
                            Usuário <br>
                            <input class="caixa_texto" type="text" name="txtusuario" maxlength="10" />
                            
                        </div>
                        <div id="parte_senha">
                            Senha <br>
                            <input class="caixa_texto" type="password" name="txtsenha" value="" maxlength="10" />
                            <input class="userBotao" type="submit" name="btnSalvar" value="ok" />
                        </div>
                    </form>
                </div>
                
    
            </div>
        </header>
        <div id="principal">
            
            <div id="redeSociais">
                <div class="social">
					<a href="https://www.facebook.com/"> <img class="imagens3" src="Imagens/facebook.png" alt="log"/></a>
                </div>
                
                <div class="social">
                    <a href="https://twitter.com/login?lang=pt">
					<img class="imagens3" src="Imagens/twitter.png" alt="log"/></a>
                </div>
                
                <div class="social">
                    <a href="https://www.instagram.com/?hl=pt-br">
					<img class="imagens3" src="Imagens/Instagram.png" alt="log"/>
                    </a>
                </div>
            </div>
            
            <main>
                <div id="slide">
					<div class="botoes">
						<a class="prev" href="#">&lang;</a>
					</div>
                    
                    <?php
                     $sql="select * from tbl_homeslide where ativar=1 order by id desc";
                
                     $select=mysql_query($sql);
                
                     if($rs=mysql_fetch_array($select)){
                         
                    ?>
					
					<div id="imagens4">
						<ul>
							<li>
								<span> </span>
								<a href="curiosidades.php"><img class="migrm" src="CMS/<?php echo($rs['imagem1']) ?>" alt="log" title="log" /></a>
							</li>
							<li>
								<span> </span>
								<a href="curiosidades.php"><img class="migrm" src="CMS/<?php echo($rs['imagem2']) ?>" alt="log" title="log" /></a></li>
							<li>
								<span> </span>
								<a href="curiosidades.php"><img class="migrm" src="CMS/<?php echo($rs['imagem3']) ?>" alt="log" title="log" /></a></li>
							<li>
								<span> </span>
								<a href="curiosidades.php"><img class="migrm" src="CMS/<?php echo(($rs['imagem4'])) ?>" alt="log" title="log" /></a></li>
							<li>
								<span> </span>
								<a href="curiosidades.php"><img class="migrm" src="CMS/<?php echo($rs['imagem5']) ?>" alt="log" title="log" /></a></li>
						</ul>
					</div>
                    
                    <?php
                     }
                    ?>

					
					<div class="botoes">
						<a class="next" href="#">&rang;</a>
					</div>
					
                </div>
                
                
                <div id="produtos">
                    
                    <div id="menu_lateral">
						
						<div id="conteiner_pesquisa">

								<form name="frmPesquisa" method="post" action="home.php">
									<input id="cont_pesquisa" type="text" name="txtpesquisa">
									<input id="botao_pesquisa" type="submit" name="btpesquisa" value="pesqu">
								</form>

						</div>
                        
                        <ul class="mainmenu">
                            <?php
                                $sql1 = "select * from tbl_categoria order by idCategoria desc";
                                $select1 = mysql_query($sql1);

                                while($rs=mysql_fetch_array($select1)){
                            ?>
                            <li class="li"><a href="#"><p class="desc_menu"><?php echo($rs['nomeCategoria']) ?></p></a>
                                <ul class="submenu">
                                    <?php
                                        $sql = "select * from tbl_subcategoria where idCategoria=".$rs['idCategoria'];
                                        $select = mysql_query($sql);

                                        while($rsConsulta=mysql_fetch_array($select)){
                                    ?>
                                    <li><a href="home.php?click=ctd&idSubcategoria=<?php echo($rsConsulta['idSubcategoria']); ?>"><p class="desc_li"><?php echo($rsConsulta['nomeSubcategoria']) ?></p></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                    ?>
                        </ul>
						
						
                    </div>
                    
                    
                      
                    <div id="descricao">
                        <div class="linha1">
							
                    <?php
                    
                     if($valor == 0){
                         
                         $sql="select * from tbl_produto order by rand() limit 10";
                     }else if($valor == 1){
                         $sql="select * from tbl_produto where nome like '%$pesquisa%' or descricao like '%$pesquisa%'";
                     }else if($valor == 2){
                         $sql="select * from tbl_produto where idSubcategoria=".$_SESSION['sub'];
                     }else{
                         $sql="select * from tbl_produto id desc";
                     }
                         
                     
                     $select=mysql_query($sql);
                
                     while($rs=mysql_fetch_array($select)){
                    ?>
                            <div class="quadradinho">
								<div class="informe">
									<?php echo($rs['nome'])?>
								
								<div class="detalhes">
									<ul>
										
										<li class="invisivel"><b>Nome:</b><?php echo($rs['nome'])?></li>
										<li class="invisivel"><b>Preço:</b><?php echo($rs['preco'])?></li>
										<li class="invisivel"><b>Descrição:</b> <?php echo($rs['descricao'])?></li>
										
									</ul>
                                    
                                    <a class="ver" href="#" onclick="Modal(<?php echo($rs["id"]) ?>)">
                            Detalhes
                        </a>
                                    
								</div>
							   </div>
                                <img class="imagens2" src="CMS/<?php echo($rs['imagem'])?>" alt="log"/>
								
                            </div>
                            
                        <?php
                     }
                    ?>
                        </div>
                        
                    </div>
                    
                </div>
            </main>
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
                
                <div id="invizivel">
                </div>
                
			</footer>
        </div>
    </body>
</html>