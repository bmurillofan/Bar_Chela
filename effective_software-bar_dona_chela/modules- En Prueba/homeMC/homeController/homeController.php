<?php

  /******************************************
  *          Controlador Home              	*
  *           Home Controller         	    *
  ******************************************/



  /*require
  * Action: Importar documentos
  * Parametros:  Ruta de documento require('ruta')
  */

  require_once('../homeModel/homeModel.php');
  require_once('../../../site_media/html/view/view_class.php');

  /* Arranque */
  handler();

  //Middleware o Handler intermediario entre vista y controlador directo
  function handler() {

    $obj = create_obj();
    print( $obj->get_template('home_ng','home'));


  }



  //Funcion de instancia de clase del modelo new 'MODELO' en este caso HomeModel
  function create_obj() {
    $obj = new view();
    return $obj;
  }
  
 ?>