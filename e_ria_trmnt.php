<?php
session_start();
include 'connexion.php';

$date_ajout = htmlspecialchars($_POST['date_enregistrement']);
$site = htmlspecialchars($_POST['site']);
$type_ria = htmlspecialchars($_POST['type_ria']);
$emplacement = htmlspecialchars($_POST['emplacement']);
$marque = htmlspecialchars($_POST['marque']);
$type_derniere_verif = htmlspecialchars($_POST['type_derniere_verif']);
$date_derniere_verif = htmlspecialchars($_POST['date_derniere_verif']);
$verificateur = htmlspecialchars($_POST['verificateur']);


if ($date_derniere_verif == "") {
    $req_tache = $db->prepare('INSERT INTO `ria_pia`(`date_ajout`, `type`, `emplacement`, `marque`,  `id_site`, `id_user`) VALUES(?,?,?,?,?,?)');
    $req_tache->execute(array($date_ajout, $type_ria, $emplacement, $marque, $site, $_SESSION['id_vigilus_user']));
    $nbr = $req_tache->rowCount();
} else {
    $req_tache = $db->prepare("INSERT INTO `ria_pia`(`date_ajout`, `type`, `emplacement`, `marque`, date_derniere_verif, type_dernier_verif,  `id_site`, `id_user`, verificateur) VALUES(?,?,?,?,?,?,?,?,?)");
    $result = $req_tache->execute(array($date_ajout, $type_ria, $emplacement, $marque, $date_derniere_verif, $type_derniere_verif, $site, $_SESSION['id_vigilus_user'], $verificateur));
    $nbr = $req_tache->rowCount();
}

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
        alert("Erreur RIA non enregistré");
        window.history.go(-1);
    </script>
<?php
}

?>