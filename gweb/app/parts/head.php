<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Business Casual - Start Bootstrap Theme</title>

<?php $this->assets->outputCss(); ?>
    <!-- Bootstrap Core CSS -->
    <!--link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!--link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php $this->assets->outputJs(); ?>
<script>

$(function() {

$( "#dialog" ).dialog({
autoOpen: false,
modal: true,
show: {
effect: "blind",
duration: 300
},
hide: {
effect: "explode",
duration: 300
},
close: function() {
$( this ).dialog( "close" );
}
});

 
/*$( "#login" ).click(function() {
$( "#dialog" ).dialog( "open" );
});*/
/*$( "#opener" ).click(function() {
$( "#dialog" ).dialog( "open" );
});*/
});

</script>

</head>

<body>

    <div class="brand">Business Casual</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
 
<div id="dialog" title="Basic dialog">
<P>
<?php $this->flash->output(); ?>
</P>
</div>

<!--button id="opener" hidden>Open Dialog</button-->    

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Business Casual</a>
            </div>

<?php $this->elements->getMenu(); ?>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!--div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <!--a href="index.html">Home</a-->
                        <!--?php echo $this->tag->linkTo("index", "Home"); ?>
                    </li>
                    <li>
                        <!--a href="about.html">About</a-->
                        <!--?php echo $this->tag->linkTo("about", "About"); ?>
                    </li>
                    <li>
                        <!--a href="blog.html">Blog</a-->
                        <!--?php echo $this->tag->linkTo("blog", "Blog"); ?>
                    </li>
                    <li>
                        <!--a href="contact.html">Contact</a-->
                        <!--?php echo $this->tag->linkTo("contact", "Contact"); ?>
                    </li>
                    <li>
                        <!--?php echo $this->tag->linkTo("usuario", "Sign Up Here!"); ?>
                    </li>
                </ul>
            </div-->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">
