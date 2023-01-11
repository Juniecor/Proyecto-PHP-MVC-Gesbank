<?php 

    class Cuentas extends Controller{
        public function render(){
            // Mostrará todos los cuentas
            $this->view->tittle="Tabla Cuentas";
            $this->view->cuentas=$this->model->get();
            $this->view->render("cuentas/main/index");
        }

        public function nuevo($param=[])
        {
            // Mostrará el formulario nuevo Cuenta
            $this->view->tittle="Formulario Nuevo Cuenta";
            $this->view->clientes=$this->model->getClientes();
            $this->view->render("cuentas/nuevo/index");
        }

        public function create($param=[])
        {
            // Añadirá un nuevo Cuenta

            $cuenta= new Cuenta(

                null,
                $_POST["num_cuenta"],
                $_POST["id_cliente"],
                $_POST["fecha_alta"],
                0,
                0,
                $_POST["saldo"]
            );

            $this->view->tittle="Tabla Cuentas";
            $this->model->create($cuenta);
            header('location:'.URL.'cuentas');
        }

        public function editar($param=[])
        {
            // Mostrará el formulario editar Cuenta
            $this->view->id = $param[0];
            $this->view->tittle="Editar Cuentas";
            $this->view->clientes=$this->model->getClientes();
            $this->view->cuenta=$this->model->redCuenta($this->view->id)->fetch();

            // Formateo la fecha
            $edit_fecha = (str_split($this->view->cuenta->fecha_alta));
            
            for ($i=0; $i < 9; $i++) { 
                    array_pop($edit_fecha);
            }
            $edit_fecha = implode($edit_fecha);

            $this->view->cuenta->fecha_alta = $edit_fecha;

            $this->view->render("cuentas/editar/index");
        }

        public function update($param=[])
        {
            $id = $param[0];
            //Editará los atributos de la Cuenta
            $edit_cuenta= new Cuenta(
                
                null,
                $_POST["num_cuenta"],
                $_POST["id_cliente"],
                $_POST["fecha_alta"],
                0,
                0,
                $_POST["saldo"]
            );

            $this->model->update($edit_cuenta,$id);
            header('location:'.URL.'cuentas');

        }

        public function mostrar($param=[])
        {
            //mostrará al Cuenta
            $this->view->id = $param[0];
            $this->view->tittle="Mostrar Cuentas";
            $this->view->cuenta=$this->model->redCuenta($this->view->id)->fetch();
            $this->view->clientes=$this->model->getClientes();
            $this->view->render("cuentas/mostrar/index");
        }

        public function eliminar($param=[])
        {
            //Eliminará al Cuenta
            $this->id = $param[0];
            $this->model->deleteCuenta($this->id);
            header('location:'.URL.'cuentas');
        }

        public function ordenar($param=[])
        {
            //Ordenará al Cuenta
            $this->criterio = $param[0];
            $this->view->tittle="Ordenar Cuentas";
            $this->view->cuentas=$this->model->order($this->criterio);
            $this->view->render("cuentas/main/index");
        }

        public function filtrar($param=[])
        {
            //Filtrará los cuentas
            $this->expresion = $_GET['expresion'];
            $this->view->tittle="Filtrar Cuentas";
            $this->view->cuentas=$this->model->filtrar($this->expresion);
            $this->view->render("cuentas/main/index");
        }
        
    }

?>