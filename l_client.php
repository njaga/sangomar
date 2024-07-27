<?php
session_start();
include 'connexion.php';
$req_departement = $db->query("SELECT id, nom FROM `departement` WHERE etat=1");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Liste des clients</title>
    <?php include 'css.php'; ?>
</head>

<body style="background-image: url(<?= $image ?>sangomar.jpg);">
    <?php
    include 'verif_menu.php';
    ?>

    <div class="container-fluid">
        <!-- Section: liste employe -->
        <section class="mb-5">

            <!-- Card -->
            <div class="row">
                <a href="e_client.php" class="btn col-sm-2 col-md-2 col-lg-2 blue-gradient btn-rounded waves-effect">Ajouter +</a>
            </div>
            <div class="row">

                <div class="card card-cascade narrower col-md-12">

                    <div class="view view-cascade gradient-card-header blue-gradient">
                        <h1 class="mb-0">Liste des clients </h1>
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade text-center ">
                        <div class="row">
                            <div class="col-12 table-responsive ">
                                <table class="table table-striped  table-hover " id="l_client">
                                    <thead class="black ">
                                        <tr>
                                            <td class="white-text">Client</td>
                                            <td class="white-text">Secteur d'activité</td>
                                            <td class="white-text">Contact client</td>
                                            <td class="white-text">Téléphone</td>
                                            <td class="white-text">Email</td>
                                            <td class="white-text">Adresse</td>
                                            <td class="white-text">Commercial</td>
                                            <td class="white-text"></td>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Card content -->

                </div>
            </div>
            <!-- Card -->

        </section>
        <!-- Section -->
    </div>
    <?php include 'footer.php'; ?>
    <?php include 'js.php'; ?>

</body>
<style type="text/css">
    body {
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #999;
    }

    td {
        background-color: "red";
        font-family: "times new roman";
        font-size: "25px";
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        var departement = $('select').val();
        var table = $('#l_client').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
            },
            'select': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'retrieve': true,
            "ajax": {
                'type': 'POST',
                'url': 'l_client_ajax.php'
            },
            'lengthMenu': [100, 150, 200],
            'columns': [{
                    data: 'client'
                },
                {
                    data: 'secteur_activite'
                },
                {
                    data: 'contact'
                },
                {
                    data: 'telephone'
                },
                {
                    data: 'email'
                },
                {
                    data: 'adresse'
                },
                {
                    data: 'commercial'
                },
                {
                    data: 'id',
                    render: function(data, type, full, meta) {
                        return '<a data-toggle="tooltip" data-placement="top" title="Modifier"class="" href="m_client.php?id=' + data + '"><i class="fas fa-pencil-alt"></i></a>&nbsp&nbsp<a class="blue-text" href="detail_client.php?id=' + data + '"><i class="fas fa-eye"></i></a>';
                    }
                },
            ],


            /*
            bouton imprimer, excel, pdf
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            */
        });



    })
</script>

</html>