<?php
session_start();
include 'connexion.php';
$id_site = intval(htmlspecialchars($_GET['s']));

$req_site = $db->prepare("SELECT nom, localisation FROM `site` WHERE id=?");
$req_site->execute(array($id_site));
$donnees_site = $req_site->fetch();
$nom_site = $donnees_site['0'];
$localisation = $donnees_site['1'];

$req_ria = $db->prepare("SELECT ria_pia.id, CONCAT(DATE_FORMAT(ria_pia.date_ajout, '%d'), '/', DATE_FORMAT(ria_pia.date_ajout, '%m'),'/', DATE_FORMAT(ria_pia.date_ajout, '%Y')), ria_pia.emplacement, ria_pia.type, ria_pia.marque,  CONCAT(DATE_FORMAT(ria_pia.date_derniere_verif, '%d'), '/', DATE_FORMAT(ria_pia.date_derniere_verif, '%m'),'/', DATE_FORMAT(ria_pia.date_derniere_verif, '%Y'))
FROM `ria_pia`
WHERE ria_pia.type='RIA' AND ria_pia.etat=1 AND ria_pia.id_site=?");
$req_ria->execute(array($id_site));


?>
<!DOCTYPE html>
<html>

<head>
    <title>RIA Client</title>
    <?php include 'css.php'; ?>
</head>

<body class="fixed-sn white-skin" style="background-image: url(<?= $image ?>SANGOMAR.jpg);">
    <?php
    include 'verif_menu.php';
    ?>

    <div class="    " style="margin-top: -65px;">
        <!-- Section: Team v.1 -->
        <section class="section team-section">

            <!-- Grid row -->
            <br>
            <div class="row">
                <div class="text-left">
                    <a href="" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modalRIA">RIA + </a>
                </div>
            </div>
            <div class="row text-center">
                <!-- Grid column -->
                <div class="card-body card-body-cascade col-md-12 mb-4">
                    <!-- Modal: extincteur form -->
                    <div class="modal fade" id="modalRIA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal" role="document">
                            <!-- Content -->
                            <div class="modal-content">
                                <!-- Header -->
                                <div class="modal-header light-blue darken-3 white-text">
                                    <h4 class="">RIA +</h4>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Body -->
                                <div class="modal-body mb-0">
                                    <form method="POST" action="e_ria_trmnt.php">
                                        <input type="number" name="site" value="<?= $id_site ?>" hidden>
                                        <input type="text" name="type_ria" value="PIA" hidden>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <div class="md-form">
                                                    <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_enregistrement" name="date_enregistrement" class="form-control" required>
                                                    <label for="date_enregistrement" class="active">Date </label>
                                                </div>
                                            </div>
                                            <div class="col-md-5 ">
                                                <div class="md-form">
                                                    <input type="text" value="" id="marque" name="marque" class="form-control">
                                                    <label for="marque" class="active">Marque </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="md-form">
                                                    <input type="text" value="" id="emplacement" name="emplacement" class="form-control" required>
                                                    <label for="emplacement" class="active">Emplacement </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 ">
                                                <div class="md-form">
                                                    <input type="date" value="" id="date_derniere_verif" name="date_derniere_verif" class="form-control">
                                                    <label for="date_derniere_verif" class="active">Dernière vérification</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <select class="mdb-select md-form" name="type_derniere_verif" id="type_derniere_verif">
                                                    <option value='' selected>Type dernière verif</option>
                                                    <option value="V5">V5</option>
                                                    <option value="V10">V10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="md-form">
                                                    <input type="text" value="" id="verificateur" name="verificateur" class="form-control">
                                                    <label for="verificateur" class="active">Vérificateur </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn blue-gradient">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Content -->
                        </div>
                    </div>
                    <!-- Modal: extincteur form -->

                    <!-- Card en attente de vérification -->
                    <div class="card card-cascade narrower col-12">

                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <h3 class="mb-0">RIA du site : <b><?= $nom_site ?></b>
                            </h3>
                        </div>
                        <!-- /Card image -->

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center table-responsive">
                            <div class="row">
                                <div class="col-6 sm-4">
                                    <form class="form-inline d-flex justify-content-center md-form form-sm mt-0">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                        <input class="form-control form-control-sm ml-3 w-75 search" name="search" type="text" placeholder="Recherche" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                            <div class="row table-responsive ">
                                <table class="table  table-hover w-auto centered  card-body ml-3">
                                    <thead class="">
                                        <tr>
                                            <th class="font-weight-bold text-center text-uppercase" data-field="">#</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Date pose</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Marque</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Emplacement</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Derniere Verification</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($donnees = $req_ria->fetch()) {
                                            $id_ria = $donnees['0'];
                                            $date_ajout = $donnees['1'];
                                            $emplacement = $donnees['2'];
                                            $type = $donnees['3'];
                                            $marque = $donnees['4'];
                                            $date_derniere_verif = $donnees['5'];
                                            if ($date_derniere_verif == "") {
                                                $date_derniere_verif = "Pas encore vérifier";
                                            }

                                            //Date dernère vérifiation
                                            $req_ria_verif = $db->prepare("SELECT CONCAT(DATE_FORMAT(verfi_ria.date_verif, '%d'), '/', DATE_FORMAT(verfi_ria.date_verif, '%m'),'/', DATE_FORMAT(verfi_ria.date_verif, '%Y')) FROM verfi_ria WHERE id_ria=? ORDER BY date_verif DESC LIMIT 1");
                                            $req_ria_verif->execute(array($id_ria));
                                            $donnees_ria_verif = $req_ria_verif->fetch();
                                            $nbr_ria = $req_ria_verif->rowCount();
                                            if ($nbr_ria > 0) {
                                                $date_derniere_verif = $donnees_ria_verif['0'];
                                            }


                                            echo "<tr>";
                                            echo "<td class='text-center'><b>" . $i . "</b></td>";
                                            echo "<td class='text-center'>" . $date_ajout . "</td>";
                                            echo "<td class='text-center'>" . $marque . "</td>";
                                            echo "<td class='text-center'>" . $emplacement . "</td>";
                                            echo "<td class='text-center'>" . $date_derniere_verif . "</td>";
                                            echo "<td class='text-center'><a href='e_ria_va.php?id=" . $id_ria . "' class='btn btn-primary btn-rounded'>VA+</a></td>";
                                            $i++;
                                        ?>

                                            <!-- Modal: extincteur form -->
                                        <?php
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Card content -->

                    </div>
                    <!-- Card -->
                </div>

                <!-- Grid column -->

            </div>
            <!-- Grid row -->


        </section>
        <!-- Section: Team v.1 -->

    </div>

</body>
<?php include 'footer.php'; ?>
<?php include 'js.php'; ?>
<style type="text/css">
    body {
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #999;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('.mdb-select').materialSelect();
        $('[data-toggle="tooltip"]').tooltip();



    })
</script>

</html>