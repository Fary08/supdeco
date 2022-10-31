<!DOCTYPE html>
<html lang="fr">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include_once 'include/header.php';
include_once 'include/navbar.php';

if (!isset($_SESSION['Email'])) {
    header('Location : login.php');
    exit();

    session_destroy();
}
?>

<body>
    <?php
    $connect = mysqli_connect("localhost", "root", "", "gestion_bourse");

    $reponse = mysqli_query($connect, "SELECT * FROM demande_bourses");
    $rep = mysqli_query($connect,"SELECT COUNT(*) Email FROM users WHERE Role = 'Etudiant'");
    $rep2 = mysqli_query($connect,"SELECT COUNT(*) Intitule FROM bourses");
    $rep3 = mysqli_query($connect,"SELECT COUNT(*) id FROM demande_bourses");
    $rep4 = mysqli_query($connect,"SELECT COUNT(*) id FROM demande_bourses WHERE Status=1");
    $don = mysqli_fetch_array($rep);
    $don2 = mysqli_fetch_array($rep2);
    $don3 = mysqli_fetch_array($rep3);
    $don4 = mysqli_fetch_array($rep4);
    ?>
    <div class="container">
        <div class=" mt-5"></div>
        <nav class="px-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb py-1">
                <li class="breadcrumb-item"><a href="Responsable.php"><i style="font-size: 24px;" class="uil uil-home"></i>Accueil</a></li>
            </ol>
        </nav>

        <div class="card mt-5">
            <div style="background-color: #fff; border: none;" class="card-header">
                <h4 class="titre">
                    <i style="font-size: 30px;" class="uil uil-create-dashboard"></i>
                    Tableau de Bord
                </h4>
            </div>
            <div class="card-body">
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-lg-3 mt-3">
                            <div class="card ">
                                <div class="card-body text-center text-primary">
                                    <i style="font-size: 60px;" class="uil uil-users-alt py-4"></i>
                                    <h2><?php echo $don['Email']; ?></h2>
                                </div>
                                <div class="card-footer text-center text-light bg-primary">
                                    <p><i class="uil uil-trophy"></i> Nombre total d'étudiants</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="card ">
                                <div class="card-body text-center text-warning">
                                    <i style="font-size: 60px;" class="uil uil-chart-line py-4"></i>
                                    <h2><?php echo $don2['Intitule']; ?></h2>
                                </div>
                                <div class="card-footer text-center text-light bg-warning">
                                    <p><i class="uil uil-trophy"></i> Nombre total de Bourses</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="card ">
                                <div class="card-body text-center text-success">
                                    <i style="font-size: 60px" class="uil uil-comment-alt py-4"></i>
                                    <h2><?php echo $don3['id']; ?></h2>
                                </div>
                                <div class="card-footer text-center text-light bg-success">
                                    <p><i class="uil uil-trophy"></i> Nombre total de Demandes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="card ">
                                <div class="card-body text-center text-info">
                                    <i style="font-size: 60px;" class="uil uil-comment-alt-check py-4"></i>
                                    <h2><?php echo $don4['id']; ?></h2>
                                </div>
                                <div class="card-footer text-center text-light bg-info">
                                    <p><i class="uil uil-trophy"></i> Demandes Approuvées</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 140px;" class="liste">
                    <div class="card mt-4">
                        <div style="background-color: #fff;" class="card-header">
                            <h4>Liste des Demandes
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table class="table table-bordered table-striped" style="width: 100%;" role="grid" aria-describedby="example-info">
                                    <thead>
                                        <tr>
                                            <td aria-label="SL: activate to sort column ascending" rowspan="1" colspan="1">ID</td>
                                            <td class="bg-primary text-white">Nom Complet</td>
                                            <td>Email</td>
                                            <td class="bg-secondary text-white">Niveau</td>
                                            <td>Moyenne</td>
                                            <td>Année Scolaire</td>
                                            <td class="bg-danger text-white">Bourse demandée</td>
                                            <td>Date Demande</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($donnees = mysqli_fetch_array($reponse)) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td class="bg-primary text-white"><?php echo $donnees['Nom_Complet']; ?></td>
                                                <td><?php echo $donnees['Email']; ?></td>
                                                <td class="bg-secondary text-white"><?php echo $donnees['Niveau_Etude']; ?></td>
                                                <td><?php echo $donnees['Moyenne_Etu']; ?></td>
                                                <td><?php echo $donnees['Annee_Scolaire']; ?></td>
                                                <td class="bg-danger text-white"><?php echo $donnees['Bourse_demande']; ?></td>
                                                <td><?php echo $donnees['Date_Demande']; ?></td>
                                                <a href=""></a>
                                                <td><?php
                                                    if ($donnees['Status'] == 0) {
                                                        echo "<p style='font-weight:bold;color:red;'>Inactive</p>";
                                                    } else {
                                                        echo "<p style='font-weight:bold;color:blue;'>Active</p>";
                                                    }
                                                    ?></td>
                                                <td>                                                   
                                                <?php echo " <a href=viewProfil.php?id=".$donnees['id']. " class='btn btn-outline-success'><i class='fa fa-eye'></i></a>";?>
                                                    <?php echo "<a href=supprimer.php?id=" .$donnees['id']. " class='btn btn-outline-danger'><i class='fa fa-minus-circle'></i></a>";?>
                                                    <?php
                                                    if ($donnees['Status'] == 1) {
                                                        echo "<a href=desactivate.php?id=" . $donnees['id'] . " class='btn btn-outline-secondary'><i class='fa fa-lock'></i></a>";
                                                    } else {
                                                        echo "<a href=activate.php?id=" . $donnees['id'] . " class='btn btn-outline-primary'><i class='fa fa-lock-open'></i></a>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        } //fin de la boucle, le tableau contient toute la BDD
                                        mysqli_close($connect); //deconnection de mysql
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .site-wrap -->
    <?php

    include_once 'include/footer.php';
    include_once 'include/script.php';

    ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>


    <script src="js/main.js"></script>

</body>

</html>