<?php

  /******************************************
  *         Controlador Dash-Crud         	*
  *          Dash-Crud Controller         	*
  ******************************************/



  /*require
  * Action: Importar documentos
  * Parametros:  Ruta de documento require('ruta')
  */

  require_once('./crudModel.php');
  require_once('../../view/view_class.php');

  /*************************************  ARRANQUE **************************************************/

   session_start();


   if (isset($_SESSION["admin"])) {

          if ($_SESSION["admin"]["estado"] == true) {
 
              handler();
            
          }else{
              header("Location: ../../../../core/fast_script_php/logout.php");                    
          }


   }else{
      header("Location: ../../../../core/fast_script_php/logout.php");
   }

   /********************************** FIN ARRANQUE *************************************************/
 


  //Middleware o Handler intermediario entre vista y controlador directo
  function handler() {

    $obj_view = create_obj_view();
    $obj_model = create_obj_model();


    print( $obj_view->get_template('dashboard','dashboard'));

  }


  //Funcion de instancia de clase del modelo new 'MODELO' en este caso HomeModel
  function create_obj_model() {
    $obj = new Model();
    return $obj;
  }

  //Funcion de instancia de clase de la vista new 'VIEW' en este caso HomeModel
  function create_obj_view() {
    $obj = new view();
    return $obj;
  }
  
 ?>