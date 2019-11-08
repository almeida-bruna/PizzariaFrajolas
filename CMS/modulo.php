<?php 
//funçao para fazer conexao com o banco de dados
function Conexao_Database(){
    //Conexao com BD
    $conexao=mysql_connect('localhost','root','bcd127');
	//dando select no banco de dados pizzaria
    mysql_select_db('pizzaria');  
    
}



?>