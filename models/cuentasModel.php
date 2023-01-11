<?php 

    class CuentasModel extends Model{

        #Extraer todos los cuentas
        public function get()
        {
            try {
                $sql = "
                
                    select 
                        cu.id,
                        cu.num_cuenta,
                        cl.apellidos as apellidos,
                        cl.nombre as nombre,
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo
                    from cuentas as cu inner join clientes as cl on cu.id_cliente = cl.id order by cu.id;
                
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

        function getClientes(){


            try {
                // plantilla
                $sql = " 
                        SELECT    
                            cl.id,
                            cl.nombre cliente
    
                        FROM  
                            clientes as cl";
    
                
                #Conectar con la base de datos

                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);

                #Establezco como quiero que devuelva el resultado
                $result->setFetchMode(PDO::FETCH_OBJ);

                #Ejecuto
                $result->execute();
    
                return $result;
            } catch (PDOException $error) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }


        function create(Cuenta $cuenta)
        {

        try {
            // plantilla
            $sql = " INSERT INTO cuentas (num_cuenta,id_cliente,fecha_alta,fecha_ul_mov,num_movtos,saldo)values( 
                    :num_cuenta,
                    :id_cliente,
                    :fecha_alta,
                    :fecha_ul_mov,
                    :num_movtos,
                    :saldo
                )";

            #Conectar con la base de datos

            $conexion = $this->db->connect();

            $result = $conexion->prepare($sql);

            //Bindeamos parametros

            $result->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_STR,30);
            $result->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_STR,50);
            $result->bindParam(":fecha_alta", $cuenta->fecha_alta);
            $result->bindParam(":fecha_ul_mov", $cuenta->fecha_ul_mov);
            $result->bindParam(":num_movtos", $cuenta->num_movtos, PDO::PARAM_STR,30);
            $result->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_STR,9);

            // ejecuto
            $result->execute();
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function redCuenta($id)
        {

            try {
                // plantilla
                $sql = " select 
                        cu.id,
                        cu.num_cuenta,
                        cu.id_cliente,
                        cl.apellidos as apellidos,
                        cl.nombre as nombre,
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo
                        from cuentas as cu inner join clientes as cl on cu.id_cliente = cl.id  
                        where cu.id = $id";

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
        
        public function update(Cuenta $cuenta, $id)
        {
            try {
                // plantilla
                $sql = " Update cuentas   
                        SET 
                        num_cuenta = :num_cuenta,
                        id_cliente = :id_cliente,
                        fecha_alta = :fecha_alta,
                        saldo = :saldo
                        where id = $id;";
    
                $conexion = $this->db->connect();

                #Ejecutamos mediante prepare la sentencia SQL

                $result = $conexion->prepare($sql);
    
    
                $result->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_STR,30);
                $result->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_STR,50);
                $result->bindParam(":fecha_alta", $cuenta->fecha_alta, PDO::PARAM_STR,50);
                $result->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_STR,9);
    
                // ejecuto
                $result->execute();
                // print_r($result);
            } catch (PDOException $e) {
                require_once("template/partials/errorDB.php");
                exit();
            }
        }

        function deleteCuenta($id)
        {
            try {
                // plantilla
                $sql = "Delete from cuentas where id = :id;";

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
                select 
                cu.id,
                cu.num_cuenta,
                cl.apellidos as apellidos,
                cl.nombre as nombre,
                cu.fecha_alta,
                cu.fecha_ul_mov,
                cu.num_movtos,
                cu.saldo,
                cu.id_cliente
                from cuentas as cu inner join clientes as cl on cu.id_cliente = cl.id
                order by $criterio";


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
                        select 
                        cu.id,
                        cu.num_cuenta,
                        cl.apellidos as apellidos,
                        cl.nombre as nombre,
                        cu.fecha_alta,
                        cu.fecha_ul_mov,
                        cu.num_movtos,
                        cu.saldo,
                        cu.id_cliente
                        from cuentas as cu inner join clientes as cl on cu.id_cliente = cl.id where
                        concat_ws(' ',
                            cu.id,
                            cu.num_cuenta,
                            cl.apellidos,
                            cl.nombre,
                            cu.fecha_alta,
                            cu.fecha_ul_mov,
                            cu.num_movtos,
                            cu.saldo) like ?";

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