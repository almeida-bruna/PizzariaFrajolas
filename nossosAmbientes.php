<?php
    $conexao=mysql_connect('localhost','root','bcd127');
    mysql_select_db('pizzaria');
?>
<html>
	<head>
		<title>Pizzaria/Nossos Ambientes</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Css/style_nossosAmbientes.css"/>
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
                     $sql="select * from tbl_nossoambiente where ativar=1 order by id desc";
                     $select=mysql_query($sql);
                
                     if($rs=mysql_fetch_array($select)){
                         
                     
                ?>
                <div class="linhas1">
                    <div class="coluna1">
                        <img class="imagens" src="CMS/<?php echo($rs['imagem1'])?>" alt="pizzaria" />
                    </div>
                    
                    <div class="coluna2">
                        <?php echo($rs['texto1']);?>
                    </div>
                    
                    <div class="coluna3">
                        <img class="imagens" src="CMS/<?php echo($rs['imagem2'])?>" alt="pizzaria2" />
                    </div>
                </div>
                
                <div class="linhas2">
                    <div class="coluna4">
                        <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m0!4v1505689748800!6m8!1m7!1sNRBiuYsN5jueOcoMjTnsVQ!2m2!1d-23.53347152262969!2d-46.92701584994617!3f165.56787155162732!4f-9.893503371262298!5f0.7820865974627469" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    
                    <div class="coluna5">
                        <div class="espacos">
                            Alguns de nossas pizzarias mais lotadas do Brasil
                        </div>
                        <div class="sub_coluna">
                            <?php echo($rs['texto2'])?>
                        </div>
                        
                        <div class="sub_coluna">
                            <?php echo($rs['texto3'])?>
                        </div>
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