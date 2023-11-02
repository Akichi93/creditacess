<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <title>Dashboard - HRMS admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/material.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <style type="text/css">
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        #datatable {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        #datatable caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        #datatable th {
            font-weight: 600;
            padding: 0.5em;
        }

        #datatable td,
        #datatable th,
        #datatable caption {
            padding: 0.5em;
        }

        #datatable thead tr,
        #datatable tr:nth-child(even) {
            background: #f8f8f8;
        }

        #datatable tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        @include('layouts.header')


        @include('layouts.sidebar')

        <div class="page-wrapper">
            @yield('content')
        </div>

        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>

        <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        @stack('script-page')
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                // DataTable initialisation
                $("#example").DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    "language": {
                        "sProcessing": "Traitement...",
                        "sLengthMenu": "Afficher les enregistrements _MENU",
                        "sZeroRecords": "Aucun résultat trouvé",
                        "sEmptyTable": "Aucune donnée disponible dans ce tableau",
                        "sInfo": "Affichage des enregistrements de _START_ à _END_ sur un total de _TOTAL_ enregistrements",
                        "sInfoEmpty": "Affichage des enregistrements de 0 à 0 sur 0 enregistrements",
                        "sInfoFiltered": "(filtré à partir d'un total de _MAX_ enregistrements)",
                        "sInfoPostFix": "",
                        "sSearch": "Rechercher:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Chargement...",
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sLast": "Dernier",
                            "sNext": "Suivant",
                            "sPrevious": "Precedent"
                        },
                        "oAria": {
                            "sSortAscending": ": Activer pour trier les colonnes par ordre croissant",
                            "sSortDescending": ": Activer pour trier la colonne par ordre décroissant"
                        }
                    }

                });
            });
        </script>
        @stack('graph')

        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script src="{{ asset('assets/js/greedynav.js') }}"></script>

        <script src="{{ asset('assets/js/layout.js') }}"></script>
        <script src="{{ asset('assets/js/theme-settings.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        @yield('script')

        <!-- Sidebar-->
        <script>
            $(document).ready(function() {
                var urlcourant = document.location.href
                urlcourant = urlcourant.replace(/\/$/, "")
                var queurl = urlcourant.substring(urlcourant.lastIndexOf("/") + 1)
                // console.log(queurl)
                if (queurl == 'createcontrat') {
                    queurl = 'contrat'
                } else if (queurl.includes("addavenant")) {
                    queurl = 'contrat'
                }
                // alert(queurl)
                $("#" + queurl).addClass("active")
                $("#" + queurl).parents().eq(0).toggle();
                //#####################################################
                var subdrop = $("#" + queurl).parents().eq(1).children().eq(0)
                subdrop.children().eq(2).css("transform", "rotate(90deg)")
            })
        </script>
</body>

</html>
