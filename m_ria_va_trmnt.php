<?php
session_start();
include 'connexion.php';

$id_ria = htmlspecialchars($_POST['id_ria']);
$id_verif = htmlspecialchars($_POST['id_verif']);
$va = "";
$panneau = "Non";
$hs = "";
if (isset($_POST['va'])) {
    $type_verif = htmlspecialchars($_POST['va']);
}
if (isset($_POST['panneau'])) {
    $panneau = htmlspecialchars($_POST['panneau']);
}
if (isset($_POST['hs'])) {
    $hs = htmlspecialchars($_POST['hs']);
}

$date_verif = htmlspecialchars($_POST['date_verfication']);
$commentaire = htmlspecialchars($_POST['commentaire']);
$dn = htmlspecialchars($_POST['dn']);
$lj = htmlspecialchars($_POST['lj']);
$vanne_barrage = htmlspecialchars($_POST['vanne_barrage']);
$vanne_ria_pia = htmlspecialchars($_POST['vanne_ria_pia']);
$boite_eau = htmlspecialchars($_POST['boite_eau']);
$devidoir_tambour = htmlspecialchars($_POST['devidoir_tambour']);
$diffuseur = htmlspecialchars($_POST['diffuseur']);


//Démarrage de la transaction

//Insertion des infos perso de l'employer

$req_va_ria = $db->prepare("UPDATE  `verfi_ria` SET `date_verif`=?, `type`=?, `dn`=?, `lj`=?, `vanne_barrage`=?, `vanne_ria_pia`=?, `boite_eau`=?, `devidoir_tambour`=?, `diffuseur`=?, `panneau`=?, `commentaire`=?, `hs`=?  WHERE id=?");
$result = $req_va_ria->execute(array($date_verif, $type_verif, $dn, $lj, $vanne_barrage, $vanne_ria_pia, $boite_eau, $devidoir_tambour, $diffuseur, $panneau, $commentaire, $hs, $id_verif)) or die(print_r($req_va_ria->errorInfo()));
$nbr = 1;

if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        window.history.go(-2);
        //window.location = "l_taches.php";
    </script>
<?php

} else {
    //echo $verif;            
?>
    <script type="text/javascript">
        alert("Erreur vérifcation non enregistré");
        window.history.go(-1);
    </script>
<?php
}

?>