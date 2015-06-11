

//Aqui guardaremos la logica de las paginas que nos permitira desplazarnos por la web con las diferentes direcciones controlando que no nos puedan entrar en otras partes

var app = angular.module("app", ["ngRoute"]);


//Creamos las direcciones y enrutamientos de la web
app.config(['$routeProvider', function($routeProvider)
{
	//Indicamos cuales van a ser las url cuando este en las diferentes secciones de la web
	$routeProvider.when("/home",{
		templateUrl: "templates/home.html",
		controller: "homeCtrl"
	});
	$routeProvider.when("/about",{
		templateUrl: "templates/about.html",
		controller: "aboutCtrl"
	});
	$routeProvider.when("/contact",{
		templateUrl: "templates/contact.html",
		controller: "contactCtrl"
	});
	$routeProvider.when("/blog",{
		templateUrl: "templates/blog.html",
		controller: "blogCtrl"
	});	
	$routeProvider.otherwise({
		//templateUrl: "templates/home.html",
		//controller: "homeCtrl"
		redirectTo: "/"
	});
}]);


//Creamos los controladores de la web

//En este injectamos el servicio que nos mostrará la informacion de la web de la empresa o centro
app.controller('homeCtrl', ['$scope', 'ServiceEmpresas', function($scope, ServiceEmpresas)
{
	$scope.message = "Home";

	var promesa = ServiceEmpresas.getEmpresas();

	promesa.then(function(data){
		$scope.empresas = data.empresas;
	},function(error){
		alert("Error " + error);
	});
}]);

app.controller('aboutCtrl', ['$scope', function($scope)
{
	$scope.message = "About";
}]);

app.controller('contactCtrl', ['$scope', function($scope)
{
	$scope.message = "Contact";
}]);

//En este injectamos el servicio de los Tipos para poder mostrarlos ahi
app.controller('blogCtrl', ['$scope', 'ServiceTipos', function($scope, ServiceTipos)
{
	$scope.message = "Blog";

	var promesa = ServiceTipos.getTipos();

	promesa.then(function(data){
		$scope.tipos = data.tipos;
	},function(error){
		alert("Error " + error);
	});
}]);


//Creamos los Servicios de la web

//Generamos la logica del servicio que llamara al controlador de Tipo
app.service('ServiceTipos', ['$http', '$q', function($http, $q)
{
	//obtenemos los tipos con una funcion
	this.getTipos = function(){
		//creamos una variable para la promesa
		var defer = $q.defer();
		//asignamos el get de la variable http con el metodo getAction del controlador Tipo
		$http.get("tipo/get")
			.success(function(data){
				defer.resolve(data);
			})
			.error(function(data){
				defer.reject(data);
			});

		return defer.promise;
	};

}]);


//Generamos la logica del servicio que nos llamara al controlador para mostrar el contenido web
app.service('ServiceEmpresas', ['$http', '$q', function($http, $q)
{
	//obtenemos las empresas con una function
	this.getEmpresas = function(){
		//creamos la variable para la promesa
		var defer = $q.defer();
		//asignamos el get de la variable http con el metodo getAction del controlador Empresa
		$http.get("empresa/get")
			.success(function(data){
				defer.resolve(data);
			})
			.error(function(data){
				defer.reject(data);
			});

		return defer.promise;
	};
}]);

