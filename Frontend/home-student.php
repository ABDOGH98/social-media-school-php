<?php
session_start();
include('../Backend/dbConnection.php');

date_default_timezone_set("Africa/Lagos");
$dateNow = date("Y-m-d H:i:s");
$time = strtotime($dateNow);
$id_student = $_SESSION['id_student'];

$rep = $bdd->query('SELECT * FROM poste inner join students on students.id_student = id_student_poste where  DATEDIFF(date_end_poste,CURRENT_TIMESTAMP) >= 0 order by date_end_poste desc');
$rep_interested_poste = $bdd->query("SELECT * from interested_poste inner join poste on  poste.id_poste= interested_poste.id_poste inner join students on students.id_student = poste.id_student_poste where interested_poste.id_student = '$id_student' ");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home-student.css">
    <?php include('./UIKIT-CSS.php'); ?>

    <title>Document</title>
</head>

<body>

    <nav class="uk-navbar uk-padding-small uk-child-width-1-4 principal-color " uk-grid uk-navbar uk-sticky>
        <div class="uk-navbar-center ">
            <ul class="uk--navbar-nav text-color uk-child-width-1-3 " uk-grid>
                <li class="uk-padding-large "><a class="uk-link-reset" href="#modal-sections" uk-toggle uk-icon="icon: bookmark ; ratio : 1.2"></a></li>
                <li class="uk-padding-large"><a class="uk-link-reset" href="#" uk-icon="icon: comments ; ratio : 1.2"></a></li>
                <li class="uk-padding-large"><a class="uk-link-reset" href="#" uk-icon="icon: calendar ; ratio : 1.2"></a></li>
            </ul>
        </div>
        <div class="uk-navbar-right uk-width-1-6" uk-grid>
            <ul class="uk-navbar-nav">
                <li class="black-color">
                    <img class="uk-border-circle " src="profil_img/1.jpg" alt="">
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav ">

                            <div>
                                <a class="uk-link-reset " href="#">
                                    <span class="black-text-color" uk-icon="icon: cog; ratio:1.1 "></span>
                                    <li class="uk-inline black-text-color uk-margin-small-left"><b>Setting</b></li>
                                </a>
                            </div>

                            <div class="uk-margin-small-top">
                                <a class="uk-link-reset" href="#">
                                    <span class="uk-text-danger" uk-icon="icon: sign-out;ratio:1.1 "></span>
                                    <li class="uk-inline uk-text-danger uk-margin-small-left"><b>SIGN-OUT</b></li>
                                </a>
                            </div>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>

    </nav>
    <?php
    if (isset($_SESSION['all_delete_success']) && $_SESSION['all_delete_success'] == true) {
    ?>
        <div class="uk-alert-success uk-margin-remove" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><b>ALL INTERESTED POSTS DELETED SUCCESSFULLY</b></p>
        </div>
    <?php
        unset($_SESSION['all_delete_success']);
    } elseif (isset($_SESSION['all_delete_success']) && $_SESSION['all_delete_success'] == false) {
    ?>
        <div class="uk-alert-success uk-margin-remove" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><b>THE POST WAS DELETED SUCCESSFULLY</b></p>
        </div>
    <?php
        unset($_SESSION['all_delete_success']);
    }
    if (isset($_SESSION['existe_poste']) && $_SESSION['existe_poste'] == true) {
    ?>
        <div class="uk-alert-danger uk-margin-remove" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><b>THIS POSTE WAS ALREADY EXISTE IN YOUR INTERESTED POSTE</b></p>
        </div>
    <?php
        unset($_SESSION['existe_poste']);
    } elseif (isset($_SESSION['existe_poste']) && $_SESSION['existe_poste'] == false) {
    ?>
        <div class="uk-alert-success uk-margin-remove" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><b>THIS POSTE WAS ADDED IN YOUR INTERESTED POSTE</b></p>
        </div>
    <?php
        unset($_SESSION['existe_poste']);
    }
    ?>
    <!-- ***************************** Interested Poste *************************** -->
    <form action="../Backend/delete_interested_poste.php" method="POST">
        <div id="modal-sections" uk-modal>
            <div class="uk-modal-dialog uk-width-3-5@s">
                <button class="uk-modal-close-default" type="button" uk-close></button>
                <div class="uk-modal-header">
                    <h2 class="uk-modal-title">Interested Event</h2>
                </div>
                <div class="uk-modal-body">
                    <table class="uk-table uk-table-justify uk-table-divider">
                        <thead>
                            <tr>
                                <th class="uk-width-medium">Event publisher</th>
                                <th class="uk-width-medium">Evenet Date</th>
                                <th>Delete event from inerested</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($donnees_interested_poste = $rep_interested_poste->fetch()) {
                                $idPoste = $donnees_interested_poste['id_poste'];
                            ?>
                                <tr>
                                    <td><img class="uk-preserve-width uk-border-circle " src="index_img/1.jpg" width="60" alt=""><?php echo strtoupper($donnees_interested_poste['last_name']) . " " . $donnees_interested_poste['first_name']; ?> </td>
                                    <td> <?php echo $donnees_interested_poste['date_end_poste']; ?> </td>
                                    <td><a href="../Backend/delete_interested_poste.php? <?php echo "deleteAll=false&amp" . ";" . "idPoste=" . $idPoste ?> " class=" uk-button uk-button-danger" type="button"> <b>Delete</b> </a></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <a class="uk-button uk-button-default uk-modal-close" type="button">Cancel</a>
                    <a class="uk-button uk-button-danger" href="../Backend/delete_interested_poste.php? <?php echo "deleteAll=true" ?> " type="button">DELETE ALL</a>
                </div>
            </div>
        </div>
    </form>
    <!--************************* add Post *****************************************-->
    <form action="../Backend/addPoste.php" method="POST" enctype="multipart/form-data">
        <div class="card-position uk-card uk-card-default uk-width-3-5 uk-border-rounded">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">Add Poste</h3>

                    </div>

                </div>
            </div>
            <div class="uk-card-footer   uk-margin-remove-left uk-padding-medium-bottom">
                <div>
                    <textarea name="title_poste" class="uk-width-1-1" id="inputPoster" rows="5" maxlength="10000" placeholder="What you want to say <?php echo $_SESSION['first_name'] ?> !!!"></textarea>
                </div>
                <div class="add-to-post">
                    <div class="uk-form-custom ">
                        <button id="add-image" class="upload-img" tabindex="-1" uk-icon="icon: image ; ratio : 1.5">
                            <input name="poste_img" type="file">
                        </button>
                    </div>
                    <input name="end_poste" type="datetime-local" min="<?php echo date('Y:m:dTh:i:sa') ?>" class="uk-input uk-width-1-4@l uk-width-1-1@s">

                </div>
                <input class="uk-button uk-button-default uj-width-1-1 uk-input" type="submit" value="Publish">

            </div>

        </div>
    </form>
    <!--*********************************Post*************************************************-->
    <div>
        <?php while ($donnees = $rep->fetch()) { ?>
            <div class=" card-position uk-card principal-color uk-width-3-5 uk-border-rounded">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto ">
                            <img class="uk-border-circle " src="profil_img/1.jpg">
                        </div>
                        <div class="uk-width-expand">
                            <h6 class=" uk-margin-remove-bottom text-color "><?php echo $donnees['first_name'] . " " . strtoupper($donnees['last_name']); ?></h6>
                            <p class="uk-text-meta uk-margin-remove-top">
                                <time>
                                    <small><?php echo $donnees['date']; ?></small>
                                </time>
                            </p>
                        </div>
                        <div><?php
                                $endDate = (float) strtotime($donnees['date_end_poste']);
                                $twoH = (float) strtotime(date('Y-m-d H:i ', strtotime('+2 hour'))) - time();
                                if ($endDate - $time >= -$twoH && $endDate - $time < 0) { ?>
                                <span class="badge badge-pill badge-success" uk-tooltip="Event Starting"><?php echo $donnees['date_end_poste']; ?></span>
                            <?php } else if ($endDate - $time < 0) { ?>
                                <span class="badge badge-pill badge-danger" uk-tooltip="Event End"><?php echo $donnees['date_end_poste']; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-pill badge-light" uk-tooltip="Soon ..."><?php echo $donnees['date_end_poste']; ?></span>
                            <?php  } ?>
                        </div>

                    </div>
                    <div class="uk-comment uk-margin-small-left">
                        <p class="uk-text-normal text-color"> <?php echo $donnees['title_poste']; ?> </p>
                    </div>
                </div>

                <div class="uk-card-body-padding ">
                    <img class="img-hight " src="poste_img/<?php echo $donnees['img_poste']; ?>" alt="">
                </div>
                <?php
                $id_poste_reaction = $donnees['id_poste'];
                $req_poste_star = $bdd->query(" SELECT  count('$id_poste_reaction') from interested_poste where id_poste = " . $id_poste_reaction . " and id_student =" . $id_student . "");
                $req_poste_like = $bdd->query(" SELECT  count('$id_poste_reaction') from liked_poste where id_poste = " . $id_poste_reaction . " and id_student =" . $id_student . "");
                ?>
                <div class="uk-card-footer footer-back-color uk-width-1-1">
                    <form action="">
                        <?php if ($req_poste_like->fetchColumn() > 0) { ?>
                            <div class="uk-form-custom uk-margin-small-right uk-margin-small-left">
                                <a name="poste_heart" class="uk-link-reset" href="../Backend/liked_poste.php?id_poste=<?php echo $donnees['id_poste']; ?>">
                                    <span class="uk-icon-like " uk-icon=" icon: heart ; ratio : 1.5" uk-tooltip="Like"></span>
                                </a>
                                <span class="uk-badge"><?php echo $donnees['N_like']; ?></span>
                            </div>
                        <?php } else { ?>
                            <div class="uk-form-custom uk-margin-small-right uk-margin-small-left">
                                <a name="poste_heart" class="uk-link-reset" href="../Backend/liked_poste.php?id_poste=<?php echo $donnees['id_poste']; ?>">
                                    <span uk-icon=" icon: heart ; ratio : 1.5" uk-tooltip="Like"></span>
                                </a>
                                <span class="uk-badge"><?php echo $donnees['N_like']; ?></span>
                            </div>
                        <?php }
                        $req_poste_like->closeCursor(); ?>
                        <div class="uk-form-custom uk-margin-small-right uk-margin-small-left">
                            <a name="poste_comment" class="uk-icon " uk-icon="icon: comment ; ratio : 1.5" uk-tooltip="Comment"></a>
                            <span class="uk-badge">0</span>
                        </div>
                        <?php if ($req_poste_star->fetchColumn() > 0) { ?>
                            <div class="uk-form-custom uk-margin-small-right uk-margin-small-left">
                                <a name="poste_star" class="uk-link-reset" href="../Backend/add_interested_poste.php?id_poste=<?php echo $donnees['id_poste']; ?>" uk-tooltip="Intersted">
                                    <span class="uk-icon-interested" uk-icon="icon: star ; ratio : 1.6"></span>
                                </a>
                            </div>
                        <?php } else { ?>
                            <div class="uk-form-custom uk-margin-small-right uk-margin-small-left">
                                <a name="poste_star" class="uk-link-reset" href="../Backend/add_interested_poste.php?id_poste=<?php echo $donnees['id_poste']; ?>" uk-tooltip="Intersted">
                                    <span uk-icon="icon: star ; ratio : 1.6"></span>
                                </a>
                            </div>
                        <?php }
                        $req_poste_star->closeCursor(); ?>

                    </form>
                </div>
            </div>
        <?php } ?>
        <!-- *********************************************** -->


    </div>

    <?php include('./UIKIT-JS.php'); ?>
</body>

</html>