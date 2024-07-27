<?php
session_start();
if (!isset($_SESSION['id_vigilus_user'])) {
?>
    <script type="text/javascript">
        alert("Veillez d'abord vous connectez !");
        window.location = 'index.php';
    </script>
<?php
}
$id = intval($_GET['id']);

include 'connexion.php';
$id = $_GET['id'];
$id_verif = $_GET['v'];
$req_ext = $db->prepare("SELECT CONCAT(DATE_FORMAT(`date_ajout`, '%d'), '/', DATE_FORMAT(`date_ajout`, '%m'),'/', DATE_FORMAT(`date_ajout`, '%Y')), `type`, `extincteur`, `emplacement`, `marque`, `annee_fabrication`, CONCAT(DATE_FORMAT(`date_derniere_verif`, '%d'), '/', DATE_FORMAT(`date_derniere_verif`, '%m'),'/', DATE_FORMAT(`date_derniere_verif`, '%Y')), `type_dernier_verif`, `verificateur`, DATE_FORMAT(`date_derniere_verif`, '%Y') FROM `extincteur` WHERE id=?");
$req_ext->execute(array($id));
$nbr = $req_ext->rowCount();
$donnees_ext = $req_ext->fetch();

$date_enregistrement = $donnees_ext['0'];
$type_ext = $donnees_ext['1'];
$extincteur = $donnees_ext['2'];
$emplacement = $donnees_ext['3'];
$marque = $donnees_ext['4'];
$annee_fabrication = $donnees_ext['5'];
$date_derniere_visite = $donnees_ext['6'];
$type_derniere_visite = $donnees_ext['7'];
$verificateur = $donnees_ext['8'];
$anne_derniere_visite = $donnees_ext['9'];

//Dernière vérification
$req_verif = $db->prepare("SELECT CONCAT(DATE_FORMAT(date_verif, '%d'), '/', DATE_FORMAT(date_verif, '%m'),'/', DATE_FORMAT(date_verif, '%Y')), type, DATE_FORMAT(date_verif, '%Y') FROM `verfi_extincteur` WHERE id_extincteur=? ORDER BY date_verif DESC LIMIT 1");
$req_verif->execute(array($id));
$donnees_verif = $req_verif->fetch();
$nbr = $req_verif->rowCount();
if ($nbr > 0) {
    $date_derniere_visite = $donnees_verif['0'];
    $type_derniere_visite = $donnees_verif['1'];
    $anne_derniere_visite = $donnees_verif['2'];
}

