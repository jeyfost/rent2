<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 03.09.2018
 * Time: 12:25
 */

include("../../connect.php");

$req = false;
ob_start();

$id = $mysqli->real_escape_string($_POST['textSelect']);
$text = $mysqli->real_escape_string($_POST['text']);

if($mysqli->query("UPDATE rent_text SET text = '".$text."' WHERE id = '".$id."'")) {
    echo "ok";
} else {
    echo "failed";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;