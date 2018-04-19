<?php

/**
 *Clase abstracta, Conextar BD, CRUD
 */

abstract class Conectar {




    //Variables de conexion
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = '';
    protected $db_name = 'u948420309_esbdc';


    /*
    *  Variables de CRUD
    */

    //Conexion
    private $conn;

/******************************* ZONA ABRIR Y CERRAR CONEXION *******************************************************/

    /*
    * Abrir Conexion
    *
    * Metodo open_connection()
    * Action: Abre Conexion
    * Parametros: No presenta   
    */               
    private function open_connection() {

        //Conectar con parametros
        $this->conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, $this->db_name);
        
        //Caracteres tipo utf8
        $this->conn->set_charset("utf8");
    }



    /*
    * Cerrar Conexion
    *
    * Metodo close_connection()
    * Action: Cierra Conexion anteriormente abierta
    * Parametros: No presenta   
    */
    private function close_connection() {
        //Cerrar conexion
        $this->conn->close();
    }

/******************************* FIN ZONA ABRIR Y CERRAR CONEXION *******************************************************/
    








/******************************* ZONA CRUD DB *******************************************************/    
    
    /*
    * Ejecutar un query simple del tipo INSERT, DELETE, UPDATE
    *
    * Metodo execute_single_query()
    * Action: Abre conexion, ejecuta Query y cierra conexion
    * Parametros: query SQL
    */
    protected function execute_single_query($query) {

        $this->open_connection();

        //Ejecutar Query
        $this->conn->query($query);

        $this->close_connection();
    }


     
    /*
    * Traer resultados de una consulta Query
    *
    * Metodo get_results_from_query()
    * Action: retorna resultado de Query
    * Parametros: query SQL
    */
    protected function get_results_from_query($query) {
        $this->open_connection();
        
        //Cargar en $result_query el resultado del Query
        $result_query = $this->conn->query($query);
       
        $this->close_connection();
        return $result_query;
    }

/******************************* FIN ZONA CRUD DB *******************************************************/ 


}

?>
