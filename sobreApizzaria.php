<?php
    $conexao=mysql_connect('localhost','root','bcd127');
    mysql_select_db('pizzaria');

?>
<html>
	<head>
		<title>Pizzaria/Sobre a Pizzaria</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Css/style_sobrePizzaria.css"/>
    </head>
    <body>
        <header>
            <div id="segura_cabecalho">
                <div class="logo">
                    <img class="logo1" src="Imagens/logo.png" alt="log" />
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
  
            </div>
        </header>
		<div id="principal3">
			<div id="main3">
                <?php
                     $sql="select * from tbl_sobrepizzaria  order by id desc";
                     $select=mysql_query($sql);
                
                     if($rs=mysql_fetch_array($select)){
                    
                     
                ?>
				<div class="cont_linhas1">
                    <?php echo($rs['texto1'])?>
                    <p>
                        <?php echo($rs['texto2'])?>
                    </p>
				</div>
				
				<div class="cont_linhas">
					<div class="coluna1">
						<img class="imagens7" src="CMS/<?php echo($rs['imagem1'])?>"/>
					</div>
					
					<div class="coluna2">
                        <?php echo($rs['texto3'])?>
                        <p>
                            <?php echo($rs['texto4'])?>
                        </p>
                        
					</div>
				</div>
				
				<div class="cont_linhas">
                    <?php echo($rs['texto5'])?>
				</div>
				
				<div class="cont_linhas">
					
					<div class="coluna3">
                        <?php echo($rs['texto6'])?>
                        <p>
                            <?php echo($rs['texto7'])?>
                        </p>
					</div>
					
					<div class="coluna4">
						<img class="imagens7" src="CMS/<?php echo($rs['imagem2'])?>"/>
					</div>
				</div>
                
                <?php
                     }
                ?>

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
		</div>
    </body>
</html>