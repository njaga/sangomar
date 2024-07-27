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

$req_va_ria = $db->prepare("SELECT `type`, `dn`, `lj`, `vanne_barrage`, `boite_eau`, `devidoir_tambour`, `diffuseur`, `panneau`, `commentaire`, id_ria, `date_verif`, `hs`, vanne_ria_pia FROM verfi_ria WHERE id=?");
$req_va_ria->execute(array($id));
$donnees_va_ria = $req_va_ria->fetch();
$type = $donnees_va_ria['0'];
$dn = $donnees_va_ria['1'];
$lj = $donnees_va_ria['2'];
$vanne_barrage = $donnees_va_ria['3'];
$boite_eau = $donnees_va_ria['4'];
$devidoir_tambour = $donnees_va_ria['5'];
$diffuseur = $donnees_va_ria['6'];
$panneau = $donnees_va_ria['7'];
$commentaire = $donnees_va_ria['8'];
$id_ria = $donnees_va_ria['9'];
$date_verif = $donnees_va_ria['10'];
$hs = $donnees_va_ria['11'];
$vanne_ria_pia = $donnees_va_ria['12'];

$id_verif = $id;

$req_ria = $db->prepare("SELECT CONCAT(DATE_FORMAT(`date_ajout`, '%d'), '/', DATE_FORMAT(`date_ajout`, '%m'),'/', DATE_FORMAT(`date_ajout`, '%Y')), `emplacement`, `marque`, CONCAT(DATE_FORMAT(`date_derniere_verif`, '%d'), '/', DATE_FORMAT(`date_derniere_verif`, '%m'),'/', DATE_FORMAT(`date_derniere_verif`, '%Y')), `type_dernier_verif`, `verificateur`, DATE_FORMAT(`date_derniere_verif`, '%Y') FROM `ria_pia` WHERE id=?");
$req_ria->execute(array($id_ria));
$nbr = $req_ria->rowCount();
$donnees_ext = $req_ria->fetch();

$date_enregistrement = $donnees_ext['0'];
$emplacement = $donnees_ext['1'];
$marque = $donnees_ext['2'];
$date_derniere_visite = $donnees_ext['3'];
$type_derniere_visite = $donnees_ext['4'];
$verificateur = $donnees_ext['5'];
$anne_derniere_visite = $donnees_ext['6'];
$annee_fabrication = $donnees_ext['6'];

//Dernière vérification
$req_verif = $db->prepare("SELECT CONCAT(DATE_FORMAT(date_verif, '%d'), '/', DATE_FORMAT(date_verif, '%m'),'/', DATE_FORMAT(date_verif, '%Y')), type, DATE_FORMAT(date_verif, '%Y') FROM `verfi_ria` WHERE id_ria=? ORDER BY date_verif DESC LIMIT 1");
$req_verif->execute(array($id));
$donnees_verif = $req_verif->fetch();
$nbr = $req_verif->rowCount();
if ($nbr > 0) {
    $date_derniere_visite = $donnees_verif['0'];
    $type_derniere_visite = $donnees_verif['1'];
    $anne_derniere_visite = $donnees_verif['2'];
}


?>
<!DOCTYPE html>
<html>

