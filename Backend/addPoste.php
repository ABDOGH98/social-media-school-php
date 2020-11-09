
<?php
session_start();
include('./dbConnection.php');

if (isset($_POST['title_poste'])) {

    $extensions_autorisees = array('jpg', 'jpeg', 'png');

    date_default_timezone_set("Africa/Lagos");
    $date = date("Y-m-d h:i a", strtotime("now"));
    $rename = "empty";

    if (isset($_FILES['poste_img']) && !empty($_FILES["poste_img"]["name"])) {
        $poste_img = $_FILES['poste_img']['name'];
        $rename = $_SESSION['pseudo']  . "-" . date("Y-m-d_h-m-sa") . "." . pathinfo($poste_img, PATHINFO_EXTENSION);

        move_uploaded_file($_FILES['poste_img']['tmp_name'], "../Frontend/poste_img/" . $poste_img);
        rename("../Frontend/poste_img/" . $poste_img, "../Frontend/poste_img/" . $rename);
    }

    $req = $bdd->prepare('INSERT INTO poste( id_student_poste,date,title_poste,img_poste ,date_end_poste)VALUES(?,?,?,?,?)');
    $req->execute(array(
        $_SESSION['id_student'],
        $date,
        $_POST['title_poste'],
        $rename,
        $_POST['end_poste'],
    ));
    header('location:../Frontend/home-student.php');
} else {
    header('location:../Frontend/home-student.php');
}
