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
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nouveau client / Prospect</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>sangomar.jpg);">
    <?php
    include 'verif_menu.php';
    ?>
    <main class="container-fluid">

        <div class="row">
            <!-- Section: add employe -->
            <section class="mb-5 col-10 offset-md-1">

                <!-- Card -->
                <div class="card card-cascade narrower">

                    <!-- Card image -->
                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h4 class="mb-0"><b> Nouveau client / Prospect </b></h4>
                    </div>
                    <!-- /Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center table-responsive">
                        <form method="POST" action="e_client_trmnt.php" enctype="multipart/form-data" id="form">
                            <!-- Info département -->
                            <div class="row">
                                <div class="col-md-4 ">
                                    <select class="browser-default custom-select md-form" name="type" searchable="Recherhce .." required>
                                        <option value='' disabled selected>Type</option>
                                        <option value="Client">Client</option>
                                        <option value="Prospect">Prospect</option>
                                    </select>
                                </div>
                                <div class="col-md-5 ">
                                    <div class="md-form">
                                        <input type="text" id="client" name="client" class="form-control">
                                        <label for="client" class="active">Client</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <select class="browser-default custom-select md-form" name="secteur_activite" required>
                                        <option value='' disabled selected>Secteur d'activité</option>
                                        <option value="Agroalimentaire">Agroalimentaire</option>
                                        <option value="Banques">Banques</option>
                                        <option value="Industrie">Industrie</option>
                                        <option value="Télécommunication">Télécommunication</option>
                                        <option value="Pétrole">Pétrole</option>
                                        <option value="Construction Immobilière">Construction Immobilière</option>
                                        <option value="ONG">ONG</option>
                                        <option value="Services Généraux">Services Généraux</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Infos  -->
                            <div class="row">
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="text" id="contact" name="contact" required class="form-control">
                                        <label for="contact" class="active">Contact client</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="text" id="telephone" name="telephone" class="form-control" required>
                                        <label for="telephone" class="active">N° Téléphone</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="email" id="email" name="email" class="form-control" required>
                                        <label for="email" class="active">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="md-form">
                                        <input type="text" id="adresse" name="adresse" class="form-control " required>
                                        <label for="adresse" class="active">Adresse</label>
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