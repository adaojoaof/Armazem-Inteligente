<?php
$pageTitle = "Definições";
$activePage = "definicoes";

//array com as prateleiras no armazém -> prateleiras.txt
$prateleiras = file_get_contents("api/files/prateleiras.txt");
$prateleiras = explode("\n", $prateleiras);
array_pop($prateleiras);
foreach ($prateleiras as $key => $value) {
    $prateleira = explode(":", $value);
    $newPrateleiras[$prateleira[0]] = $prateleira[1];
}
$prateleiras = $newPrateleiras;

// var_dump($prateleiras);

//Verificar submissão do formulário
if (isset($_POST['save-settings']) && $_POST['save-settings'] == "Guardar") {
    file_put_contents("api/files/prateleiras.txt", "");
    //var_dump($_POST['prateleiras']);
    $prateleiras = $_POST['prateleiras'];
    foreach ($prateleiras as $key => $value) {
        file_put_contents("api/files/prateleiras.txt", $key . ":" . $value . PHP_EOL, FILE_APPEND);
    }
    $successSubmit = true;
}
?>

<?php include "header.php"; ?>

<div class="row">
    <div class="col-12">
        <div class="card-stats card">
            <form action="definicoes.php" method="post">
                <div class="card-header">
                    <h4 class="card-title">Definições das Pratelerias do Armazém</h4>
                    <p class="card-category">Associar os produtos às prateleiras existentes no armazém</p>
                </div>
                <div class="card-body">
                    <?php if (isset($successSubmit) && $successSubmit == true) { ?>
                        <div class="alert alert-success">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
                                <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>
                                <b> Dados submetidos com sucesso! - </b> Os dados foram guardados com sucesso</span>
                        </div>
                    <?php } ?>

                    <?php
                    foreach ($prateleiras as $key => $value) {
                    ?>
                        <div class="form-group row mb-2">
                            <label class="col-md-2 col-sm-3 col-form-label" for="<?= $key ?>"><?= $key ?></label>
                            <div class="col-lg-4 col-md-5 col-sm-8">
                                <input class="form-control form-control-sm" type="text" required name="prateleiras[<?= $key ?>]" value="<?= $value ?>" id="<?= $key ?>">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card-footer">
                    <input type="submit" name="save-settings" class="btn btn-primary" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>