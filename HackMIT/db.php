<?php
	$db_user='root';
	$db_pass='hackmit';

	$db=mysql_connect('172.16.1.106',$db_user,$db_pass) or die(mysql_error());
	mysql_select_db('yelp',$db) or die(mysql_error());
?>