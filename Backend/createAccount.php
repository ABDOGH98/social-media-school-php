<?php

include('./dbConnection.php');


if ($_POST['gender_signup'] == "" &&  $_POST['section_signup'] == "") {
    header('location:../frontend/home.php');
} else {
    $req = $bdd->prepare('INSERT INTO students(pseudo,first_name,last_name,age,email,password,phone_number,id_section_name,gender)VALUES(?,?,?,?,?,?,?,?,?)');
    $req->execute(array(
        $_POST['pseudo_signup'],
        $_POST['first_name_signup'],
        $_POST['last_name_signup'],
        $_POST['age_signup'],
        $_POST['email_signup'],
        $_POST['password_signup'],
        $_POST['phone_signup'],
        $_POST['section_signup'],
        $_POST['gender_signup']
    ));
    header('location:../frontend/home.php');
}
