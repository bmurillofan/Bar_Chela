/*************************************************************************************************
**									  	Modulo Controller										**
**************************************************************************************************/
	
	// angular.module se compone de ('Nombre del modulo',[dependencias])
	angular.module('dashboard',[])
	//.controller para el controlador de angular el cual se compone ('Nombre Controller', directiva en function($scope))
	.controller('dashboard_Controller', function($scope,$timeout,$rootScope) {
	// Fin Modulo controller 


		//*************************( Contenido del controller )******************************** 
			//$scope.variable = "variable";
			$scope.title = {
				usuarios: "Activado"
			},
		//**************************************************************************************


		//*************************( Contenido del controller global)******************************** 
			//Variable Global rootScope
			//$rootScope.variable = "variable global"

		//*************************************************************************************

		$scope.bto = {
			nombre: false,
			apellido: false,
			cedula: false,
			username: false,
			password: false,
			cargar: true,
			ejecutar: false
		},

		$scope.crear = function(){
			$scope.bto.username = true;
			$scope.bto.cargar = false;
			$scope.bto.ejecutar = true;	
			$scope.title.usuarios = "Cargando usuario..";
		};





});

//****************************************************************************************************************************


	
