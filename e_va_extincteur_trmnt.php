<?php
session_start();
include 'connexion.php';

$id_ext = htmlspecialchars($_POST['id_extincteur']);
$id_verif = htmlspecialchars($_POST['id_verif']);
$type_ext = htmlspecialchars($_POST['type_ext']);
$panneau = 0;
$a_fixer = 0;
if (isset($_POST['a_fixer'])) {
    $a_fixer = htmlspecialchars($_POST['a_fixer']);
}
if (isset($_POST['panneau'])) {
    $panneau = htmlspecialchars($_POST['panneau']);
}

$num_ext_pan = "";
$date_verif = htmlspecialchars($_POST['date_verfication']);
$type_verif = htmlspecialchars($_POST['type_verif']);
$commentaire = "";
//Azote
$pression_releve = "";
$a_charger_azote = "";
//sparklet
$chargeur_ref_spark = "";
$poids_max = "";
$poids_min = "";
$poids_mesurer = "";
$a_changer_sparke = "";
$rep_a_faire = "";
//CO2
$chargeur_ref_co2 = "";
$poids_mes = "";
$tare = "";
$poids_gaz = "";
$ch_a_faire_co = "";
$a_reparer = "";

$ch_a_faire = "";
$a_charger = "";
$chargeur_ref = 0;


if ($type_ext == "Sparklet") {
    $chargeur_ref = $_POST['chargeur_ref_spark'];
    $poids_max = htmlspecialchars($_POST['poids_max']);
    $poids_min = htmlspecialchars($_POST['poids_min']);
    $poids_mesurer = htmlspecialchars($_POST['poids_mesurer']);
}
if ($type_ext == "Azote") {
    $pression_releve = htmlspecialchars($_POST['pression_releve']);
}
if ($type_ext == "CO2") {
    $chargeur_ref = $_POST['chargeur_ref_co2'];
    $poids_mesurer = htmlspecialchars($_POST['poids_mes']);
    $tare = htmlspecialchars($_POST['tare']);
    $poids_gaz = htmlspecialchars($_POST['poids_gaz']);
}


$ch_a_faire = htmlspecialchars($_POST['a_changer']);
$a_reparer = htmlspecialchars($_POST['a_reparer']);
$commentaire = htmlspecialchars($_POST['commentaire']);

if ($ch_a_faire == "A recharger") {
    $ch_a_faire = 1;
} else {
    $ch_a_faire = 0;
}



//Démarrage de la transaction

//Insertion des infos perso de l'employer

$req_employe = $db->prepare("INSERT INTO `verfi_extincteur` (`date_verif`, `type`, `pression_relevee`, `chargeur_ref`, `poids_max`, `poids_min`, `tare`, `poids_gaz`, `a_fixer`, `panneau`, `num_ext_pan`, `ch_a_faire`, `rep_a_faire`, poids_mesurer, `commentaire`, `id_extincteur`, id_verification, `id_user`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$result = $req_employe->execute(array($date_verif, $type_verif, $pression_releve, $chargeur_ref, $poids_max, $poids_min, $tare, $poids_gaz, $a_fixer, $panneau, $num_ext_pan, $ch_a_faire, $rep_a_faire, $poids_mesurer, $commentaire, $id_ext, $id_verif, $_SESSION['id_vigilus_user'])) or die(print_r($req_employe->errorInfo()));
$id_employe = $db->lastInsertId();
$nbr = $req_employe->rowCount();

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