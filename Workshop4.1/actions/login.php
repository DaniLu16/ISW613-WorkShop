<?php
  require('functions.php');

  if($_POST) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $user = authenticate($email, $password);

    if($user) {
      session_start();
      $_SESSION['usuario'] = $user;
      header('Location: /users.php');
    } else {
      header('Location: /index.php?error=login');
    }
  }