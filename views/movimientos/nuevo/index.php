<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("template/partials/head.php");  ?>
    <title><?= $this->tittle ?></title>

</head>

<body>

    <?php require_once ("template/partials/menu.php") ?> 

    <div class="container">
        
        <?php include ("views/clientes/partials/cabecera.php") ?>
        
        <div class="mb-3">
            <form action="<?= URL?>movimientos/create" method="POST">

                <div class="mb-3">
                    <label for="" class="form-label">Nº de cuenta</label>
                    <input type="text" class="form-control" name="num_cuenta" value="<?= $this->cuenta->num_cuenta?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Id Cliente</label>
                    <input type="text" class="form-control" name="id_cliente" value="<?= $this->cuenta->id_cliente?>" disabled >
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Saldo</label>
                    <input type="text" class="form-control" name="saldo" value="<?= $this->cuenta->saldo?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Concepto</label>
                    <input type="text" class="form-control" name="concepto" value="">
                </div>
                <label for="" class="form-label">Tipo de movimiento</label>
                <div class="form-control form-check">
                    <input class="form-check-input-inline" type="radio" name="tipo" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1" valule="I">
                        Ingreso
                    </label>
                    <input class="form-check-input-inline" type="radio" name="tipo" id="flexRadioDefault2" checked>
                    <label class="form-check-label" for="flexRadioDefault2" valule="R">
                        Reintegro
                    </label>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" placeholder="0.00">
                </div>

                <div class="mb-3">
                    <a name="" id="" class="btn btn-secondary" href="<?= URL?>/movimientos/main/<?=$this->id?>" role="button">Cancelar</a>
                    <button type="button" class="btn btn-danger">Borrar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>

                </div>

            </form>
        </div>

    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once ("template/partials/footer.php") ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once ("template/partials/javascript.php") ?>
</body>

</html>