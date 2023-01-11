<?php 

    class ClientesModel extends Model{

        #Extraer todos los clientes
        public function get()
        {
            try {
                $sql = "
                
                    select 
                        *
                    from clientes;
                
                ";

                #Conectar con la base de datos

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                #Establezco como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                #Ejecuto
                $result->execute();

                return $result;

            } catch (PDOException $e) {
                include_once("template/partials/errorDB.php");
                exit();
            }
        }


        function create(Cliente $cliente)
        {

        try {
            // plantilla
            $sql = " INSERT INTO clientes (apellidos,nombre,telefono,ciudad,dni,email)values( 
                    :apellidos,
                    :nombre,
                    :telefono,
                    :ciudad,
                    :dni,
                    :email
                )";

            #Conectar con la base de datos

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            //Bindeamos parametros

            $result->bindParam(":apellidos", $cliente->apellidos, PDO::PARAM_STR,30);
            $result->bindParam(":nombre", $cliente->nombre, PDO::PARAM_STR,50);
            $result->bindParam(":telefono", $cliente->telefono, PDO::PARAM_STR,50);
            $result->bindParam(":ciudad", $cliente->ciudad, PDO::PARAM_STR,9);
            $result->bindParam(":dni", $cliente->dni, PDO::PARAM_STR,30);
            $result->bindParam(":email", $cliente->email, PDO::PARAM_STR,9);

            // ejecuto
            $result->execute();
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function redCliente($id)
        {

            try {
                // plantilla
                $sql = " SELECT    
                        *
                        FROM  clientes 
                        where id = $id;";

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                //Establez como quiero q devuelva el resultado 
                $result->setFetchMode(PDO::FETCH_OBJ);

                // ejecuto
                $result->execute();
                // print_r($result);
                return $result;
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }
        
        public function update(Cliente $cliente, $id)
        {
            try {
                // plantilla
                $sql = " Update clientes   
                        SET 
                        apellidos = :apellidos,
                        nombre = :nombre,
                        telefono = :telefono,
                        ciudad = :ciudad,
                        dni = :dni,
                        email = :email
                        where id = $id;";
    
                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);
    
    
                $result->bindParam(":apellidos", $cliente->apellidos, PDO::PARAM_STR,30);
                $result->bindParam(":nombre", $cliente->nombre, PDO::PARAM_STR,50);
                $result->bindParam(":telefono", $cliente->telefono, PDO::PARAM_STR,50);
                $result->bindParam(":ciudad", $cliente->ciudad, PDO::PARAM_STR,9);
                $result->bindParam(":dni", $cliente->dni, PDO::PARAM_STR,30);
                $result->bindParam(":email", $cliente->email, PDO::PARAM_STR,9);
    
                // ejecuto
                $result->execute();
                // print_r($result);
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function deleteCliente($id)
        {
            try {
                // plantilla
                $sql = "Delete from clientes where id = :id;";

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                $result->bindParam(":id", $id, PDO::PARAM_INT);

                // ejecuto
                $result->execute();
                // print_r($result);
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function order($criterio)
        {
            try {
                // plantilla
                $sql = "
                        Select    
                        *
                        FROM  clientes order by $criterio";


                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                // Si bindeo el parametro criterio y la sentencia
                // sql lo pongo como :criterio no se me ordena
                // $result->bindParam(":criterio", $criterio, PDO::PARAM_STR);

                //Establez como quiero q devuelva el resultado 
                $result->setFetchMode(PDO::FETCH_OBJ);

                // ejecuto
                $result->execute();
                // print_r($result);
                return $result;
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function filtrar($expresion)
        {
            try {
                // plantilla
                $sql = "
                        Select    
                        *
                        FROM  clientes
                        where 
                        concat_ws(' ',
                            id,
                            apellidos,
                            nombre,
                            telefono,
                            ciudad,
                            dni,
                            email) like ?";

                $expresion = "%" . $expresion . "%";

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                $result->bindParam(1, $expresion, PDO::PARAM_STR);

                //Establez como quiero q devuelva el resultado 
                $result->setFetchMode(PDO::FETCH_OBJ);

                // ejecuto
                $result->execute();
                // print_r($result);
                return $result;
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }

        }
    }
?>