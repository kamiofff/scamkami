<?php
require 'db.php';

$login = $_POST['login'];
$password = password_hash($_POST['password'], PASSWORD_ARGON2ID);

// секрет для Steam-Guard-аналога
$secret = base64_encode(random_bytes(10));

$stmt = $db->prepare("INSERT INTO users (login,password_hash,totp_secret) VALUES (?,?,?)");
$stmt->execute([$login,$password,$secret]);

$db->prepare("INSERT INTO auth_logs (user_id,action,ip,user_agent)
VALUES (LAST_INSERT_ID(),'register',?,?)")
->execute([$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']]);

echo "Registered";
