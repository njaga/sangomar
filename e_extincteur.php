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
include 'connexion.php';
$id = $_GET['id'];
$req_site = $db->prepare("SELECT `id`, `nom`, `localisation`, CONCAT(DATE_FORMAT(date_debut, '%d'), '/', DATE_FORMAT(date_debut, '%m'),'/', DATE_FORMAT(date_debut, '%Y'))    
FROM `site` 
    WHERE etat=1 and id_client=?
    ORDER BY nom DESC");
$req_site->execute(array($id));
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ajout extincteur</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>color-2174065_1280.png);">
    <?php
    include 'verif_menu.php';
    ?>
    <main class="container-fluid">

        <div class="row">
            <!-- Section: add employe -->
            <section class="mb-5 col-6 offset-md-3">

                <!-- Card -->
                <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h4 class="mb-0"><b> Ajout extincteur </b></h4>
                    </div>
                    <!-- /Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center table-responsive">
                        <form method="POST" action="e_tache_trmnt.php" enctype="multipart/form-data" id="form">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="md-form">
                                        <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_enregistrement" name="date_enregistrement" class="form-control">
                                        <label for="date_enregistrement" class="active">Date enregistrement</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Info département -->
                            <div class="row">
                                <div class="col-md-10 ">
                                    <select class="mdb-select md-form" name="site" id="site" searchable="Recherhce du site .." required>
                                        <option value='' disabled selected>Site</option>
                                        <?php
                                        while ($donnees_site = $req_site->fetch()) {
                                            echo "<option value='" . $donnees_site['0'] . "'  >" . $donnees_site['1'] . "  </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <select class="browser-default custom-select md-form" name="type_extincteur" id="type_extincteur" required>
                                        <option value='' disabled selected>Type extincteur</option>
                                        <option value="Azote">Azote</option>
                                        <option value="Sparklet">Sparklet</option>
                                        <option value="CO2">CO2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row d-none azote">
                                <div class="col-md-4 ">
                                    <div class="md-form">
                                        <input type="number" value="0" id="pression_releve" name="pression_releve" class="form-control">
                                        <label for="pression_releve" class="active">Pression relevée</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Sparklet  -->
                            <div class="row d-none sparklet">
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="number" value="0" id="chargeur_ref" name="chargeur_ref" class="form-control">
                                        <label for="chargeur_ref" class="active">Chargeur Ref</label>
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
                            </div>
                            <!-- CO2  -->
                            <div class="row d-none co2">
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

                            <div class="text-center mt-4">
                                <input type="submit" value="Enregistrer" class="btn blue-gradient">
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
            //fonction pour les types
            function type_extincteur() {
                var type_extincteur = $('#type_extincteur').val();
                if (type_extincteur == "Sparklet") {
                    $('.sparklet').removeClass('d-none');
                    $('.azote').addClass('d-none');
                    $('.co2').addClass('d-none');
                } else if (type_extincteur == "Azote") {
                    $('.azote').removeClass('d-none');
                    $('.sparklet').addClass('d-none');
                    $('.co2').addClass('d-none');
                } else if (type_extincteur == "CO2") {
                    $('.co2').removeClass('d-none');
                    $('.sparklet').addClass('d-none');
                    $('.azote').addClass('d-none');
                }
            }
            $('#type_extincteur').change(function() {
                type_extincteur();
            });
            type_extincteur();
            $('#form').submit(function() {
                if (!confirm('Voulez-vous confirmer l\'enregistrement ?')) {
                    return false;
                }
            });
            <?php
            if (isset($_GET['a'])) {
            ?>
                $('.toast').toast('show')
            <?php
            }
            ?>
        });
    </script>
</body>
<style type="text/css">

</style>

</html>