<?php	
	$conexao=mysql_connect("localhost","root","bcd127");

	//Especifica qual database será utilizado
	mysql_select_db("pizzaria");
	
	$sql = "select * from tbl_produto;";
	
	$select = mysql_query($sql);
				
	$lstProduto= array();
	
	
	while($produto = mysql_fetch_assoc($select))
	{
		$lstProduto[] =  $produto;
	}
	
	echo json_encode($lstProduto);
	
?>