<?php
session_start();


include 'login.html';

$bdd = new PDO('mysql:host=localhost;dbname=info834', 'root', '');

#If infos are filled
if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $bdd->prepare('SELECT * FROM users WHERE email = :email');
    $query->execute(array(':email' => $email));
    $user = $query->fetch();


    // Check Password
    if($user && $password == $user['password']) {
        // Success
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['name'] = $user['name'];
        $_SESSION['user']['last_name'] = $user['last_name'];


        // Script Python
        $data = $user['email'];

        $pythonScript = 'C:\xampp\htdocs\TP1\python\login.py';

        
        $output = shell_exec("python $pythonScript $data");

        // Value of output 1 if can connect 0 if can't
        $answer = substr($output, -2);
        echo($output);
        echo($answer);
        if ($answer == 1) {
            header('Location: success.html');
            exit;
        } else {
            header('Location: end.html');
        }
        exit;
    } else {
        // Identifiants incorrects
        $erreur = "Incorrect email or password try again";
    }
}
?>

?>