<?php 
			$servername = "localhost";
			$username_sql= "root";
			$password_sql = "";
			$dbname_sql = "labtop";

			// Create connection
			$conn = mysqli_connect($servername, $username_sql, $password_sql, $dbname_sql);
			// Check connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
 ?>