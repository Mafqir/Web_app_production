<?php
// require("../../Metier/fourniseur.php");
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: http://localhost/Mini1/");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caisse - Planifier votre production</title>

    <link rel="stylesheet" href="../../assets/css/main/app.css">
    <link rel="stylesheet" href="../../assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../../assets/extensions/sweetalert2/sweetalert2.min.css">
    <!-- <script src="../../assets/js/pages/sweetalert2.js"></script> -->
    <script src="../../assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <style>
        .not-active-prod {
            display: none;
        }
    </style>

</head>

<body>
    <?php if (isset($_GET["ref"])) {
        echo '<div class="modal fade text-left hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title white" id="myModalLabel110">Success Modal
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="swal2-icon swal2-success swal2-icon-show" style="display: flex;">
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span></div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success ml-1" data-bs-dismiss="modal" onclick="print2(`' . $_GET["ref"] . '`)">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Print</span>
                    </button>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>

    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Sidebar                                          -->
    <!-- ----------------------------------------------------------------------------------------- -->



    <!-- -----------------------------------     Categories     ---------------------------------- -->
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active" style="width: 13vw; left:0;">

                <div class="d-flex justify-content-between align-items-center" style="margin:1rem auto; padding: 0 1rem;">
                    <a href="javascript:history.back()" class="align-self-end"><i class="bi bi-reply-fill"></i></a>
                    <div class="logo">
                        <a href="../dashboard.php"><img src="../../assets/images/logo/logo.svg" alt="Logo" srcset=""></a>
                    </div>

                    <div class="sidebar-toggler  x">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>

                <div style="margin-top:1rem; padding: 0 1rem;">
                    <h3>Produit</h3>
                    <br>
                    <div class="card" style="background-color: var(--bs-body-bg); width: 11vw; height: 3.5rem; margin-bottom:1rem;">
                        <div class=" btn card-body py-3 px-4" style="height: 3.5rem;" onclick="CatAll()">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="ms-3 name">
                                    <p class="font-bold">ALL</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require "../../Metier/categorie.php";
                    $tab = Categorie::afficher();

                    foreach ($tab as $t) { ?>
                        <div class="card" style="background-color: var(--bs-body-bg); width: 11vw; height: 3.5rem; margin-bottom:1rem;">
                            <div class=" btn card-body py-3 px-4" style="height: 3.5rem;" onclick="Cat(`<?= $t->get('n') ?>`)">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="ms-3 name">
                                        <p class="font-bold"><?= $t->get("n") ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>




            </div>
        </div>
    </div>


    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Container                                        -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <div id="main" style="padding-left:0px;margin-left: 15vw;">
        <div class="page-heading">
            <div class="page-title" style="margin-bottom: 10px;">
                <div class="row" style="width: 50rem;">
                    <div class="col-12 col-md-6 order-md-1 order-last" style="width: 100rem;">
                        <div class="d-flex justify-content-between">
                            <h3 style="width:20rem; margin-right:0;">Les composants</h3>
                            <div class="email-fixed-search" style="width:15rem; box-sizing: border-box;">
                                <div class="form-group position-relative mb-0 has-icon-left">
                                    <input type="text" class="form-control" placeholder="Rechercher le nom..." id="searchProduit" onkeyup="FilterProduit()">
                                    <div class="form-control-icon">
                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                            <use xlink:href="../../assets/images/bootstrap-icons.svg#search"></use>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card" style="width: 52vw;">
                    <div class="cards-space row" id="caisse-produits" style="margin:auto;">
                        <?php
                        require "../../Metier/produit.php";
                        $tab = Produit::afficher();
                        foreach ($tab as $t) { ?>
                            <div class="card d-flex align-items-center" id='<?= $t->get("c") ?>' style="width: 7.5rem; background-color: var(--bs-body-bg);padding:0;margin:1rem; ">
                                <img class="card-img-top" src="../../assets/photos/<?= $t->get("i") ?>" height="90">
                                <div class="card-body d-flex flex-column align-items-center" style="padding:1rem;">
                                    <h6 class="card-title refer" style="font-size: 1.1rem;"><?= $t->get("r") ?></h6>
                                    <p class="card-text text-center libel" style="font-size: 0.9rem;"><?= $t->get("l") ?></p>
                                    <div>
                                        <?php if ($t->get("q") > 0) { ?>
                                            <button class="btn btn-sm btn-primary" onclick="addRow2(`<?= $t->get('r') ?>`,`<?= $t->get('l') ?>`,<?= $t->get('p') ?>,<?= $t->get('q') ?>)">Add</button>
                                        <?php } else echo '<button class="btn btn-sm btn-secondary disabled">Out</button>' ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </section>
            <!-- -------------------------------------     Ticket     ------------------------------------ -->

            <div id=" app">
                <div id="sidebar" class="active">
                    <div class=" sidebar-wrapper active" style="width: 31vw; right:0;">
                        <div style="margin-top:1rem; padding: 0 1rem;">
                            <h3>Ticket</h3>
                            <!-- <button class="btn btn-sm btn-primary" onclick="total('do')">T</button> -->
                            <form method="post" action="confirmCaisse.php">
                                <div class="d-flex justify-content-between">
                                    <!-- ------------ Client input -------------- -->
                                    <div>
                                        <label>Founisseur:</label>
                                        <select name="client" type="text" value="" class=" form-select" style="width: 15rem;height:2rem; background-color: var(--bs-body-bg);">
                                            <?php
                                            require "../../Metier/fournisseur.php";
                                            $tab = Fournisseur::afficher();
                                            foreach ($tab as $t) {
                                                echo "<option value='" . $t->get("i") . "'>" . $t->get("n") . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- ------------ Date input -------------- -->
                                    <div>
                                        <label>Date:</label>
                                        <input name="da" type="text" readonly value="<?= date("Y-m-d H:i") ?>" class="form-control" style="width: 10.7rem;height:2rem; background-color: var(--bs-body-bg);font-size:13px">
                                    </div>
                                </div>
                                <br>

                                <div class="table-responsive-lg">
                                    <!-- ------------ Ticket table -------------- -->
                                    <table class="table table-ticket" id="table">
                                        <thead>
                                            <tr>
                                                <th class="lib-col">Libelle</th>
                                                <th>Prix</th>
                                                <th>Quantite</th>
                                                <th>Total</th>
                                                <th class="deleteIcon"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="ticket-body" class="ticket-body">
                                            <!-- Lignes de commande -->
                                    </table>
                                    <hr>
                                    <div class="card-text font-bold d-flex justify-content-between" style="margin: 0 2rem">
                                        <div id="numCmd">
                                            Num :
                                        </div>
                                        <input type="hidden" id="numCmdInput" name="numCmd" value="">
                                        <div id="totalCmd">

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-grid gap-2">
                                        <input type="submit" value="Confirmer" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>




                    </div>
                </div>
            </div>
        </div>



        <!-- ----------------------------------------------------------------------------------------- -->
        <!--                                          Footer                                          -->
        <!-- ----------------------------------------------------------------------------------------- -->

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023/2014 &copy; Master IITN - ENSA Kenitra</p>
                </div>
            </div>
        </footer>
    </div>
    </div>


    <script src="../../assets/js/bootstrap.js"></script>
    <script src="../../assets/js/app.js"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="../../assets/js/pages/form-element-select.js"></script>
    <script src="../../assets/extensions/sweetalert2/sweetalert2.min.js"></script>



</body>

<script src="../../assets/js/functions.js"></script>
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });

    function print2(ref) {
        var mywindow = window.open(`http://localhost/Mini1/Presentation/Approvisionnement/pdf.php?ref=${ref}`, 'PRINT', 'height=400,width=600');
        mywindow.focus();
        mywindow.print();
        mywindow.addEventListener('afterprint', (event) => {
            mywindow.close();
        });
    }



    function addRow2(r, l, p, q) {
        exist = false;
        if (tr = document.getElementById("ticket-body").getElementsByTagName("tr")) {
            let size = tr.length;
            for (var m = 0; m < size; m++) {
                if (tr.item(m).getAttribute("class") == r) exist = true;
            }
        }
        if (!exist) {
            document.getElementById("ticket-body").innerHTML +=
                '<tr id="' + i + '" class="' + r + '"> ' +
                '<td class="lib-col"> <input type="hidden" name="cart[' + i + '][0]" value="' + r + '"><input type="hidden" value="' + l + '" class="form-control libelle"><div>' + l + '</div> </td>' +
                '<td> <input type="number" name="cart[' + i + '][1]" id="prix' + i + '" value="' + p + '" min="1" class="form-control prix" style="font-size: 0.9rem;">  </td> ' +
                '<td> <input onclick="total2(' + i + ')" onchange="total2(' + i + ')" type="number" name="cart[' + i + '][2]" id="qnt' + i + '" value="1" min="1" max="' + q + '" class="form-control" style="font-size: 0.9rem;"> </td>' +
                '<td> <div id="total' + i + '" style="font-size: 0.9rem;">' + p + ' Dh</div> </td>' +
                '<td class="deleteIcon"> <svg onclick="deleteRow(' + i + ')" class="bi" width="1em" height="1em" fill="currentColor"> <use xlink:href="../../assets/images/bootstrap-icons.svg#trash"></use> </svg>' +
                '<input type="hidden" name="cart[' + i + '][3]" value="' + q + '"> </td> </tr>';
            i++;
            n++;
            document.getElementById("numCmd").innerHTML = "Num : " + n;
            document.getElementById("numCmdInput").setAttribute("value", String(n));
        }
    }


    function deleteRow2(i) {
        document.getElementById(i).remove();
        let m = document.getElementById("numCmdInput").getAttribute("value");
        document.getElementById("numCmdInput").setAttribute("value", String(parseInt(m - 1)));
        document.getElementById("numCmd").innerHTML = "Num : " + (m - 1);
        n--;
    }

    function total2(id) {
        var qnt, iprix;
        qnt = parseInt(document.getElementById("qnt" + id).value);
        prix = parseInt(document.getElementById("prix" + id).value);
        document.getElementById("total" + id).innerHTML = String(prix * qnt) + " Dh";
    }
</script>

</html>