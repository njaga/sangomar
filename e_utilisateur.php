<?php
session_start();
if(!isset($_SESSION['id_user_empresa']))
{
?>
<!--- <script type="text/javascript">
    alert("Veillez d'abord vous connectez !");
    window.location = 'index.php';

</script>-->
<?php
}

?>
<!DOCTYPE html>
<html lang="Fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Ajout Utilisateurs</title>
  <?php include'css.php'?>
</head>
<body style="background-image: url(<?= $image ?>2021_Januari_65.jpg);">
    <?php include'verif_menu.php'?>
    <!-- Material form register -->
    <div class="container">
        <div class="card card-cascade narrower col-md-8 offset-md-2 ">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Ajout Utilisateurs</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center" style="color: #757575;" action="e_utilisateur_tmnt.php" id="form" method="POST">
                
                <!-- Nom utilisateurs -->
                <div class="form-row">
                    <div class="col-5">
                        <div class="md-form">
                            <input type="text" id="prenom" name="prenom" class="form-control" required="">
                            <label for="prenom">Prenom</label>
                        </div>
                    </div>
                    <div class="col-5 ">
                        <div class="md-form">
                            <input type="text" id="nom" name="nom" class="form-control" required="">
                            <label for="nom">Nom</label>
                        </div>
                    </div>
                   
                </div>
                 <!-- profil utilisateurs-->
                 <div class="form-row">
                    <div class="col-6">
                        <select class="browser-default custom-select" name="profil" required="">
                            <option selected>Sélectionnez la profil</option>
                            <option value="admin">Administrateur</option>
                            <option value="agent daccueil">Agent d'accueil</option>
                            <option value="business developer">Business Developer</option>
                            <option value="dag">DAG</option>
                            <option value="Directeur Général">Directeur Général</option>
                            <option value="responsable commercial">Responsable Commercial(e)</option>
                            
                        </select>
                    </div>
                 </div>   
                 <br>   
                <!-- Contact utilisateurs -->
                                <div class="form-row">
                    <div class="col-6">
                        <div class="md-form mt-0">
                            <input type="text" id="contact" name="contact" class="form-control" required="">
                            <label for="contact">Téléphone</label>
                        </div>
                    </div>
                </div> 
				<!-- Email utilisateurs -->
                 <div class="form-row">
                    <div class="col-6">
                        <div class="md-form mt-0">
                            <input type="email" id="email" name="email" class="form-control" required="">
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>   
                <!-- Sign up button -->
                <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0 col-12 col-md-4" type="submit">Enregistrer</button>
            </form>
            <!-- Form -->
        </div>
        </div>
    </div>

    <?php include'js.php'?>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.mdb-select').materialSelect();
        $('#form').submit(function () {
            if (!confirm('Voulez-vous confirmer l\'enregistrement de cet utilisateur ?')) {
                return false;
            }
        });
        });
  </script>
</body>
</html>