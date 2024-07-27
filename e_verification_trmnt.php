<?php
session_start();
include 'connexion.php';
include 'supprim_accents.php';
$verif = 0;

$date_debut = htmlspecialchars($_POST['date_debut']);
$client = htmlspecialchars($_POST['client']);
$type_verif = htmlspecialchars($_POST['type_verif']);
$date_prevu_fin = htmlspecialchars($_POST['date_prevu_fin']);
$commentaire = htmlspecialchars($_POST['commentaire']);

//Démarrage de la transaction

//Insertion des infos perso de l'employer
$req_client = $db->prepare("INSERT INTO `verification`(`type_verif`, `date_debut`, `date_prevu_fin`, `id_client`, id_user, commentaire) VALUES (?,?,?,?,?,?)");
$result = $req_client->execute(array($type_verif, $date_debut, $date_prevu_fin, $client,  $_SESSION['id_vigilus_user'], $commentaire)) or die(print_r($req_client->errorInfo()));
$nbr = $req_client->rowCount();

if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        window.history.go(-1);
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