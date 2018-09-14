<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.09.2018
 * Time: 16:34
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);

$textResult = $mysqli->query("SELECT text FROM rent_apartments WHERE id = '".$id."'");
$text = $textResult->fetch_array(MYSQLI_NUM);

echo $text[0];