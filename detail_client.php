<?php
session_start();
include 'connexion.php';
$id = intval(htmlspecialchars($_GET['id']));

$req = $db->prepare("SELECT client.client, CONCAT(DATE_FORMAT(client.date_enregistrement, '%d'), '/', DATE_FORMAT(client.date_enregistrement, '%m'),'/', DATE_FORMAT(client.date_enregistrement, '%Y')), client.contact, client.telephone, client.email, client.adresse, CONCAT(user.prenom,' ', user.nom)  
FROM `client` 
INNER JOIN user ON user.id=client.id_user
WHERE client.id=?");
$req->execute(array($id));
$donnees = $req->fetch();
$client = $donnees['0'];
$date_enregistrement = $donnees['1'];
$contact = $donnees['2'];
$telelphone = $donnees['3'];
$email = $donnees['4'];
$adresse = $donnees['5'];
$commercial = $donnees['6'];
$id = $_GET['id'];
$req->closeCursor();

$req_site = $db->prepare("SELECT `id`, `nom`, `localisation`, CONCAT(DATE_FORMAT(date_debut, '%d'), '/', DATE_FORMAT(date_debut, '%m'),'/', DATE_FORMAT(date_debut, '%Y')), date_debut    
FROM `site` 
    WHERE etat=1 and id_client=?
    ORDER BY nom DESC");
$req_site->execute(array($id));

//requête des sites pour la liste déroulante
$req_site_liste = $db->prepare("SELECT `id`, `nom`, `localisation`   
FROM `site` 
    WHERE etat=1 and id_client=?
    ORDER BY nom DESC");
$req_site_liste->execute(array($id));

?>
<!DOCTYPE html>
<html>

<head>
    <title>Détail de Client </title>
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
                                        <input type="number" value="<?= $id ?>" name="id" hidden>
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

                    <!-- Card -->
                    <div class="card card-cascade narrower col-10 offset-1">

                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <h1 class="mb-0">Liste des sites</h1>
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
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nb Extincteur</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nb RIA</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Nb PIA</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg"></th>
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
                                            $date_debut1 = $donnees['4'];
                                            //Requête pour le nombre des extincteurs
                                            $req_extincteur = $db->prepare("SELECT COUNT(extincteur.id) 
FROM site
LEFT JOIN extincteur on extincteur.id_site=site.id
WHERE site.id=?");
                                            $req_extincteur->execute(array($id_site));
                                            $donnees_extincteur = $req_extincteur->fetch();
                                            $nbr_extincteur = $donnees_extincteur['0'];

                                            //Requête pour le nombre des RIA
                                            $req_ria = $db->prepare("SELECT COUNT(id) 
                                            FROM `ria_pia` 
                                            WHERE type='RIA' AND id_site=?");
                                            $req_ria->execute(array($id_site));
                                            $donnees_ria = $req_ria->fetch();
                                            $nbr_ria = $donnees_ria['0'];
                                            //Requête pour le nombre des PIA
                                            $req_pia = $db->prepare("SELECT COUNT(id) 
                                            FROM `ria_pia` 
                                            WHERE type='PIA' AND id_site=?");
                                            $req_pia->execute(array($id_site));
                                            $donnees_pia = $req_pia->fetch();
                                            $nbr_pia = $donnees_ria['0'];

                                            echo "<tr>";
                                            echo "<td class='text-center'><b><a class='btn btn-primary btn-rounded' href=''data-toggle='modal' data-target='#ModifSite" . $id_site . "'>" . $i . "</a></b></td>";
                                            echo "<td class='text-center'>" . $nom . "</td>";
                                            echo "<td class='text-center'>" . $localisation . "</td>";
                                            echo "<td class='text-center'>" . $date_debut . "</td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des extincteurs' href='l_ext_site.php?s=" . $id_site . "'>" . str_pad($nbr_extincteur, 2, "0", STR_PAD_LEFT) . "</a></b></td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des RIA' href='l_ria_site.php?s=" . $id_site . "'>" . str_pad($nbr_ria, 2, "0", STR_PAD_LEFT) . "</a></b></td>";
                                            echo "<td class='text-center'><b><a class='green-text' data-toggle='tooltip' data-placement='top' title='Liste des PIA' href='l_pia_site.php?s=" . $id_site . "'>" . str_pad($nbr_pia, 2, "0", STR_PAD_LEFT) . "</a></b></td>";
                                            $i++;
                                        ?>
                                            <td>
                                                <div class="modal fade" id="ModifSite<?= $id_site ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog cascading-modal" role="document">
                                                        <!-- Content -->
                                                        <div class="modal-content">
                                                            <!-- Header -->
                                                            <div class="modal-header light-blue darken-3 white-text">
                                                                <h4 class=""><i class="fas fa-map-marker "></i> Modification site</h4>
                                                                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <!-- Body -->
                                                            <div class="modal-body mb-0">
                                                                <form method="POST" action="m_site_trmnt.php">
                                                                    <input type="number" value="<?= $id_site ?>" name="id" hidden>
                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <div class="md-form">
                                                                                <input type="text" value="<?= $nom ?>" required name="nom" id="nom" class="form-control">
                                                                                <label for="nom" class="">Nom</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-10 mb-0">
                                                                            <div class="md-form">
                                                                                <input type="text" required value="<?= $localisation ?>" id="localisation" name="localisation" class="form-control">
                                                                                <label for="localisation" class="">Localisation</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6 ">
                                                                            <div class="md-form">
                                                                                <input type="date" id="date_debut" value="<?= $date_debut1 ?>" name="date_debut" class="form-control ">
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
                                            </td>
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

                <!-- Grid column -->
                <div class="col-md-4">

                    <!-- Card -->
                    <div class="card profile-card">
                        <div class="card-body pt-0 mt-0">
                            <h4>Détail Client
                                <br>
                            </h4>
                            <b><?= $client ?></b>
                            <br>
                            <b><?= $contact ?></b>

                        </div>

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