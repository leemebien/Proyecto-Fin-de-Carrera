<!DOCTYPE html>
<html lang="es" data-ng-app="app">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Casual - Start Bootstrap Theme</title>

	<!-- Añadimos la salida de los archivos CSS -->    
	{{ assets.outputCss() }}
	<!-- /.Añadimos la salida de los archivos CSS --> 

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<!-- Inbicio Experimento -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function() {
        var dialog;

        function logUser()
        {
            var valid = true;

            //Comprobamos que los campos cumplen los requisitos

            //Ahora comprobamos que existe el usuario
            if(valid)
            {
                dialog.dialog( "close" );
            }
            return valid;
        }

        function createUser()
        {
            dialog.dialog( "close" );
        }
 
        dialog = $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Login User": logUser,
                Cancel: function() {
                    dialog.dialog( "close" );
                },
                "Create an account": createUser
            },
            close: function() {
                dialog.dialog( "close" );
            }
        });
 
        $( "#create-user" ).button().on( "click", function() {
            dialog.dialog( "open" );
        });
    });
</script>
<!-- Fin Experimento -->

</head>

<body>

<!-- Inbicio Experimento -->
<div id="dialog-form" title="Log In/Sign Up">
    <p class="validateTips">Introduzca credenciales para entrar en su área reservada.</p>
    {{ form('usuario/login', 'method': 'post') }}
 
    <label>Email</label>
    {{ text_field("email", "size": 32) }}
 
    <label>Contraseña</label>
    {{ text_field("password", "size": 32) }}

    {{ submit_button('Login') }}
 
    </form>
</div>
<!-- Fin Experimento -->

    <div class="brand">Business Casual</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar">
                    </span>
                    <span class="icon-bar">
                    </span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="#/home">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#/home">Home</a>
                    </li>
                    <li>
                        <a href="#/about">About</a>
                    </li>
                    <li>
                        <a href="#/blog">Blog</a>
                    </li>
                    <li>
                        <a href="#/contact">Contact</a>
                    </li>
                    <li>
                        <button id="create-user">Log In/Sign Up</button>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.Navigation -->

    <div class="container">
    	<div ng-view>
    	</div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

	<!-- Añadimos la salida de los archivos JS -->    
	{{ assets.outputJs() }}
	<!-- /.Añadimos la salida de los archivos JS -->

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script> 

</body>

</html>
