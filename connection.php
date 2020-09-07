<?php
//connect to the database
define ('server', 'localhost');
define ('dir', 'root');
define ('dir2', '');
define ('dbase', 'grouup');
$conn = mysqli_connect(server, dir, dir2, dbase);
if (!$conn)
	echo "NOT CONNECTED";
?>