<head>
    <title>Vérification RIA</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>SANGOMAR.jpg);">
    <?php
    include 'verif_menu.php';
    ?>
    <div class="card-body card-body-cascade  white">
        <div class="row">
            <div class="col m1 s6">
                <b>RIA</b>
            </div>
            <div class="col m1 s6">
                Dernière Verification : <b><?= $date_derniere_visite ?> </b>
                <br>
                Type dernière Verification : <b><?= $type_derniere_visite ?></b>

            </div>
            <div class="col m1 s6">
                Emplacement : <b><?= $emplacement ?></b>
                <br>
                Année : <b><?= $annee_fabrication ?></b>
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
                        <h4 class="mb-0"><b> Vérification RIA </b></h4>
                    </div>
                    <!-- /Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center table-responsive">
                        <form method="POST" action="m_ria_va_trmnt.php">
                            <input type="text" name="date_derniere_visite" value="<?= $date_derniere_visite ?>" hidden>
                            <input type="number" name="id_ria" value="<?= $id ?>" hidden>
                            <input type="number" name="id_verif" value="<?= $id_verif ?>" hidden>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="md-form">
                                        <input type="date" value="<?= $date_verif ?>" id="date_verfication" name="date_verfication" class="form-control">
                                        <label for="date_verfication" class="active">Date vérification</label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6  ">
                                    <select class="browser-default custom-select md-form" name="dn" id="dn" required>
                                        <option value='' disabled>DN</option>
                                        <option value="19" <?php if ($dn == "19") echo "selected"; ?>>19</option>
                                        <option value="25" <?php if ($dn == "25") echo "selected"; ?>>25</option>
                                        <option value="33" <?php if ($dn == "33") echo "selected"; ?>>33</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-4">
                                    <div class="md-form">
                                        <input type="number" value="<?= $lj ?>" id="lj" name="lj" class="form-control">
                                        <label for="lj" class="active">L.J</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <select class="browser-default custom-select md-form" name="vanne_barrage" id="vanne_barrage" required>
                                        <option value='' disabled>Vanne de Barrage</option>
                                        <option value="RAS">RAS</option>
                                        <option value="Poignée vlolant cassé" <?php if ($vanne_barrage == "Poignée vlolant cassé") echo "selected"; ?>>Poignée vlolant cassé</option>
                                        <option value="Poignée 1/4 tour cassé" <?php if ($vanne_barrage == "Poignée 1/4 tour cassé") echo "selected"; ?>>Poignée 1/4 tour cassé</option>
                                        <option value="Petite fuite" <?php if ($vanne_barrage == "Petite fuite") echo "selected"; ?>>Petite fuite</option>
                                        <option value="Grande fuite" <?php if ($vanne_barrage == "Grande fuite") echo "selected"; ?>>Grande fuite</option>
                                        <option value="Vanne HS" <?php if ($vanne_barrage == "Vanne HS") echo "selected"; ?>>Vanne HS</option>
                                        <option value="Pas de vanne" <?php if ($vanne_barrage == "Pas de vanne") echo "selected"; ?>>Pas de vanne</option>
                                    </select>
                                </div>
                                <div class="col-md-5 col-12">
                                    <select class="browser-default custom-select md-form" name="vanne_ria_pia" id="vanne_ria_pia" required>
                                        <option value='' disabled>Vanne RIA/PIA</option>
                                        <option value="RAS" <?php if ($vanne_ria_pia == "Poignée vlolant cassé") echo "selected"; ?>>RAS</option>
                                        <option value="Poignée vlolant cassé" <?php if ($vanne_ria_pia == "Poignée vlolant cassé") echo "selected"; ?>>Poignée vlolant cassé</option>
                                        <option value="Poignée 1/4 tour cassé" <?php if ($vanne_ria_pia == "Poignée 1/4 tour cassé") echo "selected"; ?>>Poignée 1/4 tour cassé</option>
                                        <option value="Petite fuite" <?php if ($vanne_ria_pia == "Petite fuite") echo "selected"; ?>>Petite fuite</option>
                                        <option value="Grande fuite" <?php if ($vanne_ria_pia == "Grande fuite") echo "selected"; ?>>Grande fuite</option>
                                        <option value="Vanne HS" <?php if ($vanne_ria_pia == "Vanne HS") echo "selected"; ?>>Vanne HS</option>
                                        <option value="Pas de vanne" <?php if ($vanne_ria_pia == "Pas de vanne") echo "selected"; ?>>Pas de vanne</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <select class="browser-default custom-select md-form" name="boite_eau" id="boite_eau" required>
                                        <option value='' disabled>Boite à eaau </option>
                                        <option value="RAS" <?php if ($boite_eau == "RAS") echo "selected"; ?>>RAS</option>
                                        <option value="Petite fuite" <?php if ($boite_eau == "Petite fuite") echo "selected"; ?>>Petite fuite</option>
                                        <option value="Grande fuite" <?php if ($boite_eau == "Grande fuite") echo "selected"; ?>>Grande fuite</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <select class="browser-default custom-select md-form" name="devidoir_tambour" id="devidoir_tambour" required>
                                        <option value='' disabled selected>Devidoir Tambour</option>
                                        <option value="RAS" <?php if ($devidoir_tambour == "RAS") echo "selected"; ?>>RAS</option>
                                        <option value="A redresser" <?php if ($devidoir_tambour == "A redresser") echo "selected"; ?>>A redresser</option>
                                        <option value="A changer" <?php if ($devidoir_tambour == "A changer") echo "selected"; ?>>A changer</option>
                                        <option value="A dégriper" <?php if ($devidoir_tambour == "A dégriper") echo "selected"; ?>>A dégriper</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <select class="browser-default custom-select md-form" name="diffuseur" id="diffuseur" required>
                                        <option value='' disabled selected>Diffuseur</option>
                                        <option value="RAS" <?php if ($diffuseur == "RAS") echo "selected"; ?>>RAS</option>
                                        <option value="Fuite" <?php if ($diffuseur == "Fuite") echo "selected"; ?>>Fuite</option>
                                        <option value="Cassé" <?php if ($diffuseur == "Cassé") echo "selected"; ?>>Cassé</option>
                                        <option value="Bloqué" <?php if ($diffuseur == "Bloqué") echo "selected"; ?>>Bloqué</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <fieldset class="form-check">
                                    <input class="form-check-input" <?php if ($panneau == "VA") echo "checked"; ?> name="panneau" value="Oui" type="checkbox" id="panneau">
                                    <label class="form-check-label" for="panneau">Présence Panneau</label>
                                </fieldset>
                                <fieldset class="form-check">
                                    <input class="form-check-input" <?php if ($type == "VA") echo "checked"; ?> name="va" value="VA" type="checkbox" id="va">
                                    <label class="form-check-label" for="va">VA</label>
                                </fieldset>
                                <fieldset class="form-check">
                                    <input class="form-check-input" name="hs" <?php if ($hs == "Hors Service") echo "checked"; ?> value="Hors Service" type="checkbox" id="hs">
                                    <label class="form-check-label" for="hs">HS</label>
                                </fieldset>
                            </div>

                            <div class="row">
                                <div class="form-group shadow-textarea col-12">
                                    <label for="commentaire"></label>
                                    <textarea class="form-control z-depth-1" id="commentaire" name="commentaire" rows="3" placeholder="Commentaire"><?= $commentaire ?></textarea>
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
            //fonction pour les sparklet

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