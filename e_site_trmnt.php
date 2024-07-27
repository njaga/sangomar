<?php
session_start();
include 'connexion.php';
include 'supprim_accents.php';

$nom = htmlspecialchars(suppr_accents($_POST['nom']));
$localisation = htmlspecialchars(suppr_accents($_POST['localisation']));
$date_debut = htmlspecialchars(suppr_accents($_POST['date_debut']));
$id = htmlspecialchars(suppr_accents($_POST['id']));
//$montant = htmlspecialchars(suppr_accents($_POST['montant']));

$reponse = $db->prepare("INSERT INTO `site`(`nom`, `localisation`, `date_debut`, `id_user`, id_client) VALUES (?,?,?,?,?)");
$reponse->execute(array($nom, $localisation, $date_debut, $_SESSION['id_vigilus_user'], $id));
$nbr = $reponse->rowCount();


if ($nbr > 0) {
?>
    <script type="text/javascript">
        window.history.go(-1);
    </script>
<?php
} else {
?>
    <script type="text/javascript">
        alert("Erreur : Site non enregistrée");
        window.history.go(-1);
    </script>
<?php
}
?>