if ($type_ext == "Azote") {
    $azote = "";
    $co2 = "d-none";
    $sparklet = "d-none";
}
if ($type_ext == "Sparklet") {
    $sparklet = "";
    $co2 = "d-none";
    $azote = "d-none";
}
if ($type_ext == "CO2") {
    $co2 = "";
    $sparklet = "d-none";
    $azote = "d-none";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Vérification extincteur</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>SANGOMAR.jpg);">
    <?php
    include 'verif_menu.php';
    ?>
    <div class="card-body card-body-cascade  white">
        <div class="row">
            <div class="col m1 s6">
                Extincteur : <b><?= $type_ext ?> <?= $extincteur ?></b>
            </div>
            <div class="col m1 s6">
                Dernière Verification : <b><?= $date_derniere_visite ?> : <?= (date('Y') - $anne_derniere_visite) ?> An</b>
                <br>
                Type dernière Verification : <b><?= $type_derniere_visite ?></b>

            </div>
            <div class="col m1 s6">
                Emplacement : <b><?= $emplacement ?></b>
                <br>
                Année : <b><?= $annee_fabrication ?></b> Âge : <b><?= (date('Y') - $annee_fabrication) ?></b>
                <br>
                <input type="text" value="" id="reepreuve_annee" name="reepreuve_annee" class="form-control">
            </div>
        </div>
    </div>
    <main class="container-fluid">

        <div class="row">
            <!-- Section: add employe -->
            <section class="mb-5 col-6 offset-md-3">

                <!-- Card -->
                <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h4 class="mb-0"><b> Vérification extincteur </b></h4>
                    </div>
                    <!-- /Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center table-responsive">
                        <form method="POST" action="e_va_extincteur_trmnt.php">
                            <input type="text" name="date_derniere_visite" value=" <?= $date_derniere_visite ?>" hidden>
                            <input type="number" name="id_extincteur" value="<?= $id ?>" hidden>
                            <input type="text" name="type_ext" value="<?= $type_ext ?>" hidden>
                            <input type="number" name="id_verif" value="<?= $id_verif ?>" hidden>
                            <input type="number" name="age_ext" id="age_ext" value="<?= (date('Y') - $annee_fabrication) ?>" hidden>
                            <div class="row">

                            </div>
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
                                        <option value="VA">VA</option>
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
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input disabled type="text" value="" id="a_charger_azote" name="a_charger_azote" class="form-control">
                                        <label for="a_charger_azote" class="active"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- Sparklet  -->
                            <div class="row <?= $sparklet ?>">
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" value="0" id="chargeur_ref_spark" name="chargeur_ref_spark" class="form-control">
                                        <label for="chargeur_ref_spark" class="active">Chargeur Ref</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" value="0" id="poids_max" name="poids_max" class="form-control">
                                        <label for="poids_max" class="active">Poids Max</label>
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
                                        <input type="number" value="0" id="poids_mesurer" name="poids_mesurer" class="form-control poids_mesurer">
                                        <label for="poids_mesurer" class="active">Poids Mes</label>
                                    </div>
                                </div>

                            </div>
                            <!-- CO2  -->
                            <div class="row <?= $co2 ?>">
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" id="chargeur_ref_co2" value="0" step=0.1 name="chargeur_ref_co2" class="form-control">
                                        <label for="chargeur_ref_co2" class="active">Chargeur Ref</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" id="poids_mes" step=0.1 value="0" name="poids_mes" class="form-control">
                                        <label for="poids_mes" class="active">Poids mesuré</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" id="tare" value="0" step=0.1 name="tare" class="form-control">
                                        <label for="tare" class="active">Tare (g)</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" id="poids_gaz" value="0" step=0.1 name="poids_gaz" class="form-control">
                                        <label for="poids_gaz" class="active">Poids Gaz</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <fieldset class="form-check">
                                    <input class="form-check-input" name="a_fixer" value="1" type="checkbox" id="a_fixer">
                                    <label class="form-check-label" for="a_fixer">A fixer</label>
                                </fieldset>
                                <fieldset class="form-check">
                                    <input class="form-check-input" name="panneau" value="1" type="checkbox" id="panneau">
                                    <label class="form-check-label" for="panneau">Présence Panneau</label>
                                </fieldset>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ">
                                    <div class="md-form">
                                        <input type="text" value="" id="a_changer" name="a_changer" class="form-control">
                                        <label for="a_changer" class="active"></label>
                                    </div>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="md-form">
                                        <input type="text" value="Pas de réepreuve" id="a_reparer" name="a_reparer" class="form-control">
                                        <label for="a_reparer" class="active"></label>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group shadow-textarea col-12">
                                    <label for="commentaire"></label>
                                    <textarea class="form-control z-depth-1" id="commentaire" name="commentaire" rows="3" placeholder="Commentaire"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 text-left">

                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn blue-gradient">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                    <!-- Card content -->

                </div>
                <!-- Card -->

            </section>
            <!-- Section: Horizontal stepper -->




        </div>
    </main>
    <span id="fin"></span>
    <?php include 'footer.php'; ?>
    <?php include 'js.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.mdb-select').materialSelect();
            $('.datepicker').pickadate({
                // Escape any “rule” characters with an exclamation mark (!).
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy/mm/dd',
                hiddenPrefix: 'prefix__',
                hiddenSuffix: '__suffix'
            });
            //fonction pour les AZOTES
            function a_changer_azote() {
                pression_releve = $('#pression_releve').val();
                if (pression_releve <= 11 && pression_releve >= 16) {
                    $('#a_changer').val("En bon état");
                } else {
                    $('#a_changer').val("A changer");

                }
            }
            //fonction pour les sparklet
            function a_changer_spar() {
                poids_mesurer = $('.poids_mesurer').val();
                poids_max = $('#poids_max').val();
                poids_min = $('#poids_min').val();
                chargeur_ref_spark = $('#chargeur_ref_spark').val();
                poids_max = parseInt(poids_max);
                poids_min = parseInt(poids_min);
                poids_mesurer = parseInt(poids_mesurer);
                if (poids_mesurer < poids_max && poids_mesurer > poids_min) {
                    $('#a_changer').val("En bon état");
                } else {
                    $('#a_changer').val("A changer");

                }
            }
            $('.poids_mesurer').change(function() {
                a_changer_spar();
            });

            //fonction pour les CO2
            function a_changer_co() {
                poids_gaz = $('#poids_gaz').val();
                chargeur_ref_co2 = $('#chargeur_ref_co2').val();
                poids_mes = $('#poids_mes').val();
                tare = $('#tare').val();
                valeur = (poids_mes - tare);
                if (valeur >= 1.9) {
                    $('#a_changer').val("Good");
                    $('#a_reparer').val("Pas de Réepreuve");
                    $('#poids_gaz').val(valeur);
                } else {
                    $('#a_changer').val("A recharger");
                    $('#a_reparer').val("Réepreuve à faire");
                    $('#poids_gaz').val(valeur);
                }
            }
            $('#poids_mes').change(function() {
                a_changer_co();
            });
            $('#poids_gaz').change(function() {
                a_changer_co();
            });
            $('#chargeur_ref_co2').change(function() {
                a_changer_co();
            });
            $('#tare').change(function() {
                a_changer_co();
            });

            function verif_co2() {
                age_ext = $('#age_ext').val();
                if (age_ext >= 10) {
                    $('#reepreuve_annee').val("Vérification Quinquénal à faire");
                } else {
                    $('#reepreuve_annee').val("GOOD");
                }
            }
            verif_co2();
            //a_changer_co();
            //type_extincteur();
            $('#form').submit(function() {
                if (!confirm('Voulez-vous confirmer l\'enregistrement ?')) {
                    return false;
                }
            });
        });
    </script>
</body>
<style type="text/css">

</style>

</html>