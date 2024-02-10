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

    // echo $json_data;
    // Écrire les données JSON dans un fichier
    $json_file = '../python/user.json';
    file_put_contents($json_file, $json_data);

    // Chemin vers votre script Python
    $pythonScript = 'C:\Users\mathy\Desktop\COURS\S8\INFO834\TP1\python\register.py';

    // Exécuter le script Python avec le fichier JSON en argument
    $output = shell_exec("python $pythonScript $json_file");

    // Afficher la sortie du script Python
    // echo $output;
    header('Location: success.html');
    exit;
}

?>
