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
		//**************************************************************************************


		//*************************( Contenido del controller global)******************************** 
			//Variable Global rootScope
			//$rootScope.variable = "variable global"

		//*************************************************************************************

		$scope.crear = function(){
			$scope.desactivar = true;
		};



});

//****************************************************************************************************************************


	
