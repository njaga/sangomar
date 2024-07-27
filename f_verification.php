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
$id_verif = intval(htmlspecialchars($_GET['id']));
//Clients
$req_verif = $db->prepare("SELECT CONCAT(DATE_FORMAT(verification.date_debut, '%d'), '/', DATE_FORMAT(verification.date_debut, '%m'),'/', DATE_FORMAT(verification.date_debut, '%Y')), type_verif, CONCAT(DATE_FORMAT(verification.date_prevu_fin, '%d'), '/', DATE_FORMAT(verification.date_prevu_fin, '%m'),'/', DATE_FORMAT(verification.date_prevu_fin, '%Y')), client.client
FROM `verification` 
INNER JOIN client ON client.id=verification.id_client
WHERE verification.id=?");
$req_verif->execute(array($id_verif));
$donnees_verif = $req_verif->fetch();
$date_debut_verif = $donnees_verif['0'];
$type_verif = $donnees_verif['1'];
$date_fin_verif = $donnees_verif['2'];
$client = $donnees_verif['3'];
//SItes

?>
<!DOCTYPE html>
<html>

<head>
    <title>Fin de vérification</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>ddf.jpg);">
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
                        <h4 class="mb-0"><b> Fin de vérification </b></h4>
                        <h4 class="mb-0">Liste des sites de : <b> <?= $client ?></b></h4>
                        <h4 class="mb-0"> <b> <?= $type_verif ?></b> du <b> <?= $date_debut_verif ?></b> au <b> <?= $date_fin_verif ?></b> </h4>
                    </div>
                    <!-- /Card image -->

                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center table-responsive">
                        <form method="POST" action="f_verification_trmnt.php" id="form">
                            <input type="number" value="<?= $id_verif ?>" name="id_verif" hidden>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="md-form">
                                        <input type="date" value="<?= date('Y') . '-' . date('m') . '-' . date('d') ?>" id="date_fin" name="date_fin" class="form-control" required>
                                        <label for="date_fin" class="active">Date Fin</label>
                                    </div>
                                </div>

                            </div>
                            <!-- Infos  -->
                            <div class="row">
                                <div class="form-group shadow-textarea col-12">
                                    <label for="rapport"></label>
                                    <textarea class="form-control z-depth-1" id="rapport" name="rapport" rows="5" placeholder="Rapport"></textarea>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <input type="submit" value="Clotuer et Enregistrer" class="btn blue-gradient">
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