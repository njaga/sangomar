<?php
session_start();
include 'connexion.php';
$id_site = intval(htmlspecialchars($_GET['s']));

$req_site = $db->prepare("SELECT nom, localisation FROM `site` WHERE id=?");
$req_site->execute(array($id_site));
$donnees_site = $req_site->fetch();
$nom_site = $donnees_site['0'];
$localisation = $donnees_site['1'];

$req_extincteur = $db->prepare("SELECT extincteur.id, CONCAT(DATE_FORMAT(extincteur.date_ajout, '%d'), '/', DATE_FORMAT(extincteur.date_ajout, '%m'),'/', DATE_FORMAT(extincteur.date_ajout, '%Y')), extincteur.emplacement, extincteur.type, extincteur.marque, extincteur.annee_fabrication, extincteur, CONCAT(DATE_FORMAT(extincteur.date_derniere_verif, '%d'), '/', DATE_FORMAT(extincteur.date_derniere_verif, '%m'),'/', DATE_FORMAT(extincteur.date_derniere_verif, '%Y'))
FROM `extincteur`
LEFT JOIN verfi_extincteur ON verfi_extincteur.id_extincteur=extincteur.id
WHERE extincteur.etat=1 AND extincteur.id_site=? ");
$req_extincteur->execute(array($id_site));

?>
<!DOCTYPE html>
<html>

<head>
    <title>Extincteurs du site : <b><?= $nom_site ?> </title>
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
                    <a href="" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#modalExtincteur">Extincteur + </a>
                </div>
            </div>
            <div class="row text-center">
                <!-- Grid column -->
                <div class="card-body card-body-cascade col-md-12 mb-4">
                    <!-- Modal: extincteur form -->
                    <div class="modal fade" id="modalExtincteur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal" role="document">
                            <!-- Content -->
                            <div class="modal-content">
                                <!-- Header -->
                                <div class="modal-header light-blue darken-3 white-text">
                                    <h4 class="">Extincteur +</h4>
                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Body -->
                                <div class="modal-body mb-0">
                                    <form method="POST" action="e_extincteur_trmnt.php">
                                        <input type="number" name="site" value="<?= $id_site ?>" hidden>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <div class="md-form">
                                                    <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_enregistrement" name="date_enregistrement" class="form-control" required>
                                                    <label for="date_enregistrement" class="active">Date </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <select class="mdb-select md-form" name="type_extincteur" id="type_extincteur" required>
                                                    <option value='' disabled selected>Type extincteur</option>
                                                    <option value="Azote">Azote</option>
                                                    <option value="Sparklet">Sparklet</option>
                                                    <option value="CO2">CO2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5 ">
                                                <select class="browser-default custom-select md-form" name="extincteur" id="extincteur" required>
                                                    <option value='' disabled selected>Extincteur</option>
                                                    <option value="Poudre 1Kg">Poudre 1Kg</option>
                                                    <option value="Poudre 2Kg">Poudre 2Kg</option>
                                                    <option value="Poudre 6Kg">Poudre 6Kg</option>
                                                    <option value="Poudre 9Kg">Poudre 9Kg</option>
                                                    <option value="Poudre 25Kg">Poudre 25Kg</option>
                                                    <option value="Poudre 50Kg">Poudre 50Kg</option>
                                                    <option value="Poudre 150Kg">Poudre 150Kg</option>
                                                    <option value="Eau + Additif 6Kg">Eau + Additif 6Kg</option>
                                                    <option value="Eau + Additif 9Kg">Eau + Additif 9Kg</option>
                                                    <option value="Eau + Additif 25Kg">Eau + Additif 25Kg</option>
                                                    <option value="Eau + Additif 45Kg">Eau + Additif 45Kg</option>
                                                    <option value="Eau + Additif 50Kg">Eau + Additif 50Kg</option>
                                                    <option value="NC 2Kg">NC 2Kg</option>
                                                    <option value="NC 5Kg">NC 5Kg</option>
                                                    <option value="NC 10Kg">NC 10Kg</option>

                                                </select>
                                            </div>
                                            <div class="col-md-4 ">
                                                <div class="md-form">
                                                    <input type="text" value="" id="marque" name="marque" class="form-control">
                                                    <label for="marque" class="active">Marque </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="md-form">
                                                    <input type="number" value="" id="annee_fabrication" name="annee_fabrication" class="form-control">
                                                    <label for="annee_fabrication" class="active">Annee fab </label>
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
                                                    <label for="date_derniere_verif" class="active">Dernière V5/V10</label>
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

                    <!-- Card extincteurs -->
                    <div class="card card-cascade narrower col-12">

                        <!-- Card image -->
                        <div class="view view-cascade gradient-card-header blue-gradient">
                            <h3 class="mb-0">Extincteurs du site : <b><?= $nom_site ?></b>
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
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Extincteur</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Type</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Année</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Marque</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Emplacement</th>
                                            <th class="font-weight-bold text-center text-uppercase th-lg" data-field="">Derniere Verification</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($donnees = $req_extincteur->fetch()) {
                                            $azote = "d-none";
                                            $co2 = "d-none";
                                            $sparklet = "d-none";
                                            $id_ext = $donnees['0'];
                                            $date_ajout = $donnees['1'];
                                            $emplacement = $donnees['2'];
                                            $type = $donnees['3'];
                                            $marque = $donnees['4'];
                                            $annee = $donnees['5'];
                                            $extincteur = $donnees['6'];
                                            $date_derniere_verif = $donnees['7'];
                                            if ($date_derniere_verif == "") {
                                                $date_derniere_verif = "Pas encore vérifier";
                                            }
                                            if ($type == "Azote") {
                                                $azote = "";
                                                $co2 = "d-none";
                                                $sparklet = "d-none";
                                            }
                                            if ($type == "Sparklet") {
                                                $sparklet = "";
                                                $co2 = "d-none";
                                                $azote = "d-none";
                                            }
                                            if ($type == "CO2") {
                                                $co2 = "";
                                                $sparklet = "d-none";
                                                $azote = "d-none";
                                            }
                                            //Date dernère vérifiation
                                            $req_ext = $db->prepare("SELECT CONCAT(DATE_FORMAT(verfi_extincteur.date_verif, '%d'), '/', DATE_FORMAT(verfi_extincteur.date_verif, '%m'),'/', DATE_FORMAT(verfi_extincteur.date_verif, '%Y')) FROM verfi_extincteur WHERE id_extincteur=? ORDER BY date_verif DESC LIMIT 1");
                                            $req_ext->execute(array($id_ext));
                                            $donnees_ext = $req_ext->fetch();
                                            $nbr_ext = $req_ext->rowCount();
                                            if ($nbr_ext > 0) {
                                                $date_derniere_verif = $donnees_ext['0'];
                                            }


                                            echo "<tr>";
                                            echo "<td class='text-center'><b>" . $i . "</b></td>";
                                            echo "<td class='text-center'>" . $date_ajout . "</td>";
                                            echo "<td class='text-center'>" . $extincteur . "</td>";
                                            echo "<td class='text-center'>" . $type . "</td>";
                                            echo "<td class='text-center'>" . $annee . "</td>";
                                            echo "<td class='text-center'>" . $marque . "</td>";
                                            echo "<td class='text-center'>" . $emplacement . "</td>";
                                            echo "<td class='text-center'>" . $date_derniere_verif . "</td>";
                                            // echo "<td class='text-center'><a href='e_extincteur_va.php?id=" . $id_ext . "&amp;v=" . $id_verif . "' class='btn btn-primary btn-rounded'>VA+</a></td>";
                                            $i++;
                                        ?>
                                            <!-- Modal: extincteur form -->
                                            <div class="modal fade" id="modalVA<?= $id_ext ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog cascading-modal" role="document">
                                                    <!-- Content -->
                                                    <div class="modal-content">
                                                        <!-- Header -->
                                                        <div class="modal-header light-blue darken-3 white-text">
                                                            <h4 class="">Nouvelle V.A +</h4>
                                                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <!-- Body -->
                                                        <div class="modal-body mb-0">
                                                            <form method="POST" action="e_va_extincteur_trmnt.php">
                                                                <input type="number" name="site" value="<?= $id_site ?>" hidden>
                                                                <div class="row">
                                                                    <div class="col-md-4 ">
                                                                        <div class="md-form">
                                                                            <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_verfication" name="date_verfication" class="form-control">
                                                                            <label for="date_verfication" class="active">Date vérification</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <select class="browser-default custom-select md-form" name="type_verif" id="type_verif" required>
                                                                            <option value='' disabled selected>Type visite</option>
                                                                            <option value="A1">A1</option>
                                                                            <option value="V5">V5</option>
                                                                            <option value="V10">V10</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- Azote  -->
                                                                <div class="row <?= $azote ?>">
                                                                    <div class="col-md-6 ">
                                                                        <div class="md-form">
                                                                            <input type="number" value="0" id="pression_releve" name="pression_releve" class="form-control">
                                                                            <label for="pression_releve" class="active">Pression relevée</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Sparklet  -->
                                                                <div class="row <?= $sparklet ?>">
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input type="number" value="0" id="chargeur_ref" name="chargeur_ref" class="form-control">
                                                                            <label for="chargeur_ref" class="active">Chargeur Ref</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input type="number" value="0" id="poids_max" name="poids_max" class="form-control">
                                                                            <label for="poids_max" class="active">Poids Max</²label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input type="number" value="0" id="poids_min" name="poids_min" class="form-control">
                                                                            <label for="poids_min" class="active">Poids Min</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input type="number" value="0" id="poids_mesurer<?= $id_ext ?>" name="poids_mesurer" class="form-control poids_mesurer">
                                                                            <label for="poids_mesurer" class="active">Poids Mes</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input disabled type="text" value="" id="a_changer" name="a_changer" class="form-control">
                                                                            <label for="a_changer" class="active"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- CO2  -->
                                                                <div class="row <?= $co2 ?>">
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input type="number" id="chargeur_ref_co2" value="0" name="chargeur_ref_co2" class="form-control">
                                                                            <label for="chargeur_ref_co2" class="active">Chargeur Ref</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 ">
                                                                        <div class="md-form">
                                                                            <input type="number" id="poids_mes" value="0" name="poids_mes" class="form-control">
                                                                            <label for="poids_mes" class="active">Poids mesuré</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <fieldset class="form-check mt-4">
                                                                            <input class="form-check-input filled-in" name="checkbox_fixer" type="checkbox" id="checkbox<?= $id_ext ?>">
                                                                            <label class="form-check-label" for="checkbox<?= $id_ext ?>">A fixer</label>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <fieldset class="form-check mt-4">
                                                                            <input class="form-check-input filled-in" type="checkbox" id="checkbox_panneau<?= $id_ext ?>">
                                                                            <label class="form-check-label" for="checkbox_panneau<?= $id_ext ?>">Présence Panneau </label>
                                                                        </fieldset>
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