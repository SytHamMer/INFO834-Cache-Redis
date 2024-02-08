<?php
session_start();


include 'register.html';

$bdd = new PDO('mysql:host=localhost;dbname=info834', 'root', '');
if(isset($_POST['name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = $bdd->prepare('INSERT INTO users (name, last_name, email, password) VALUES (:name, :last_name, :email, :password)');
    $query->execute(array(':name' => $name, ':last_name' => $last_name, ':email' => $email, ':password' => $password));



    $data = array('name' => $name, 'email' => $email, 'lastname' => $last_name, 'password' => $password);

    $json_data = json_encode($data);

    echo $json_data;

    $command = escapeshellcmd("python3 C:\Users\mathy\Desktop\COURS\S8\INFO834\TP1\python\register.py '$json_data'");
    $output = shell_exec($command);
    echo $output;

    // header('Location: success.html');
    // exit;
}

?>
