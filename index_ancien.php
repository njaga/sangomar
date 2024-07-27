<!DOCTYPE html>
<html lang="fr-FR">

<head>
  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Authentification</title>
  <?php include 'css.php'; ?>

  <style>
    html,
    body,
    header,
    .view {
      height: 100vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .view {
        height: 815px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .view {
        height: 650px;
      }
    }

    .intro-2 {
      background: url("<?= $image ?>indefx.jpg")no-repeat center center;
      background-size: cover;
    }

    .top-nav-collapse {
      background-color: #3f51b5 !important;
    }

    .navbar:not(.top-nav-collapse) {
      background: transparent !important;
    }

    @media (max-width: 768px) {
      .navbar:not(.top-nav-collapse) {
        background: #3f51b5 !important;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #3f51b5 !important;
      }
    }

    .card {
      background-color: rgba(229, 228, 255, 0.2);
    }

    .md-form label {
      color: #ffffff;
    }

    h6 {
      line-height: 1.7;
    }


    .card {
      margin-top: 30px;
      /*margin-bottom: -45px;*/

    }

    .md-form input[type=text]:focus:not([readonly]),
    .md-form input[type=password]:focus:not([readonly]) {
      border-bottom: 1px solid #8EDEF8;
      box-shadow: 0 1px 0 0 #8EDEF8;
    }

    .md-form input[type=text]:focus:not([readonly])+label,
    .md-form input[type=password]:focus:not([readonly])+label {
      color: #8EDEF8;
    }

    .md-form .form-control {
      color: #fff;
    }
  </style>

</head>

<body>


  <!--Main Navigation-->
  <header>

    <!--Intro Section-->
    <section class="view intro-2">
      <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">

              <!--Form with header-->
              <div class="card wow fadeIn" data-wow-delay="0.3s">
                <form class="card-body" method="POST" action="authentification_trmnt.php">

                  <!--Header-->
                  <div class="form-header blue-gradient">
                    <h3><i class="fas fa-user mt-2 mb-2"></i> Log in:</h3>
                  </div>

                  <!--Body-->
                  <div class="md-form">
                    <i class="fas fa-user prefix white-text"></i>
                    <input type="text" id="orangeForm-name" required name="login" class="form-control">
                    <label for="orangeForm-name" class="active">Login </label>
                  </div>

                  <div class="md-form">
                    <i class="fas fa-lock prefix white-text"></i>
                    <input type="password" id="orangeForm-pass" required name="pwd" class="form-control">
                    <label for="orangeForm-pass" class="active">Mot de passe</label>
                  </div>

                  <div class="text-center">
                    <button class="btn blue-gradient btn-lg">Connexion</button>
                    <hr>
                    <div class="inline-ul text-center d-flex justify-content-center">
                      <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-twitter white-text"></i></a>
                      <a class="p-2 m-2 fa-lg li-ic"><i class="fab fa-linkedin-in white-text"> </i></a>
                      <a class="p-2 m-2 fa-lg ins-ic"><i class="fab fa-instagram white-text"> </i></a>
                    </div>
                  </div>

                </form>
              </div>
              <!--/Form with header-->

            </div>
          </div>
        </div>
      </div>
    </section>

  </header>
  <!--Main Navigation-->


  <!--  SCRIPTS  -->
  <!-- JQuery -->
  <?php include 'js.php'; ?>
  <script>
    new WOW().init();
  </script>
</body>

</html>