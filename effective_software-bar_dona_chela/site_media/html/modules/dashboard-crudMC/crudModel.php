<?php

  /******************************************
  *            Modelo de home        	     	*
  *              Home Model         		    *
  ******************************************/


//Require Clase abstracta de conexion
require_once '../../../../core/db_class/db_connect_abstract_class/connect_mysql_php.php';


  		class Model extends Conectar {

  			/*
  			*
  			* Variables
  			*/
        public $var = "DEFAULT";


        /*********************************************************************************/

        //Apuntador de DB
        function __construct()
        {
            $this->db_name = 'u948420309_esbdc';
        }
        
        
         function verificar_existencia($usuarioR){
          //Se carga los $_POST
          $usuario = $usuarioR;
          $respuesta = false;

                /*Recorremos la base de datos buscando un unico usuario que coincida con
                  el ingresado, y $token_user los contara,solo deber haber 1*/
                  $token_user = 0;

              $query = 'SELECT username FROM usuarios';
              $data = mysqli_fetch_all($this->get_results_from_query($query));
              //return $data;

              for ($i = 0; $i < count($data); $i++) {

                   if ($data[$i][0] == $usuario){
                         $token_user++;
                   }

              }

              if ($token_user == 1) {
                $respuesta = true;
              }

              return $respuesta;
          }


          function get_info_user($usuarioR){

                $query = 'SELECT * FROM u948420309_esbdc.usuarios WHERE username = "'.$usuarioR.'"';
                $data = mysqli_fetch_assoc($this->get_results_from_query($query));
                return $data;

          }




        /*********************************************************************************/


  		


       }


 ?>