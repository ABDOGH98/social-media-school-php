<?php
session_start();
include('./dbConnection.php');



$reponse = $bdd->query('SELECT email,id_student,password,pseudo,first_name,last_name FROM students');
while ($donnees = $reponse->fetch()) {

    if ($donnees['email'] == $_POST['email_login'] && $donnees['password'] == $_POST['password_login']) {

        $_SESSION['id_student'] = $donnees['id_student'];
        $_SESSION['email'] = $donnees['email'];
        $_SESSION['password'] = $donnees['password'];
        $_SESSION['pseudo'] = $donnees['pseudo'];
        $_SESSION['first_name'] = $donnees['first_name'];
        $_SESSION['last_name'] = $donnees['last_name'];

        header('location:../frontend/home-student.php');
        exit();
    }
}
header('location:../frontend/home.php');
