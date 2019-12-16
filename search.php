<?php 
session_start();
if (isset($_POST['search'])){
	$search = $_POST['search'];
	if ($search == 'help'){
		//echo "string";
		header("Location: help.php");
		exit();
	}
	$pieces = explode(" ", $search);
	$query = "SELECT * FROM models ";
	if (strlen($pieces)<50){
		foreach ($pieces as $piece) {
			if (strlen($piece)<20) {

				
				$piece = str_replace('!','ORDER BY ',$piece);
				if (preg_match("/where/i", $query)) {
					//echo "string";
					$piece = str_replace('?','AND name = ',$piece);
					$piece = str_replace('#','AND tag = ',$piece);
					$piece = str_replace('*','AND type = ',$piece);
				} else
				{
					$piece = str_replace('?','WHERE name = ',$piece);
					$piece = str_replace('#','WHERE tag = ',$piece);
					$piece = str_replace('*','WHERE type = ',$piece);
				}
				$query = $query . " " . $piece;
			}	
		}
		//echo "$query";
		$_SESSION['search']=$query;
		//echo $_SESSION['search'];
		header("Location: index.php");
	}
}
else{
	//header("Location: index.php");
}
?>