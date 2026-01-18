<?php
require 'db.php';

$stmt = $db->prepare("SELECT * FROM users WHERE login=?");
$stmt->execute([$_POST['login']]);
$user = $stmt->fetch();

if ($user && password_verify($_POST['password'], $user['password_hash'])) {
  session_start();
  $_SESSION['2fa'] = $user['id'];

  $db->prepare("INSERT INTO auth_logs (user_id,action,ip,user_agent)
  VALUES (?,?,?,?)")
  ->execute([$user['id'],'login',$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']]);

  header("Location: 2fa.php");
} else {
  echo "Wrong login or password";
}
