<?php
session_start();
include 'connexion.php';
include 'supprim_accents.php';
$verif = 0;

$type = htmlspecialchars($_POST['type']);
$client = htmlspecialchars($_POST['client']);
$secteur_activite = htmlspecialchars($_POST['secteur_activite']);
$contact = htmlspecialchars($_POST['contact']);
$telephone = htmlspecialchars($_POST['telephone']);
$email = htmlspecialchars($_POST['email']);
$adresse = htmlspecialchars($_POST['adresse']);


//Démarrage de la transaction

//Insertion des infos perso de l'employer
$req_client = $db->prepare("INSERT INTO `client`(`type`, `client`, `secteur_activite`, `contact`, `telephone`, `email`, `adresse`, `id_user`) VALUES(?,?,?,?,?,?,?,?) ");
$result = $req_client->execute(array($type, $client, $secteur_activite, $contact, $telephone, $email, $adresse, $_SESSION['id_vigilus_user'])) or die(print_r($req_client->errorInfo()));
$nbr = $req_client->rowCount();
$nbr = 1;
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
        alert("Erreur Client non enregistré");
        //window.history.go(-1);
    </script>
<?php
}

?>