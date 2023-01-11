<!DOCTYPE html>
<html lang="es">

<head>
    <!-- head -->
    <?php require_once("template/partials/head.php");  ?>
    <title><?= $this->tittle ?></title>
</head>

<body>

    <div class="container" style="padding-top: 2%;">

        <?php require_once ("template/partials/menu.php") ?>   

        <?php include ("views/cuentas/partials/cabecera.php") ?>


        <!-- Menu Cuentas -->
        <?php require_once ("views/cuentas/partials/menu.php") ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>num_cuenta</th>
                    <th>Apellidos</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Ul Mov</th>
                    <th>Movtos</th>
                    <th>Saldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->cuentas as $cuenta): ?>
                    <tr>
                        <td><?= $cuenta->id ?></td>
                        <td><?= $cuenta->num_cuenta ?></td>
                        <td><?= $cuenta->apellidos ?></td>
                        <td><?= $cuenta->nombre ?></td>
                        <td><?= $cuenta->fecha_alta ?></td>
                        <td><?= $cuenta->fecha_ul_mov ?></td>
                        <td><?= $cuenta->num_movtos ?></td>
                        <td><?= $cuenta->saldo ?></td>
                        <td style="display:flex; justify-content:space-around;">
                            <a href="<?= URL ?>cuentas/eliminar/<?= $cuenta->id ?>" title="Eliminar" onclick="return confirm('¿Quieres borrar?')"> <i class="bi bi-trash"></i> </a>
                            <a href="<?= URL ?>cuentas/editar/<?= $cuenta->id ?>" title="Editar"> <i class="bi bi-pencil"></i> </a>
                            <a href="<?= URL ?>cuentas/mostrar/<?= $cuenta->id ?>" title="Mostrar"> <i class="bi bi-eye"></i> </a>
                            <a href="<?= URL ?>movimientos/render/<?= $cuenta->id ?>" title="Movimientos"> <i class="bi bi-list-task"></i> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Nº Registros: <?= $this->cuentas -> rowCount() ?> </td>
                </tr>
            </tfoot>
            <caption>Tabla de Cuentas </caption>

        </table>

    </div>

    <!-- footer -->
    <?php require_once ("template/partials/footer.php") ?>

    <!-- Bootstrap JS y popper -->
    <?php require_once ("template/partials/javascript.php") ?>

</body>

</html>