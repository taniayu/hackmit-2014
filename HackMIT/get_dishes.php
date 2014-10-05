<?php
	function getReviews($id) {
		require 'db.php';

		$query = 'SELECT review FROM table WHERE businessid = ' . $id;
	}
?>