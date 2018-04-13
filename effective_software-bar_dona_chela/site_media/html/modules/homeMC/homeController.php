<?php

  /******************************************
  *          Controlador Home              	*
  *           Home Controller         	    *
  ******************************************/



  /*require
  * Action: Importar documentos
  * Parametros:  Ruta de documento require('ruta')
  */

  require_once('./homeModel.php');
  require_once('../../view/view_class.php');

  /* Arranque */

  if (isset($_SESSION)) {
      if($_SESSION["admin"]["estado"] == true) {
        header("Location:../../../../core/fast_script_php/logout.php");
      }elseif ($_SESSION["mesero"]["estado"] == true) {
            header("Location:../../../../core/fast_script_php/logout.php");
      }elseif ($_SESSION["caja"]["estado"] == true) {
            header("Location:../../../../core/fast_script_php/logout.php");
      }else{
         handler();
      }   
  }else{
     handler();
  }


 


  //Middleware o Handler intermediario entre vista y controlador directo
  function handler() {

    $obj_view = create_obj_view();
    $obj_model = create_obj_model();

    if (empty($_POST)) {
      //Generar vista
      print( $obj_view->get_template('home','home'));
        
    }else{

        if (empty($_POST['g-recaptcha-response'])) {

             $arrayData = array(0 => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Error en Captcha!</strong> Por favor, intente nuevamente.
                                    </div>');
             $remplazar_token = array(0 => '<span class="badge badge-default">Captcha</span>');

             print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('home','home'), $arrayData, $remplazar_token));
            
        }else{
           
             $request = $_POST['g-recaptcha-response'];
            
            if ($obj_model->verificar_captcha($request)) {
              //Verificar usuario
                if ($obj_model->verificar_existencia($_POST['usuario'],$_POST['contrasena'])) {

                           $obj_model->loguear_usuario($_POST['usuario']);

                }else{
                     $arrayData = array(0 => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Usuario o Contraseña incorrectos!</strong> Por favor, intente nuevamente.
                                    </div>');
                      $remplazar_token = array(0 => '<span class="badge badge-default">Captcha</span>');

                      print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('home','home'), $arrayData, $remplazar_token));
                }
                
            }

        }
       
         
    }

    



    

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