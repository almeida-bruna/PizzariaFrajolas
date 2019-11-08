<?php
$modo="";

 $conexao=mysql_connect('localhost','root','bcd127');
    
    //Ativa o database a ser utilizado no projeto
    mysql_select_db('pizzaria');

    $sql="SELECT * FROM tbl_produto";
    $select = mysql_query($sql);

    if($rs = mysql_fetch_array($select)){
        $descricao = $rs['descricao'];
    }


?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Css/style_detalhes.css"/>
    </head>
    <script>
        $(document).ready(function() {
          $(".fechar").click(function() {
            $(".modalContainer").slideToggle(1000);
          });
        });
	</script>
    <body>
        <a href="#" class="fechar">
            Open
        </a>
        <div id="cadastro">
            <?php echo($descricao)?>   
        </div>
    </body>
</html>