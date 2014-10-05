<html>
<head>
	<title>Blah</title>
</head>
<body>

	<?php
		require 'db.php';
		
		$n = 'Air Quality Systems';
		$query = 'SELECT businessid FROM table WHERE names = ' . $n;
		?>
		Hello. <?
		echo "hi";
		echo $query;
		$result = mysql_query($query, $db) or die(mysql_error());
		$id = mysql_fetch_assoc($result);
	
		echo $id;
	?>
</body>
</html>