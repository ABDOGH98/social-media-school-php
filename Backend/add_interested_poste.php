<?php
session_start();
include('./dbConnection.php');
$idPoste = (int) $_GET['id_poste'];
$idStudent = $_SESSION['id_student'];
$req_vef = $bdd->query(" SELECT  COUNT(*) from interested_poste where id_poste = " . $idPoste . " and id_student =" . $idStudent . "");


if ($req_vef->fetchColumn() == 0) {

    $req = $bdd->prepare("INSERT INTO interested_poste(id_poste,id_student)VALUES(?,?) ");
    $req->execute(array(
        $_GET['id_poste'],
        $_SESSION['id_student']
    ));
    $_SESSION['existe_poste'] = false;
    header('location:../Frontend/home-student.php');
    exit();
} else {
    $_SESSION['existe_poste'] = true;
    header('location:../Frontend/home-student.php');
    exit();
}
