<?php
 include('../functions.php');

if ($_POST) {
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $user = authenticate($email, $password);

    if ($user) {
        session_start();
        $_SESSION['usuario'] = $user;
        header('Location: ../users.php');
        exit();
    } else {
        header('Location: ../signup.php');
        exit();
    }
}
?>
