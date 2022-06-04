<?php

$connection = new mysqli("localhost", "root", "", "project");

if($connection->connect_error)
{
	echo "Error in Connection";
}

?>