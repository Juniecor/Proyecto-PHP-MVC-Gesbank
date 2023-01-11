<?php 

    class Clientes extends Controller{
        public function render(){
            // Mostrará todos los clientes
            $this->view->tittle="Tabla Clientes";
            $this->view->clientes=$this->model->get();
            $this->view->render("clientes/main/index");
        }

        public function nuevo($param=[])
        {
            // Mostrará el formulario nuevo cliente
            $this->view->tittle="Formulario Nuevo Cliente";
            $this->view->render("clientes/nuevo/index");
        }

        public function create($param=[])
        {
            // Añadirá un nuevo cliente

            $cliente= new Cliente(

                null,
                $_POST["apellidos"],
                $_POST["nombre"],
                $_POST["telefono"],
                $_POST["ciudad"],
                $_POST["dni"],
                $_POST["email"]
            );

            $this->view->tittle="Tabla Clientes";
            $this->model->create($cliente);
            header('location:'.URL.'clientes');
        }

        public function editar($param=[])
        {
            // Mostrará el formulario editar cliente
            $this->view->id = $param[0];
            $this->view->tittle="Editar Clientes";
            $this->view->cliente=$this->model->redCliente($this->view->id)->fetch();
            $this->view->render("clientes/editar/index");
        }

        public function update($param=[])
        {
            $id = $param[0];
            //Editará los atributos del cliente
            $edit_cliente= new Cliente(
                
                null,
                $_POST["apellidos"],
                $_POST["nombre"],
                $_POST["telefono"],
                $_POST["ciudad"],
                $_POST["dni"],
                $_POST["email"]
            );

            $this->model->update($edit_cliente,$id);
            header('location:'.URL.'clientes');

        }

        public function mostrar($param=[])
        {
            //mostrará al cliente
            $this->view->id = $param[0];
            $this->view->tittle="Mostrar Clientes";
            $this->view->cliente=$this->model->redCliente($this->view->id)->fetch();
            $this->view->render("clientes/mostrar/index");
        }

        public function eliminar($param=[])
        {
            //Eliminará al cliente
            $this->id = $param[0];
            $this->model->deleteCliente($this->id);
            header('location:'.URL.'clientes');
        }

        public function ordenar($param=[])
        {
            //Ordenará al cliente
            $this->criterio = $param[0];
            $this->view->tittle="Ordenar Clientes";
            $this->view->clientes=$this->model->order($this->criterio);
            $this->view->render("clientes/main/index");
        }

        public function filtrar($param=[])
        {
            //Filtrará los clientes
            $this->expresion = $_GET['expresion'];
            $this->view->tittle="Filtrar Clientes";
            $this->view->clientes=$this->model->filtrar($this->expresion);
            $this->view->render("clientes/main/index");
        }
        
    }

?>