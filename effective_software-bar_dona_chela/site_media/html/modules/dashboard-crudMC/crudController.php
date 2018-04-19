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

                

    if (empty($_POST)) {
              $array = $obj_model->obtener_lista_usuarios();
              $data_list = "";
              for ($i = 0; $i < count($array); $i++) { 
                    $data_list = ' <option  value="'.$array[$i][0].'">'.$array[$i][1].'</option> '. $data_list;
              }
              $arrayData = array(0 => $data_list);      
              $remplazar_token = array(0 => '<option  value="1">Sin carga</option>');
              print($obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('dashboard','dashboard'), $arrayData, $remplazar_token));

    }else{

      if ($_POST['id_usuarios'] == "" && isset($_POST['username']) && $_POST['form_type'] == "formulario_usuario" ) {
            
            if ($obj_model->verificar_existencia($_POST['username'])) {
                
                $array_with_data = $obj_model->get_info_user($_POST['username']);     
                $arrayData = array(0 => 'placeholder="'.$array_with_data["id_usuarios"].'"' ,1 => 'placeholder="'.$array_with_data["nombre"].'"',2 => 'placeholder="'.$array_with_data["apellido"].'"',3 => 'placeholder="'.$array_with_data["cedula"].'"', 4 => 'placeholder="'.$array_with_data["username"].'"', 5 => 'placeholder="************"' , 6 => "Usuario Cargado");
               
                $remplazar_token = array(0 => 'placeholder="ID"',1 => 'placeholder="Nombre"',2 => 'placeholder="Apellido"', 3 => 'placeholder="C.C"', 4 => 'placeholder="Usuario"', 5 => 'placeholder="Contraseña"',6 => 'Mensaje!!');
          
                print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('dashboard','dashboard'), $arrayData, $remplazar_token));
                  
            }else{
                
                $arrayData = array(0 => 'No se ha encontrado el usuario');      
                $remplazar_token = array(0 => 'Mensaje!!');
                print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('dashboard','dashboard'), $arrayData, $remplazar_token));
            }



      }elseif($_POST['form_type'] == "formulario_usuario_editar"){
              $obj_model->actualizar_user($_POST['id_usuarios'],$_POST['nombre'],$_POST['apellido'],$_POST['cedula'],$_POST['password']);
              $arrayData = array(0 => 'Se actualizo a '.$_POST['nombre']);      
              $remplazar_token = array(0 => 'Mensaje!!');
              print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('dashboard','dashboard'), $arrayData, $remplazar_token));

      }elseif($_POST['form_type'] == "formulario_usuario_eliminar"){
            
               $obj_model->delete_user($_POST['id_usuarios']);
               $arrayData = array(0 => 'Se Elimino un usuario');      
               $remplazar_token = array(0 => 'Mensaje!!');
                print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('dashboard','dashboard'), $arrayData, $remplazar_token));
      }else{

             $arrayData = array(0 => 'Ninguna accion aplicada');      
               $remplazar_token = array(0 => 'Mensaje!!');
                print( $obj_view->get_temaplate_render_dinamic_data($obj_view->get_template('dashboard','dashboard'), $arrayData, $remplazar_token));
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