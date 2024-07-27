<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_vigilus_user'])) {
?>
    <script type="text/javascript">
        alert("Veillez d'abord vous connectez !");
        window.location = 'index.php';
    </script>
<?php
}

if ($_SESSION['profil_vigilus_user'] == "rh") {
    include 'nav_rh.php';
} elseif ($_SESSION['profil_vigilus_user'] == "cm_gardiennage") {
    include 'nav_cm_gard.php';
} elseif ($_SESSION['profil_vigilus_user'] == "r_exp") {
    include 'nav_r_exp.php';
} elseif ($_SESSION['profil_vigilus_user'] == "r_achat") {
    include 'nav_r_achat.php';
} elseif ($_SESSION['profil_vigilus_user'] == "d_tech") {
    include 'nav_d_tech.php';
} elseif ($_SESSION['profil_vigilus_user'] == "informaticien") {
    include 'nav_ad.php';
} elseif ($_SESSION['profil_vigilus_user'] == "comptabilite") {
    include 'nav_compta.php';
} elseif ($_SESSION['profil_vigilus_user'] == "res_op") {
    include 'nav_res_op.php';
} elseif ($_SESSION['profil_vigilus_user'] == "assistante_direction") {
    include 'nav_secretaire.php';
} elseif ($_SESSION['profil_vigilus_user'] == "direction") {
    include 'nav_direction.php';
} elseif ($_SESSION['profil_vigilus_user'] == "logistique") {
    include 'nav_logistique.php';
} elseif ($_SESSION['profil_vigilus_user'] == "ass_op") {
    include 'nav_ass_op.php';
}
