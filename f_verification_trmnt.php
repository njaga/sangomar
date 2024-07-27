<?php
session_start();
include 'connexion.php';
include 'supprim_accents.php';
$verif = 0;

$date_fin = htmlspecialchars($_POST['date_fin']);
$id_verif = htmlspecialchars($_POST['id_verif']);
$rapport = htmlspecialchars($_POST['rapport']);

$req_verif = $db->prepare("UPDATE `verification` SET `date_fin`=?, `rapport`=?, etat=2 WHERE id=?");
$result = $req_verif->execute(array($date_fin, $rapport, $id_verif)) or die(print_r($req_verif->errorInfo()));
$nbr = $req_verif->rowCount();

if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        window.location = "accueil.php";
    </script>
<?php

} else {
    //echo $verif;            
?>
    <script type="text/javascript">
        alert("Erreur vérif non enregistré");
        window.history.go(-1);
    </script>
<?php
}

?>