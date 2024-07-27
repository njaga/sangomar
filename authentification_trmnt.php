<?php
session_start();
include 'connexion.php';

if (isset($_POST['login']) && isset($_POST['pwd'])) {
	$login = htmlspecialchars($_POST['login']);
	$pwd = htmlspecialchars($_POST['pwd']);
} else {
?>
	<script type="text/javascript">
		alert("Veuillez vérifier les informations saisies");
		window.history.go(-1);
	</script>
<?php
}

$req = $db->prepare('SELECT `id`, `prenom`, `nom`, `profil`, `telephone`, `email`, `login`,  `pwd` FROM `user` WHERE login=? AND etat=1');
$req->execute(array($login));
$num_of_rows = 1;
$donnees = $req->fetch();
if ($num_of_rows < 1) {
?>
	<script type="text/javascript">
		alert("Mauvais identifiant ou mot de passe!");
		window.history.go(-1);
	</script>
	<?php
} else {
	if ($donnees['7'] == sha1($_POST['pwd'])) {
		$_SESSION['id_vigilus_user'] = $donnees['0'];
		$_SESSION['prenon_vigilus_user'] = $donnees['1'];
		$_SESSION['nom_vigilus_user'] = $donnees['2'];
		$_SESSION['profil_vigilus_user'] = $donnees['3'];
		$_SESSION['telephone_vigilus_user'] = $donnees['4'];
		$_SESSION['email_vigilus_user'] = $donnees['5'];
		$_SESSION['login_vigilus_user'] = $donnees['6'];
		/*
		$_SESSION['departement_vigilus_user']=$donnees['0'];
		$_SESSION['succursale_vigilus_user']=$donnees['0'];
		*/
		$_SESSION['chemin_document'] = "documents/";
		header("location:accueil.php?a=a");
	} else {
	?>
		<script type="text/javascript">
			alert("Mauvais identifiant ou mot de passe !");
			window.history.go(-1);
		</script>
<?php
	}
}
?>