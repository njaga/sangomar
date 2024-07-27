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
$id = 1;
//Clients
$req_client = $db->query("SELECT client.id, client.client FROM `client` WHERE client.etat=1");
//SItes

?>
<!DOCTYPE html>
<html>

<head>
    <title>Nouvelle vérification</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>sangomar.jpg);">
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
                        <h4 class="mb-0"><b> Nouvelle vérification </b></h4>
                    </div>
                    <!-- /Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center table-responsive">
                        <form method="POST" action="e_verification_trmnt.php" enctype="multipart/form-data" id="form">
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="md-form">
                                        <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_debut" name="date_debut" class="form-control" required>
                                        <label for="date_debut" class="active">Date début</label>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <select class="browser-default custom-select md-form" name="type_verif" id="type_verif" required>
                                        <option value='' disabled selected>Type Vérification</option>
                                        <option value="Vérification Annuelle">Vérification Annuelle</option>
                                        <option value="Vérification Trimestrielle">Vérification Trimestrielle</option>
                                        <option value="Vérification Mensuelle">Vérification Mensuelle</option>
                                        <option value="Vérification Ponctuelle">Vérification Ponctuelle</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 ">
                                    <select class="mdb-select md-form" name="client" id="client" searchable="Recherhce du client .." required>
                                        <option value='' disabled selected>Client</option>
                                        <?php
                                        while ($donnees_client = $req_client->fetch()) {
                                            echo "<option value='" . $donnees_client['0'] . "'  >" . $donnees_client['1'] . "  </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-4 ">
                                    <div class="md-form">
                                        <input type="date" value="" id="date_prevu_fin" name="date_prevu_fin" class="form-control">
                                        <label for="date_prevu_fin" class="active">Date prévu fin</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Infos  -->
                            <div class="row">
                                <div class="form-group shadow-textarea col-12">
                                    <label for="commentaire"></label>
                                    <textarea class="form-control z-depth-1" id="commentaire" name="commentaire" rows="3" placeholder="Commentaire"></textarea>
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