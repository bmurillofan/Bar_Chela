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



        /*
        *
        * Retorna Array con Datos del Query Ejecutado
        */
        
        function obtener_lista_usuarios(){

          $query = 'SELECT * FROM usuarios';
          $data = mysqli_fetch_all($this->get_results_from_query($query));
          return $data;
        
        }



        function verificar_captcha($respuestaCaptcha){
         $respuesta = false;
         //Clave que nos brinda Google captcha no compartible
         $secret = "6Lc86lIUAAAAAO62rzDyhnYi30zdGUDCN8eNERiz";
         /*Response sera el codigo que nos enviara la persona que realiza
         la captcha*/
         $response = $respuestaCaptcha;
         //URL para realizar el envio
         $url = "https://www.google.com/recaptcha/api/siteverify";
          //Enviamos IP para seguimiento
          $ip =  $_SERVER['REMOTE_ADDR'];
                 //Enviamos captcha y atrapamos respuesta
                 $enviar_captcha_google = file_get_contents($url."?secret=".$secret."&response=".$response."&remoteip=".$ip);
                 /*La respuesta llega como json, la cual le realizamos una json_decode
                 para transformala en array() y usarla*/
                 $respuesta_captcha_google=json_decode($enviar_captcha_google,true);
                 /*en el array buscamos el campo Success y verificamos el
                 estado, si es true la captcha es aceptada, en caso contrario
                 sera false*/
                 if ($respuesta_captcha_google["success"] == true) {
                    $respuesta = true;
                 }else{
                    $respuesta = false;
                 }

                 return $respuesta;
         }




         function verificar_existencia($usuarioR,$contrasenaR){
          //Se carga los $_POST
          $usuario = $usuarioR;
          $contrasena = $contrasenaR;
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
                  
                unset($query);
                unset($data);

                $query = "SELECT password FROM usuarios WHERE username = '".$usuario."'";
                $data = mysqli_fetch_assoc($this->get_results_from_query($query));
                
                
                if ($data['password'] == $contrasena) {
                    $respuesta = true;
                }

              }else{
                $respuesta = false;
              }

              return $respuesta;
          }



          function loguear_usuario($usuarioR){
               unset($query);
               unset($data);
               $usuario = $usuarioR;
               $query = "SELECT id_rol FROM usuarios WHERE username ='".$usuario."'";
               $data = mysqli_fetch_assoc($this->get_results_from_query($query));
              

               //abrimos sesion
               session_start();
               if ($data['id_rol'] == '1') {
               
                  $_SESSION["admin"] = array("estado"=>true,"nombre"=>$usuario,"tipo"=>"admin");
                  
                   header("Location: ../grow_more_seed_dashboard/dashboard.php");

               }elseif ($data['id_rol'] == '2') {
                
                  $_SESSION["mesero"] = array("estado"=>true,"nombre"=>$usuario,"tipo"=>"mesero");
              
                  header("Location: ../municipios/controller_municipios2.php");
               
               }elseif ($data['id_rol'] == '3') {
                  
                  $_SESSION["caja"] = array("estado"=>true,"nombre"=>$usuario,"tipo"=>"caja");

                   header("Location: ../municipios/controller_municipios3.php");

               }else{

                  header("Location: ./homeController.php");
 
               }
        }


             

        





        /*********************************************************************************/


  		


       }


 ?>