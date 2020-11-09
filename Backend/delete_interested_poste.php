<?php
session_start();
include('./dbConnection.php');

$id = $_SESSION['id_student'];

if ($_GET['deleteAll'] == 'true') {
    $bdd->exec("DELETE from interested_poste where id_student='$id' ");
    $_SESSION['all_delete_success'] = true;
    header('location:../frontend/home-student.php');
    exit();
} else if (isset($_GET['idPoste'])) {
    $bdd->exec("DELETE from interested_poste where id_student='$id' and id_poste =" . $_GET['idPoste']);
    $_SESSION['all_delete_success'] = false;
    header('location:../frontend/home-student.php');
    exit();
} else {
    header('location:../frontend/home-student.php');
}
