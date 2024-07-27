<?php
session_start();
include 'connexion.php';
$id = htmlspecialchars($_GET['id']);
$id_sollicitation = $id;
$date_depot = htmlspecialchars(($_POST['date_traitement']));
$etat = htmlspecialchars(($_POST['etat']));
$offre_financiere = htmlspecialchars(($_POST['offre_financiere']));
$marge = htmlspecialchars(($_POST['marge']));

$req = $db->prepare("UPDATE `sollicitation` SET etat=?, date_depot=?, offre_financiere=?, marge=? WHERE id=?");
$result = $req->execute(array($etat, $date_depot, $offre_financiere, $marge, $id)) or die(print_r($req->errorInfo()));
$nbr = $req->rowCount();

//Offre Financière
switch ($_FILES["of"]['error']) {
    case 1: // UPLOAD_ERR_INI_SIZE
        $error = "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
        break;
    case 2: // UPLOAD_ERR_FORM_SIZE
        $error = "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
        break;
    case 3: // UPLOAD_ERR_PARTIAL
        $error = "L'envoi du fichier a été interrompu pendant le transfert !";
        break;
    case 4: // UPLOAD_ERR_NO_FILE
        $doc = '';
        break;
    default: {
            // Testons si l'extension est autorisée
            $extension = strtolower(strrchr($_FILES["of"]['name'], '.'));
            $extensions_autorisees = array('.pdf', '.jpg', '.jpeg', '.png');
            if (!in_array($extension, $extensions_autorisees)) {
                $error = 'Seul les fichiers d\'extension pdf, jpeg, jpg et png sont autorisés, contacter votre administrateur pour plus de renseignements';
            } else {
                $repertoire = $_SESSION['chemin_document'] . 'sollicitation/' . $id_sollicitation . '/';
                if (is_dir($repertoire)) {
                } else {
                    mkdir($repertoire);
                }

                $nom_document = "Offre financiere";
                move_uploaded_file($_FILES["of"]['tmp_name'], $repertoire . $nom_document . $extension);
                $doc_sollicitation = $repertoire . $nom_document . $extension;

                $req_document = $db->prepare("INSERT INTO document_sollicitation (`type_document`, `nom_document`, `chemin`, `id_sollicitation`,  id_user) VALUES (?,?,?,?,?)");
                $req_document->execute((array("of", "Offre Financiere", $doc_sollicitation, $id_sollicitation,  $_SESSION['id_vigilus_user'])));
            }
        }
}
//Offre technique
switch ($_FILES["ot"]['error']) {
    case 1: // UPLOAD_ERR_INI_SIZE
        $error = "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";
        break;
    case 2: // UPLOAD_ERR_FORM_SIZE
        $error = "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
        break;
    case 3: // UPLOAD_ERR_PARTIAL
        $error = "L'envoi du fichier a été interrompu pendant le transfert !";
        break;
    case 4: // UPLOAD_ERR_NO_FILE
        $doc = '';
        break;
    default: {
            // Testons si l'extension est autorisée
            $extension = strtolower(strrchr($_FILES["ot"]['name'], '.'));
            $extensions_autorisees = array('.pdf', '.jpg', '.jpeg', '.png');
            if (!in_array($extension, $extensions_autorisees)) {
                $error = 'Seul les fichiers d\'extension pdf, jpeg, jpg et png sont autorisés, contacter votre administrateur pour plus de renseignements';
            } else {
                $repertoire = $_SESSION['chemin_document'] . 'sollicitation/' . $id_sollicitation . '/';
                if (is_dir($repertoire)) {
                } else {
                    mkdir($repertoire);
                }

                $nom_document = "Offre Technique";
                move_uploaded_file($_FILES["ot"]['tmp_name'], $repertoire . $nom_document . $extension);
                $doc_sollicitation = $repertoire . $nom_document . $extension;

                $req_document = $db->prepare("INSERT INTO document_sollicitation (`type_document`, `nom_document`, `chemin`, `id_sollicitation`,  id_user) VALUES (?,?,?,?,?)");
                $req_document->execute((array("ot", "Offre technique", $doc_sollicitation, $id_sollicitation,  $_SESSION['id_vigilus_user'])));
            }
        }
}
if ($nbr > 0) {
    //echo $verif;
?>
    <script type="text/javascript">
        window.location = "l_sollicitation_clos.php";
    </script>
<?php

} else {
    //echo $verif;            
?>
    <script type="text/javascript">
        alert("Erreur non enregistré");
        window.history.go(-1);
    </script>
<?php
}

?>