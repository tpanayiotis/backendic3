<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

// connect to the database
$db = new PDO('sqlite:ic3/db/tpp.db');
// retrieve the form data
$account_id = $_POST['account_id'];

// delete the user from the database
$stmt = $db->prepare('DELETE FROM account WHERE account_id=:account_id');
$stmt->bindParam(':account_id', $account_id);
$stmt->execute();
?>
