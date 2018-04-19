<?php


  error_reporting(0);
  require_once('./registroModel.php');
  require_once('../../view/view_class.php');

  /* Arranque */

 
  handler();
  


 


  //Middleware o Handler intermediario entre vista y controlador directo
  function handler() {

    $obj_view = create_obj_view();
    $obj_model = create_obj_model();

    

    if (empty($_POST)) {
        print($obj_view->get_template('registro','registro'));
    }else{
       
       if ($obj_model->verificar_existencia($_POST['username'])) {
              
              $arrayData = array(0 => '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Username en uso!</strong> Por favor, intente nuevamente.
                                    </div>');
             $remplazar_token = array(0 => '<span class="badge badge-default">Registro</span>');

             print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('registro','registro'), $arrayData, $remplazar_token));
        }else{
            $obj_model->crear_user($_POST['nombre'] , $_POST['apellido'] ,$_POST['cedula']  , $_POST['username'] , $_POST['password'] , $_POST['id_rol'] );

            $arrayData = array(0 => '<span class="badge badge-default">Se creo con exito el usuario '.$_POST["username"].'</span>');
             $remplazar_token = array(0 => '<span class="badge badge-default">Registro</span>');

             print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('registro','registro'), $arrayData, $remplazar_token));

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