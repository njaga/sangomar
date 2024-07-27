<?php
session_start();
include 'connexion.php';

$date_enregistrement = htmlspecialchars($_POST['date_enregistrement']);
$date_prevu_fin = htmlspecialchars($_POST['date_prevu_fin']);
$client = htmlspecialchars($_POST['client']);
$commentaire = htmlspecialchars($_POST['commentaire']);

//Insertion des infos perso de l'employer
$req_tache = $db->prepare("INSERT INTO `verif_annuel_ext`(`date_debut`, `date_prevu_fin`, `id_client`, commentaire, `id_user`) VALUES(?,?,?,?,?)");
$result = $req_tache->execute(array($date_enregistrement, $date_prevu_fin, $client, $commentaire, $_SESSION['id_vigilus_user'])) or die(print_r($req_tache->errorInfo()));
$nbr = $req_tache->rowCount();

if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        window.history.go(-1);
        //window.location = "l_taches.php";
    </script>
<?php

} else {
    //echo $verif;            
?>
    <script type="text/javascript">
        alert("Erreur Client non enregistré");
        window.history.go(-1);
    </script>
<?php
}

?>