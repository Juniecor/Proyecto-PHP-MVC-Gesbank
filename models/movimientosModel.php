<?php 

    class MovimientosModel extends Model{

        #Extraer todos los movimientos
        public function get($id)
        {
            try {
                $sql = "
                
                    select 
                        mov.id,
                        mov.id_cuenta,
                        mov.concepto,
                        mov.fecha_hora,
                        mov.tipo,
                        mov.cantidad,
                        mov.saldo,
                        cu.num_cuenta
                    from movimientos as mov inner join cuentas as cu on mov.id_cuenta = cu.id
                    where mov.id_cuenta = $id;
                
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

        function create(Movimiento $movimiento)
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

            $result->bindParam(":num_cuenta", $movimiento->num_cuenta, PDO::PARAM_STR,30);
            $result->bindParam(":id_cliente", $movimiento->id_cliente, PDO::PARAM_STR,50);
            $result->bindParam(":fecha_alta", $movimiento->fecha_alta);
            $result->bindParam(":fecha_ul_mov", $movimiento->fecha_ul_mov);
            $result->bindParam(":num_movtos", $movimiento->num_movtos, PDO::PARAM_STR,30);
            $result->bindParam(":saldo", $movimiento->saldo, PDO::PARAM_STR,9);

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
                        *
                        from cuentas
                    where id = $id";

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

       
    }
?>