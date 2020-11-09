<?php
session_start();
include('./dbConnection.php');
$idPoste = (int) $_GET['id_poste'];
$idStudent = $_SESSION['id_student'];
$req_vef = $bdd->query(" SELECT  COUNT(*) from liked_poste where id_poste = " . $idPoste . " and id_student =" . $idStudent . "");

if ($req_vef->fetchColumn() == 0) {

    $req = $bdd->prepare("INSERT INTO liked_poste   (id_poste,id_student)VALUES(?,?) ");
    $req->execute(array(
        $_GET['id_poste'],
        $_SESSION['id_student']
    ));
    $get_like = $bdd->query("SELECT N_like from poste where id_poste ='$idPoste' ");
    $data = $get_like->fetch();
    $req_update = $bdd->prepare("UPDATE poste SET N_like = :update_like where id_poste ='$idPoste' ");
    $req_update->execute(array(
        'update_like' => (int) $data['N_like'] + 1
    ));
    header('location:../Frontend/home-student.php');
    exit();
} else {
    $bdd->query("DELETE from liked_poste where id_poste = " . $idPoste . " and id_student =" . $idStudent . "");
    $get_like = $bdd->query("SELECT N_like from poste where id_poste ='$idPoste' ");
    $data = $get_like->fetch();
    $req_update = $bdd->prepare("UPDATE poste SET N_like = :update_like where id_poste ='$idPoste' ");
    $req_update->execute(array(
        'update_like' => $get_like - 1
    ));
    header('location:../Frontend/home-student.php');
    exit();
}
