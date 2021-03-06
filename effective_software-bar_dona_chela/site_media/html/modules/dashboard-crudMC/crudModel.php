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



          function actualizar_user($id_usuarios , $nombre , $apellido , $cedula , $password){
                $query = "Update u948420309_esbdc.usuarios Set nombre='".$nombre."', apellido = '".$apellido."',cedula='".$cedula."',password='".$password."' Where id_usuarios='".$id_usuarios."'";
                  $this->execute_single_query($query);
          }


          function obtener_lista_usuarios(){

          $query = 'SELECT id_usuarios,username FROM usuarios';
          $data = mysqli_fetch_all($this->get_results_from_query($query));
          return $data;
        
        }

          function delete_user($id_usuarios){
                $query = "DELETE FROM u948420309_esbdc.usuarios WHERE id_usuarios='".$id_usuarios."'";
                 $this->execute_single_query($query);
          }


        /*********************************************************************************/


  		


       }


 ?>