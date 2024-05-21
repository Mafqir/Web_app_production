<!-- ----------------------------------------------------------------------------------------- -->
<!--                                          Header                                           -->
<!-- ----------------------------------------------------------------------------------------- -->

<?php $title = "Categories";
include "../templates/header.php" ?>
<?php
$succes = false;
if (isset($_POST)) {
    include_once('../../Metier/categorie.php');
    if (extract($_POST)) {
        $c = new Categorie($idCategorie, $nomCategorie);
        $c->save();
        $succes = true;
        unset($_POST);
    }
}
?>

<!-- ----------------------------------------------------------------------------------------- -->
<!--                                          Container                                        -->
<!-- ----------------------------------------------------------------------------------------- -->

<div id="main">
    <br>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Produit</h3>
                    <!-- <p class="text-subtitle text-muted">Ajout d'un client </p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">



                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajout d'un Produit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <?php
                            if ($succes) {
                                echo '<div class="alert alert-light-success color-success">
                          <i class="bi bi-check-circle"></i> Produit ajouté.
                        </div>';
                                unset($succes);
                            }
                            ?>
                            <form class="form form-vertical" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-vertical">Id Produit</label>
                                                <input type="text" id="password-vertical" class="form-control" name="idCategorie" placeholder="Id Produit">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Nom Produit</label>
                                                <input type="text" id="first-name-vertical" class="form-control" name="nomCategorie" placeholder="Nom Produit">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <input type="submit" value="Ajouter" class="btn btn-primary me-1 mb-1" name="submit">
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                Reset
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>




            </div>
        </section>
    </div>

    <!-- ----------------------------------------------------------------------------------------- -->
    <!--                                          Footer                                          -->
    <!-- ----------------------------------------------------------------------------------------- -->

    <?php include "../templates/footer.php" ?>