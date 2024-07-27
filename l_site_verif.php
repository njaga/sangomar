<?php
session_start();
include 'connexion.php';
$id_verif = intval(htmlspecialchars($_GET['v']));

//Infos Vérifcation
$req_verif = $db->prepare("SELECT CONCAT(DATE_FORMAT(verification.date_debut, '%d'), '/', DATE_FORMAT(verification.date_debut, '%m'),'/', DATE_FORMAT(verification.date_debut, '%Y')), type_verif, CONCAT(DATE_FORMAT(verification.date_prevu_fin, '%d'), '/', DATE_FORMAT(verification.date_prevu_fin, '%m'),'/', DATE_FORMAT(verification.date_prevu_fin, '%Y')), verification.id_client
FROM `verification` 
WHERE verification.id=?");
$req_verif->execute(array($id_verif));
$donnees_verif = $req_verif->fetch();
$date_debut_verif = $donnees_verif['0'];
$type_verif = $donnees_verif['1'];
$date_fin_verif = $donnees_verif['2'];
$id_client = $donnees_verif['3'];

$req = $db->prepare("SELECT client.client, CONCAT(DATE_FORMAT(client.date_enregistrement, '%d'), '/', DATE_FORMAT(client.date_enregistrement, '%m'),'/', DATE_FORMAT(client.date_enregistrement, '%Y')), client.contact, client.telephone, client.email, client.adresse, CONCAT(user.prenom,' ', user.nom)  
FROM `client` 
INNER JOIN user ON user.id=client.id_user
WHERE client.id=?");
$req->execute(array($id_client));
$donnees = $req->fetch();
$client = $donnees['0'];
$date_enregistrement = $donnees['1'];
$contact = $donnees['2'];
$telelphone = $donnees['3'];
$email = $donnees['4'];
$adresse = $donnees['5'];
$commercial = $donnees['6'];
$req->closeCursor();

$req_site = $db->prepare("SELECT `id`, `nom`, `localisation`, CONCAT(DATE_FORMAT(date_debut, '%d'), '/', DATE_FORMAT(date_debut, '%m'),'/', DATE_FORMAT(date_debut, '%Y'))    
FROM `site` 
    WHERE etat=1 and id_client=?
    ORDER BY nom DESC");
$req_site->execute(array($id_client));

//requête des sites pour la liste déroulante
$req_site_liste = $db->prepare("SELECT `id`, `nom`, `localisation`   
FROM `site` 
    WHERE etat=1 and id_client=?
    ORDER BY nom DESC");
$req_site_liste->execute(array($id_client));



?>
<!DOCTYPE html>
<html>

<head>
    <title>Détail de Vérification </title>
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
            <br>
            <div class="row">
                <div class="text-left">
                    <a href="" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modalSiteForm">Nouveau site <i class="fas fa-map-marker  ml-1"></i></a>
                </div>
            </div>
            <div class="row text-center">
                <!-- Grid column -->
                <div class="card-body card-body-cascade col-md-12 mb-4">

                    <!-- Modal: Client form -->
                    <div class="modal fade" id="modalSiteForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal" role="document">
                            <!-- Content -->
                            <div class="modal-content">
                                <!-- Header -->
                                <div class="modal-header light-blue darken-3 white-text">
                                    <h4 class=""><i class="fas fa-map-marker "></i> Nouveau site</h4>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Body -->
                                <div class="modal-body mb-0">
                                    <form method="POST" action="e_site_trmnt.php">
                                        <input type="number" value="<?= $id_client ?>" name="id" hidden>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="md-form">
                                                    <input type="text" required name="nom" id="nom" class="form-control">
                                                    <label for="nom" class="">Nom</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10 mb-0">
                                                <div class="md-form">
                                                    <input type="text" required id="localisation" name="localisation" class="form-control">
                                                    <label for="localisation" class="">Localisation</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 ">
                                                <div class="md-form">
                                                    <input type="date" id="date_debut" name="date_debut" class="form-control ">
                                                    <label for="date_debut" class="active">Date déut</label>
                                                </div>
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
                    <!-- Modal: client form -->
                    <!-- Card -->
                    <div class="card card-cascade narrower col-10 offset-1">

                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <h1 class="mb-0">Liste des sites de : <b> <?= $client ?></b></h1>
                            <h3 class="mb-0"> <b> <?= $type_verif ?></b> du <b> <?= $date_debut_verif ?></b> au <b> <?= $date_fin_verif ?></b> </h3>
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
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nom du site</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Emplacement</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Date début</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nbr Extincteur</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nbr RIA</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nbr PIA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($donnees = $req_site->fetch()) {
                                            $id_site = $donnees['0'];
                                            $nom = $donnees['1'];
                                            $localisation = $donnees['2'];
                                            $date_debut = $donnees['3'];
                                            //Requête pour le nombre des extincteurs
                                            $req_extincteur = $db->prepare("SELECT COUNT(extincteur.id) 
                                            FROM site
                                            LEFT JOIN extincteur on extincteur.id_site=site.id
                                            WHERE site.id=? AND extincteur.etat=1");
                                            $req_extincteur->execute(array($id_site));
                                            $donnees_extincteur = $req_extincteur->fetch();
                                            $nbr_extincteur = $donnees_extincteur['0'];

                                            //Requête pour le nombre des RIA
                                            $req_ria = $db->prepare("SELECT COUNT(ria_pia.id) 
                                            FROM site
                                            LEFT JOIN ria_pia on ria_pia.id_site=site.id
                                            WHERE site.id=? AND ria_pia.etat=1 AND ria_pia.type='RIA'");
                                            $req_ria->execute(array($id_site));
                                            $donnees_ria = $req_ria->fetch();
                                            $nbr_ria = $donnees_ria['0'];

                                            echo "<tr>";
                                            echo "<td class='text-center'><b>" . $i . "</b></td>";
                                            echo "<td class='text-center'>" . $nom . "</td>";
                                            echo "<td class='text-center'>" . $localisation . "</td>";
                                            echo "<td class='text-center'>" . $date_debut . "</td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des extincteurs' href='l_ext_verif.php?s=" . $id_site . "&amp;v=" . $id_verif . "'>" . str_pad($nbr_extincteur, 2, "0", STR_PAD_LEFT) . "</a></b></td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des RIA' href='l_ria_site.php?s=" . $id_site . "&amp;v=" . $id_verif . "'>" . str_pad($nbr_ria, 2, "0", STR_PAD_LEFT) . "</a></b></td>";
                                            $i++;
                                        ?>

                                        <?php
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="text-left align-right col-4">
                                    <a href="f_verification.php?id=<?= $id_verif ?>" class="btn red btn-rounded white-text">Terminer la vérification <i class="fas fa-map-marker  ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Card content -->

                    </div>
                    <!-- Card -->
                </div>

                <!-- Grid column -->
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