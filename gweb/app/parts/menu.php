

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

            <!-- Collect the nav links, forms, and other content for toggling -->
                <?php $this->elements->getMenu(); ?>

            <!-- /.navbar-collapse -->
            </div>

        <!-- /.container -->
        </nav>


