<?php 

    class Movimientos extends Controller{
        public function render($param=[]){
            // Mostrará todos los movimientos
            $this->view->id = $param[0];
            $this->view->tittle="Tabla Movimientos";
            $this->view->movimientos=$this->model->get($this->view->id);
            $this->view->render("movimientos/main/index");
        }

        public function nuevo($param=[])
        {
            // Mostrará el formulario nuevo Cuenta
            $this->view->tittle="Formulario Nuevo Cuenta";
            $this->view->id = $param[0];
            $this->view->cuenta=$this->model->redCuenta($this->view->id)->fetch();
            $this->view->render("movimientos/nuevo/index");
        }

        public function create($param=[])
        {
            // Añadirá un nuevo Cuenta
            $this->id = $param[0];
            $movimiento= new Movimiento(

                null,

                $param[0],
                date("d-m-Y"),
                $_POST["concepto"],
                $_POST["tipo"],
                $_POST["cantidad"],
                $_POST["saldo"],
                null,
                null
            );

            $this->view->tittle="Tabla Movimientos";
            $this->model->create($movimiento, $this->id);
            header('location:'.URL.'movimientos');
        }
    }

?>