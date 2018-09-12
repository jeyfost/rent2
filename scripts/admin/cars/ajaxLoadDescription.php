<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 04.09.2018
 * Time: 16:43
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$textResult = $mysqli->query("SELECT description FROM rent_cars WHERE id = '".$id."'");
$text = $textResult->fetch_array(MYSQLI_NUM);

echo $text[0];