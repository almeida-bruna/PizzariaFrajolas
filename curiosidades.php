<?php
    $conexao=mysql_connect('localhost','root','bcd127');
    mysql_select_db('pizzaria');
session_start();
	
?>
<html>
	<head>
		<title>Pizzaria/Curiosidades</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="Css/style_curiosidades.css"/>
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/slide.js" type="text/javascript"></script>
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
        
        <div id="principal">
            <div id="main">
                
                <?php
                     $sql="select * from tbl_curiosidade where ativar=1 order by id desc";
                
                     $select=mysql_query($sql);
                
                     if($rs=mysql_fetch_array($select)){
                         
                
                     
                ?>
               
                <div id="video">
                    <iframe id="detalhesVideo" src="<?php echo($rs['nomevideo'])?>" frameborder="0" gesture="media" allowfullscreen></iframe>
                </div>
                
                <div id="trecho">Muitas pessoas não sabem os fatos historicos
                        que marcaram o século passado no Brasil, e pra quem estava lá é sempre bom relembrar as coisas boas daquela época! Com vocês um pouquinho das décadas de 60, 70 e 80.</div>
                
                <div class="anos">
                    <div id="titulo">Anos 60</div>
                    
                    <div class="conteudo1">
                        <?php echo($rs['texto1'])?>
                    </div>
                    
                    <div class="conteudo2">
                        <?php echo($rs['texto2'])?>
                    </div>
                    
                    <div class="imagem">
                        <img class="imagem" src="CMS/<?php echo($rs['imagem1'])?>">
                    </div>
                </div>
                
                <div class="anos">
                    <div id="titulo">Anos 70</div>
                    
                    <div class="conteudo1">
                        <?php echo($rs['texto3'])?>
                    </div>
                    
                    <div class="conteudo2">
                        <?php echo($rs['texto4'])?>
                    </div>
                    
                    <div ><img class="imagem" src="CMS/<?php echo($rs['imagem2'])?>"></div>
                </div>
                
                <div class="anos">
                    <div id="titulo">Anos 80</div>
                    
                    <div class="conteudo1">
                        <?php echo($rs['texto5'])?>
                    </div>
                    
                    <div class="conteudo2">
                        <?php echo($rs['texto6'])?>
                    </div>
                    
                    <div ><img class="imagem" src="CMS/<?php echo($rs['imagem3'])?>"></div>
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
                    © Copyright 2017 - Frajola's Pizzaria -
                    Todos os direitos reservados
                    Frajola's.com Pizzaria Online S.A
                </div>
            </footer>
        </div>
    </body>
</html>