<?php
session_start();
include 'connexion.php';

$req = $db->query("SELECT verification.id, CONCAT(DATE_FORMAT(verification.date_debut, '%d'), '/', DATE_FORMAT(verification.date_debut, '%m'),'/', DATE_FORMAT(verification.date_debut, '%Y')), type_verif, client.client, CONCAT(DATE_FORMAT(verification.date_prevu_fin, '%d'), '/', DATE_FORMAT(verification.date_prevu_fin, '%m'),'/', DATE_FORMAT(verification.date_prevu_fin, '%Y')), verification.commentaire, client.id
FROM `verification` 
INNER JOIN client ON client.id=verification.id_client
WHERE verification.etat=1");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Vérification en cours</title>
    <?php include 'css.php'; ?>
</head>

<body class="fixed-sn white-skin" style="background-image: url(<?= $image ?>sangomar.jpg);">
    <?php
    include 'verif_menu.php';
    ?>

    <div class="    " style="margin-top: -65px;">
        <!-- Section: Team v.1 -->
        <section class="section team-section">

            <!-- Grid row -->
            <div class="row text-center">
                <!-- Grid column -->
                <div class="card-body card-body-cascade col-md-12 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade narrower col-10 offset-1">

                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <h1 class="mb-0">Vérification(s) en cours</h1>
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
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Client</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Type Vérification</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Date début</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Date prévu fin</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Commentaire</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($donnees = $req->fetch()) {
                                            $id = $donnees['0'];
                                            $date_debut = $donnees['1'];
                                            $type_verif = $donnees['2'];
                                            $client = $donnees['3'];
                                            $date_prevu_fin = $donnees['4'];
                                            $commentaire = $donnees['5'];
                                            $id_client = $donnees['6'];

                                            echo "<tr>";
                                            echo "<td class='text-center'><b>" . $i . "</b></td>";
                                            echo "<td class='text-center'>" . $client . "</td>";
                                            echo "<td class='text-center'>" . $type_verif . "</td>";
                                            echo "<td class='text-center'>" . $date_debut . "</td>";
                                            echo "<td class='text-center'>" . $date_prevu_fin . "</td>";
                                            echo "<td class='text-center'>" . $commentaire . "</td>";
                                            echo "<td class='text-center'><b><a class='btn blue-text' data-toggle='tooltip' data-placement='top' title='Débuter la vérification' href='l_site_verif.php?v=" . $id . "'>Débuter</a></b></td>";
                                            $i++;
                                        ?>

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