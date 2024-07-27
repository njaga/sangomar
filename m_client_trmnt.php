<?php
session_start();
include 'connexion.php';
include 'supprim_accents.php';

$id = htmlspecialchars($_POST['id']);
$type = htmlspecialchars($_POST['type']);
$client = htmlspecialchars($_POST['client']);
$secteur_activite = htmlspecialchars($_POST['secteur_activite']);
$contact = htmlspecialchars($_POST['contact']);
$telephone = htmlspecialchars($_POST['telephone']);
$email = htmlspecialchars($_POST['email']);
$adresse = htmlspecialchars($_POST['adresse']);

$req_client = $db->prepare("UPDATE `client` SET `type`=?, `client`=?, `secteur_activite`=?, `contact`=?, `telephone`=?, `email`=?, `adresse`=?, `id_user`=? WHERE id=?");
$result = $req_client->execute(array($type, $client, $secteur_activite, $contact, $telephone, $email, $adresse, $_SESSION['id_vigilus_user'], $id)) or die(print_r($req_client->errorInfo()));
$nbr = $req_client->rowCount();

if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        //alert("Client enregistré");
        window.location = "l_client.php";
    </script>
<?php

} else {
    //echo $verif;            
?>
    <script type="text/javascript">
        alert("Erreur : pas de mofication");
        window.history.go(-1);
    </script>
<?php
}

?>