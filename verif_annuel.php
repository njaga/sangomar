<?php
session_start();
include 'connexion.php';

$req = $db->query("SELECT client.client, client.id, client.contact, client.telephone, client.email, client.adresse 
FROM `client` 
WHERE client.etat=1");

$req_va = $db->query("SELECT verif_annuel_ext.id, CONCAT(DATE_FORMAT(verif_annuel_ext.date_debut, '%d'), '/', DATE_FORMAT(verif_annuel_ext.date_debut, '%m'),'/', DATE_FORMAT(verif_annuel_ext.date_debut, '%Y')), CONCAT(DATE_FORMAT(verif_annuel_ext.date_prevu_fin, '%d'), '/', DATE_FORMAT(verif_annuel_ext.date_prevu_fin, '%m'),'/', DATE_FORMAT(verif_annuel_ext.date_prevu_fin, '%Y')), client.client, commentaire
FROM `verif_annuel_ext` 
INNER JOIN client ON client.id=verif_annuel_ext.id_client
WHERE verif_annuel_ext.etat=1");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Vérification(s) annuele(s) </title>
    <?php include 'css.php'; ?>
</head>

<body class="fixed-sn white-skin" style="background-image: url(<?= $image ?>accueil.png);">
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
                    <a href="" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modalVerif">Nouvelle Vérification <i class="fas fa-map-marker  ml-1"></i></a>
                </div>
            </div>
            <div class="row text-center">
                <!-- Grid column -->
                <div class="card-body card-body-cascade col-md-12 mb-4">
                    <!-- Modal: extincteur form -->
                    <div class="modal fade" id="modalVerif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal" role="document">
                            <!-- Content -->
                            <div class="modal-content">
                                <!-- Header -->
                                <div class="modal-header light-blue darken-3 white-text">
                                    <h4 class="">Nouvelle Vérification</h4>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Body -->
                                <div class="modal-body mb-0">
                                    <form method="POST" action="e_verif_annuel_trmnt.php">
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <div class="md-form">
                                                    <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_enregistrement" name="date_enregistrement" class="form-control" required>
                                                    <label for="date_enregistrement" class="active">Date début</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="md-form">
                                                    <input type="date" value="" id="date_prevu_fin" name="date_prevu_fin" class="form-control">
                                                    <label for="date_prevu_fin" class="active">Date prévu fin</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 ">
                                                <select class="mdb-select md-form" name="client" id="client" searchable="Recherhcer Client .." required>
                                                    <option value='' disabled selected>Client</option>
                                                    <?php
                                                    while ($donnees = $req->fetch()) {
                                                        echo "<option value='" . $donnees['1'] . "'  >" . $donnees['0'] . "  </option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group shadow-textarea col-12">
                                                <label for="commentaire"></label>
                                                <textarea class="form-control z-depth-1" id="commentaire" name="commentaire" rows="3" placeholder="Commentaire..."></textarea>
                                            </div>
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
                    <!-- Card -->
                    <div class="card card-cascade narrower col-10 offset-1">

                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <h1 class="mb-0">Liste des Vérifications d'extincteurs</h1>
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
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Date début</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Client</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Date prévu fin</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Commentaire</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Rapport</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($donnees = $req_va->fetch()) {
                                            $id = $donnees['0'];
                                            $date_debut = $donnees['1'];
                                            $date_prevu_fin = $donnees['2'];
                                            $client = $donnees['3'];
                                            $commentaire = $donnees['4'];
                                            echo "<tr>";
                                            echo "<td class='text-center'><b>" . $i . "</b></td>";
                                            echo "<td class='text-center'>" . $date_debut . "</td>";
                                            echo "<td class='text-center'>" . $client . "</td>";
                                            echo "<td class='text-center'>" . $date_prevu_fin . "</td>";
                                            echo "<td class='text-center'>Détails</td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des extincteurs vérifié' href='l_ext_site.php?s=" . $i . "'>" . str_pad($i, 2, "0", STR_PAD_LEFT) . "</a></b></td>";
                                            echo "<td class='text-center'>" . $commentaire . "</td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des extincteurs vérifié' href='l_ext_verif.php?s=" . $i . "'>Détails</a></b></td>";
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
            </div>


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