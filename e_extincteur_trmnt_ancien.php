<?php
session_start();
include 'connexion.php';
include 'supprim_accents.php';
$verif = 0;

$date_ajout = htmlspecialchars($_POST['date_enregistrement']);
$site = htmlspecialchars($_POST['site']);
$type_extincteur = htmlspecialchars($_POST['type_extincteur']);
$pression_releve = htmlspecialchars($_POST['pression_releve']);
$chargeur_ref = htmlspecialchars($_POST['chargeur_ref']);
$poids_max = htmlspecialchars($_POST['poids_max']);
$poids_min = htmlspecialchars($_POST['poids_min']);
$chargeur_ref_co2 = htmlspecialchars($_POST['chargeur_ref_co2']);
$poids_mes = htmlspecialchars($_POST['poids_mes']);

//Démarrage de la transaction

//Insertion des infos perso de l'employer
$req_tache = $db->prepare("INSERT INTO `extincteur`(`date_ajout`, `type`, `extincteur`, `marque`, `annee_fabrication`, `pression_relevee`, `chargeur_ref`, `poids_max`, `poids_min`, `tare`, `id_user`) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
$result = $req_tache->execute(array($date_ajout, $type_extincteur,  $commentaire, $num_devis, $montant, $departement, $_SESSION['id_vigilus_user'])) or die(print_r($req_tache->errorInfo()));
$nbr = $req_tache->rowCount();

if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        window.location = "l_taches.php";
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