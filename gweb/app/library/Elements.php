<?php

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends ComponentBase
{
	private $_menuCabeceraPublica;
    private $_menuCabeceraPrivado;
    private $_menuCabeceraPrivadoPadre;
    private $_menuCabeceraPrivadoProfe;
    private $_menuCabeceraPrivadoAdmin;
    private $_menuCabeceraPrivadoSU;


    public function initialize()
    {
        $this->_menuCabeceraPublica = array('navbar-nav' => array('index' => array('caption' => 'Home',
                                                                                    'action' => 'index'),
                                                                   'about' => array('caption' => 'About',
                                                                                    'action' => 'index'),
                                                                    'blog' => array('caption' => 'Blog',
                                                                                    'action' => 'index'),
                                                                    'contact' => array('caption' => 'Contact',
                                                                                        'action' => 'index'),
                                                                    'usuario' => array('caption' => 'Log In/Sign Up',
                                                                                        'action' => 'login'),
                                                                )
                                            );

        $this->_menuCabeceraPrivado = array('navbar-nav' => array('index' => array('caption' => 'Home',
                                                                                    'action' => 'index'),
                                                                    'trabajo' => array('caption' => 'Trabajo',
                                                                                        'action' => 'index'),
                                                                    'about' => array('caption' => 'About',
                                                                                    'action' => 'index'),
                                                                    'blog' => array('caption' => 'Blog',
                                                                                    'action' => 'index'),
                                                                    'contact' => array('caption' => 'Contact',
                                                                                        'action' => 'index'),
                                                                    'usuario' => array('caption' => 'Log In/Sign Up',
                                                                                        'action' => 'login'),
                                                                )
                                            );

        $this->_menuCabeceraPrivadoPadre = array('navbar-nav' => array('index' => array('caption' => 'Home',
                                                                                        'action' => 'index'),
                                                                        'trabajopadre' => array('caption' => 'Padres',
                                                                                                'action' => 'index'),
                                                                        'about' => array('caption' => 'About',
                                                                                        'action' => 'index'),
                                                                        'blog' => array('caption' => 'Blog',
                                                                                        'action' => 'index'),
                                                                        'contact' => array('caption' => 'Contact',
                                                                                            'action' => 'index'),
                                                                        'usuario' => array('caption' => 'Log In/Sign Up',
                                                                                            'action' => 'login'),
                                                                    )
                                                );

        $this->_menuCabeceraPrivadoProfe = array('navbar-nav' => array('index' => array('caption' => 'Home',
                                                                                        'action' => 'index'),
                                                                        'trabajoprofe' => array('caption' => 'Profes',
                                                                                                'action' => 'index'),
                                                                        'about' => array('caption' => 'About',
                                                                                        'action' => 'index'),
                                                                        'blog' => array('caption' => 'Blog',
                                                                                        'action' => 'index'),
                                                                        'contact' => array('caption' => 'Contact',
                                                                                            'action' => 'index'),
                                                                        'usuario' => array('caption' => 'Log In/Sign Up',
                                                                                            'action' => 'login'),
                                                                    )
                                                );

        $this->_menuCabeceraPrivadoAdmin = array('navbar-nav' => array('index' => array('caption' => 'Home',
                                                                                        'action' => 'index'),
                                                                        'trabajoadmin' => array('caption' => 'Administración',
                                                                                                'action' => 'index'),
                                                                        'about' => array('caption' => 'About',
                                                                                        'action' => 'index'),
                                                                        'blog' => array('caption' => 'Blog',
                                                                                        'action' => 'index'),
                                                                        'contact' => array('caption' => 'Contact',
                                                                                            'action' => 'index'),
                                                                        'usuario' => array('caption' => 'Log In/Sign Up',
                                                                                            'action' => 'login'),
                                                                    )
                                                );

        $this->_menuCabeceraPrivadoSU = array('navbar-nav' => array('index' => array('caption' => 'Home',
                                                                                    'action' => 'index'),
                                                                    'trabajoSU' => array('caption' => 'S.U.',
                                                                                            'action' => 'index'),
                                                                    'about' => array('caption' => 'About',
                                                                                    'action' => 'index'),
                                                                    'blog' => array('caption' => 'Blog',
                                                                                    'action' => 'index'),
                                                                    'contact' => array('caption' => 'Contact',
                                                                                        'action' => 'index'),
                                                                    'usuario' => array('caption' => 'Log In/Sign Up',
                                                                                        'action' => 'login'),
                                                                )
                                            );
    }


	/**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        $this->initialize();

        $auth = $this->session->get('auth');
        if ($auth) {
            /*$this->_menuCabeceraPrivado['navbar-nav']['usuario'] = array(
                //'caption' => 'Log Out',
                'caption' => 'Log Out (' . $auth['name'] . ')',
                //'caption' => $auth->name,
                'action' => 'end'
            );
            $_menu = $this->_menuCabeceraPrivado;*/

            switch ($auth['rol']) {
                case 2: // Barra de menu para administrativos
                    $this->_menuCabeceraPrivadoSU['navbar-nav']['usuario'] = array(
                    //'caption' => 'Log Out',
                    'caption' => 'Log Out (' . $auth['name'] . ')',
                    //'caption' => $auth->name,
                    'action' => 'end'
                    );
                    $_menu = $this->_menuCabeceraPrivadoSU;
                    break;

                case 3: // Barra de menu para administrativos
                    $this->_menuCabeceraPrivadoAdmin['navbar-nav']['usuario'] = array(
                    //'caption' => 'Log Out',
                    'caption' => 'Log Out (' . $auth['name'] . ')',
                    //'caption' => $auth->name,
                    'action' => 'end'
                    );
                    $_menu = $this->_menuCabeceraPrivadoAdmin;
                    break;

                case 4: // Barra de menu para profes
                    $this->_menuCabeceraPrivadoProfe['navbar-nav']['usuario'] = array(
                    //'caption' => 'Log Out',
                    'caption' => 'Log Out (' . $auth['name'] . ')',
                    //'caption' => $auth->name,
                    'action' => 'end'
                    );
                    $_menu = $this->_menuCabeceraPrivadoProfe;
                    break;

                case 5: // Barra de menu para padres
                    $this->_menuCabeceraPrivadoPadre['navbar-nav']['usuario'] = array(
                    //'caption' => 'Log Out',
                    'caption' => 'Log Out (' . $auth['name'] . ')',
                    //'caption' => $auth->name,
                    'action' => 'end'
                    );
                    $_menu = $this->_menuCabeceraPrivadoPadre;
                    break;

                default: // Barra de menu para el resto de trabajadores
                    $this->_menuCabeceraPrivado['navbar-nav']['usuario'] = array(
                    //'caption' => 'Log Out',
                    'caption' => 'Log Out (' . $auth['name'] . ')',
                    //'caption' => $auth->name,
                    'action' => 'end'
                    );
                    $_menu = $this->_menuCabeceraPrivado;
                    break;
            }
            $_chek = 0;
        } else {
            //unset($this->_menuCabecera['navbar-nav']['about']);
            $_menu = $this->_menuCabeceraPublica;
            $_chek = 1;
        }

        $controllerName = $this->view->getControllerName();
        //foreach ($this->_menuCabecera as $position => $menu) {
        foreach ($_menu as $position => $menu) {
            echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                //echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);

                if($controller == 'usuario' AND $_chek == 1)
                {
                    echo $this->tag->form($controller . "/" . $option['action']);
                    
                    echo '<table width="50" height="100"><tr><td><table><tr><td>';
                    echo 'Nombre:';
                    echo '</td><td>';
                    
                    echo $this->tag->textField(array("nombre", "size" => 10));
                    
                    echo '</td></tr><tr><td>';
                    echo 'Password:';
                    echo '</td><td>';
                    
                    echo $this->tag->passwordField(array("password", "size" => 10));
                    
                    echo '</td></tr></table></td><td align="center">';
                    
                    echo $this->tag->submitButton(array($option['caption'], "id" => "login"));

                    echo $this->tag->linkTo('usuario' . '/' . 'index', 'Registrate');
                    
                    echo '</td></tr></table>';
                    
                    echo $this->tag->endForm();
                }
                else {
                    echo $this->tag->linkTo($controller . "/" . $option['action'], $option['caption']);
                }

                echo '</li>';
            }

            echo '</ul>';
            echo '<ul class="nav navbar-nav ">';

            echo '<li><div id="dialogInfoLogin" title="Información">';
            $this->flash->output(); 
            echo '</div></li>';
            
            echo '</ul>';
            echo '</div>';
        }

    }


    public function getName()
    {
        $auth = $this->session->get('auth');

        if ($auth) 
        {
/*            switch ($auth['centro']) {
                case 1: 
                    echo 'Centro 1';
                    break;

                case 2: 
                    echo 'Centro 2';
                    break;

                case 3: 
                    echo 'Centro 3';
                    break;

                default: 
*/                    echo 'Business Casual';
//                    break;
//            }
        }
        else
        {
            echo 'Business Casual';
        }        
    }


    public function getDirection()
    {
        $auth = $this->session->get('auth');

        if ($auth) 
        {
/*            switch ($auth['centro']) {
                case 1: 
                    echo 'Dirección 1';
                    break;

                case 2: 
                    echo 'Dirección 2';
                    break;

                case 3: 
                    echo 'Dirección 3';
                    break;

                default: 
*/                    echo '3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890';
//                    break;
//            }
        }
        else
        {
            echo '3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890';
        }
    }

    public function getFormulario($valor)
    {

        switch ($valor) {

            case 'alumno':
                echo $this->tag->form(array("entidad/operacionalumno", "method" => "post"));
                
                    echo "<div>";
                        echo "<table border='1' width='100%''>";
                            echo "<tr>";
                                echo "<td colspan='2'>";
                                    echo "Id";
                                    echo "<input type='text'>";
                                echo "</td>";
                                echo "<td colspan='2'>";
                                    echo "Nombre";
                                    echo "<input type='text'>";
                                echo "</td>";
                                echo "<td rowspan='4' colspan='2' align='center'>";
                                    echo "<button>";
                                        echo "<img src='http://www.arifriedenbach.com.br/site/wp-content/uploads/2013/02/icon_lupa.png' alt='foto' width='42' height='42'>";
                                    echo "</button>";
                                echo"</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan='4'>";
                                    echo "Apellidos";
                                    echo "<input type='text'>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan='4'>";
                                    echo "Direccion";
                                    echo "<input type='text'>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan='4'>";
                                    echo "Telefono Fijo";
                                    echo "<input type='text'>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan='4'>";
                                    echo "Padre";
                                    echo "<input type='text'>";
                                    echo "<button>";
                                        echo "<img src='http://www.arifriedenbach.com.br/site/wp-content/uploads/2013/02/icon_lupa.png' alt='Buscar Padre' width='42' height='42'>";
                                    echo "</button>";
                                echo "</td>";
                                echo "<td colspan='2'>";
                                    echo "Movil";
                                    echo "<input type='text'>";
                                echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                                echo "<td colspan='4'>";
                                    echo "Madre";
                                    echo "<input type='text'>";
                                    echo "<button>";
                                        echo "<img src='http://www.arifriedenbach.com.br/site/wp-content/uploads/2013/02/icon_lupa.png' alt='Buscar Madre' width='42' height='42'>";
                                    echo "</button>";
                                echo "</td>";
                                echo "<td colspan='2'>";
                                    echo "Movil";
                                    echo "<input type='text'>";
                                echo "</td>";
                            echo "</tr>";
                        echo "</table>";
                    echo "</div>";
            
                    echo "<br/>";

                    echo "<div>";
                        echo "<table width='100%'>";
                            echo "<tr>";
                                echo "<td colspan='3' align='center'>";
                                    echo "<button>";
                                        echo "<img src='http://www.arifriedenbach.com.br/site/wp-content/uploads/2013/02/icon_lupa.png' alt='Responsables' width='42' height='42'>";
                                        echo "Responsables";
                                    echo "</button>";
                                echo "</td>";
                                echo "<td colspan='3' align='center'>";
                                    echo "<button> ";
                                        echo "<img src='http://www.arifriedenbach.com.br/site/wp-content/uploads/2013/02/icon_lupa.png' alt='Información Médica' width='42' height='42'>";
                                        echo "Información Médica";
                                    echo "</button>";
                                echo "</td>";
                            echo "</tr>";
                        echo "</table>";
                    echo "</div>";
                    
                    echo "<br/>";

                    echo "<div>";
                        echo "<table width='100%'>";
                            echo "<tr>";
                                echo "<td colspan='2' align='center'>";
                                    echo "<button>";
                                        echo "<img src='http://cdn3.iconfinder.com/data/icons/musthave/128/Check.png' alt='Añadir Alumno' width='42' height='42'>";
                                        echo "Añadir Alumno";
                                    echo "</button>";
                                echo "</td>";
                                echo "<td colspan='2' align='center'>";
                                    echo "<button>";
                                        echo "<img src='http://iconizer.net/files/Human_o2/orig/system-software-update.png' alt='Modificar Alumno' width='42' height='42'>";
                                        echo "Modificar Alumno";
                                    echo "</button>";
                                echo "</td>";
                                echo "<td colspan='2' align='center'>";
                                    echo "<button>";
                                        echo "<img src='http://png-1.findicons.com/files/icons/1714/dropline_neu/48/dialog_cancel.png' alt='Eliminar Alumno' width='42' height='42'>";
                                        echo "Eliminar Alumno";
                                    echo "</button>";
                                echo "</td>";
                            echo "</tr>";
                        echo "</table>";
                    echo "</div>";
            
                echo $this->tag->endForm();
                echo "<br/>";
            
                break;

            case 'userRegister':

                echo $this->tag->form(array("usuario/register", 
                                                "method" => "post",
                                                "style" => "text-align: center"));

                echo "<div class='form-group' style='width: 100%; height: 20px;'>
                    <label for='userRegEmail'>Email: </label>";

                echo $this->tag->textField(array("nombre",
                                                "id" => "userRegEmail"));

                echo "</div>";
                
                echo "<div class='form-group' style='width: 100%; height: 20px;'>
                    <label for='userRegEmail'>Password: </label>";


                echo $this->tag->textField(array("password",
                                                "id" => "userRegPass"));

                echo "</div>";

//                echo $this->tag->submitbutton("Registrarse");
/*                echo "<a href='#' class='btn btn-success add' id='Registrarse' style = 'margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;'>Registrarse</a>";
*/
                echo $this->tag->submitbutton(array("Registrarse",
                                                    "class" => "btn btn-success add",
                                                    "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));

                echo $this->tag->endForm();

                break;

            case 'usuario':

                $auth = $this->session->get('auth');
                $usuario = $auth['user'];
                $sesion = $auth['sesion'];

                $datoenvio = new Datoenvio();
                $dato = $datoenvio->enviarDatos($sesion, $usuario);

                $data = array('dato' => $dato
                                ,'status' => 'TO_GETLISTROL'
                                ,'message' => 'Obtener listado posibles roles.');

                $json = json_encode($data);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/roles/getlist/';

                //Creamos el flujo
                $opciones = array('http' => array('method' => "POST",
                                                    'header' => 'Content-type: application/json',
                                                    'content' => $json,
                                                    'timeout' => 60)
                                );

                $contexto = stream_context_create($opciones);

                //Realizamos la llamada al API REST y Obtenemos la respuesta
                $json = file_get_contents($url, false, $contexto);

                //Decodificamos el JSON
                $data = json_decode($json);

                //Desmontamos el JSON
                $dato = $data->dato;

                //Desmontamos los datos de envio
                $datoenvio->obtenerDatos($dato);

                //Obtenemos la Sesion y la informacion
                $sesion = $datoenvio->getSesion();
                $arrayRoles = $datoenvio->getDato();
//$this->flash->error($arrayRoles[1]->getNombre());  

                /*-------------------------------------------------------

                -------------------------------------------------------*/

//                echo 'Formulario usuario';

                echo $this->tag->form(array("usuario/mantenimiento", 
                                                "method" => "POST",
                                                "class" => "table-responsive",
                                                "style" => "height: 300px"));

                echo "<div class='form-group' style='width: 50%; float: left; text-align: left; height: 50px;'>
                    <label for='usuarioInputEmail'>Dirección de Email</label>";

                echo $this->tag->emailField(array("id" => "usuarioInputEmail",
                                                    "class" => "form-control",
                                                    "placeholder" => "Email"));

                echo "</div>";

                echo "<div class='form-group' style='width: 50%; float: right; text-align: center; height: 50px;'>
                    <label for='usuarioInputActive'>Activo</label>                    
                    <br />";

                echo $this->tag->selectStatic("usuarioInputActive",
                                                array("0" => "Inactivo", 
                                                        "1" => "Activo"));

                echo "</div>";

                echo "<div class='form-group' style='width: 50%; float: left; text-align: left; height: 50px;'>
                    <label for='usuarioInputPass1'>Password</label>";

                echo $this->tag->passwordField(array("id" => "usuarioInputPass1",
                                                    "class" => "form-control",
                                                    "placeholder" => "Password",
                                                    "maxlength" => "20"));

                echo "</div>";

                echo "<div class='form-group' style='width: 50%; float: right; text-align: center; height: 50px;'>
                    <label for='usuarioInputRol'>Rol</label>
                    <br />";

                $arol = array();
                foreach ($arrayRoles as $r) 
                {
                    $arol[$r->getId()]=$r->getNombre();
                }
                echo $this->tag->selectStatic("usuarioInputRol",
                                                $arol);

                echo "</div>";

                echo "<div class='form-group' style='width: 50%; float: left; text-align: left; height: 50px;'>
                    <label for='usuarioInputPass2'>Confirmación de Password</label>";

                echo $this->tag->passwordField(array("id" => "usuarioInputPass2",
                                                    "class" => "form-control",
                                                    "placeholder" => "Confirmar Password"));

                echo "</div>";

                echo "<div class='form-group' style='width: 50%; float: right; text-align: center; height: 50px;'>
                    <label for='usuarioInputUsuario'>Usuario</label>
                    <br />";

                echo $this->tag->selectStatic("usuarioInputUsuario",
                                                array("A" => "Active", 
                                                        "I" => "Inactive"));

                echo "</div>";

                echo "<div class='form-group' style='float: center; text-align: center; height: 50px;'>
                    <br />";
/*
                echo $this->tag->submitbutton(array("Añadir",
                                                "id" => "usuario_A",
                                                "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));

                echo "<a href='#' class='btn btn-success add pull-right' onclick='crudPhalcon.add()'>Añadir post</a>";

                echo "<a href='#' class='btn btn-success add' id='usuario_A' style = 'margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;'>Añadir</a>";
*/
                echo $this->tag->submitbutton(array("Añadir",
                                                    "id" => "usuario_A",
                                                    "class" => "btn btn-success add",
                                                    "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));
/*
                echo $this->tag->submitbutton(array("Modificar",
                                                "id" => "usuario_M",
                                                "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));

                echo " <a href='#'' class='btn btn-info editar' 
                        onclick='crudPhalcon.edit(" + echo htmlentities(json_encode($post))  + ")'>
                            Editar
                        </a>";
                        
                echo "<a href='#' class='btn btn-info editar' id='usuario_M' style = 'margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;'>Editar</a>";
*/
                echo $this->tag->submitbutton(array("Editar",
                                                    "id" => "usuario_M",
                                                    "class" => "btn btn-info editar",
                                                    "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));
/*
                echo $this->tag->submitbutton(array("Eliminar",
                                                "id" => "usuario_E",
                                                "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));

                echo "<a href='#' class='btn btn-danger eliminar' 
                        onclick='crudPhalcon.delete(" + echo htmlentities(json_encode($post))  + ")'> 
                            Eliminar
                        </a>";

                echo "<a href='#' class='btn btn-danger eliminar' id='usuario_E' style = 'margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;'>Eliminar</a>";
*/
                echo $this->tag->submitbutton(array("Eliminar",
                                                    "id" => "usuario_E",
                                                    "class" => "btn btn-danger eliminar",
                                                    "style" => "margin-top: 8px;
                                                            margin-bottom: 8px;
                                                            margin-right: 8px;
                                                            margin-left: 8px;"));

                echo "</div>";

                echo $this->tag->endForm();

                break;
            
            default:
                echo "resto";
                break;
        }
    }

    public function getListado($valor)
    {

        switch ($valor) {

            case 'alumno':

                $entidadAlumnos = Entidad::find("tipo = 7");

                echo "<div>";
                    echo "<span id='select-result'>none</span>";
                echo "</div";

                echo "<div class='scroll'>";
                    echo "<ol id='selectable'>";
                        foreach ($entidadAlumnos as $entidadAlumno)
                        {
                            echo "<li class='ui-widget-content'>";
                                echo "<div id='contenedor'>";
                                    echo "<div><img src='http://www.imagenesbonitas.name/covers/preview/imagenes-divertidas-fue-el.JPG' alt='imagen de prueba' width='100' height='100'></div>";
                                    echo "<div id= '", $entidadAlumno->id, "' >", $entidadAlumno->apellido1, " ", $entidadAlumno->apellido2, ", ", $entidadAlumno->nombre, "</div>";
                                echo "</div>";
                            echo "</li>";
                        }
                    echo "</ol>";
                echo "</div>";

/*echo "<style>

th:last-child, td:last-child {
  width: 7%;
  text-align: center;
  border-right: 0 none;
  padding-left: 0;
}
                    
#selectable tbody tr .ui-selecting { color: #FECA40; }
#selectable tbody tr .ui-selected { background: red; }

</style>";



                echo "<div class='table-responsive' >";
                    echo "<table id='selectable' border=1 style='background: #15BFCC; table-layout: fixed; margin: 1rem auto; width: 98%; box-shadow: 0 0 4px 2px rgba(0,0,0,.4); border-collapse: collapse; border: 1px solid rgba(0,0,0,.5); border-top: 0 none;'>";
                        echo "<thead style='background: #FF7361; text-align: center; z-index: 2;'>";
                            echo "<tr style='display: block; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,.6);'>";
                                echo "<th data-campo='imagen' style='width: 25%; float:left; border-right: 2px solid rgba(0,0,0,.2); padding: .7rem 0; font-size: 1.5rem; font-weight: normal; font-variant: small-caps;'>Imagen</th>";
                                echo "<th data-campo='apellidonombre' style='width: 75%; float:left; border-right: 2px solid rgba(0,0,0,.2); padding: .7rem 0; font-size: 1.5rem; font-weight: normal; font-variant: small-caps;'>Apellidos, Nombre</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody style='display: block; height: calc(50vh - 1px); min-height: calc(200px + 1 px); overflow-Y: scroll; color: #000;'>";
                            //for ($i=0; $i < 10; $i++)
                            foreach ($entidadAlumnos as $entidadAlumno)
                            {
                                echo "<tr class='ui-widget-content' style='display: block; overflow: hidden;'>";
                                    echo "<td id= 'id", $entidadAlumno->id, "' style='display: none;'>", $entidadAlumno->id, "</td>";
                                    echo "<td data-campo='imagen' style='width: 25%; float:left;'><img src='http://www.imagenesbonitas.name/covers/preview/imagenes-divertidas-fue-el.JPG' alt='imagen de prueba' width='100' height='100'></td>";
                                    //echo "<td data-campo='apellidonombre' style='width: 75%; float:left;'>Morales Mangas, Samuel</td>";
                                    echo "<td data-campo='apellidonombre' style='width: 75%; float:left;'>", $entidadAlumno->apellido1, " ", $entidadAlumno->apellido2, ", ", $entidadAlumno->nombre, "</td>";
                                echo "</tr>";
                            }
                        echo "</tbody>";
                    echo "</table>";
                echo "</div>";
*/
                break;

            case 'usuario':

                $auth = $this->session->get('auth');
                $usuario = $auth['user'];
                $sesion = $auth['sesion'];

                $datoenvio = new Datoenvio();
                $dato = $datoenvio->enviarDatos($sesion, $usuario);

                $data = array('dato' => $dato
                                ,'status' => 'TO_GETLIST'
                                ,'message' => 'Obtener listado usuarios.');

                $json = json_encode($data);

                //Obtenemos la url
                $url = 'http://localhost/rest/api/usuarios/getlist/';

                //Creamos el flujo
                $opciones = array('http' => array('method' => "POST",
                                                    'header' => 'Content-type: application/json',
                                                    'content' => $json,
                                                    'timeout' => 60)
                                );

                $contexto = stream_context_create($opciones);
/*$this->flash->error($contexto);  
return $this->forward('index/index');
*/
                //Realizamos la llamada al API REST y Obtenemos la respuesta
                $json = file_get_contents($url, false, $contexto);
/*$this->flash->error($json);  
return $this->forward('index/index');
*/
                //Decodificamos el JSON
                $data = json_decode($json);

                //Desmontamos el JSON
                $dato = $data->dato;

                //Desmontamos los datos de envio
                $datoenvio->obtenerDatos($dato);

                //Obtenemos la Sesion y la informacion
                $sesion = $datoenvio->getSesion();
                $arrayUsuario = $datoenvio->getDato();

                if($data->status == 'OK')
                {
//                    echo "Listado alumno";

                    echo "<table border=0 style='width: 816px;' class='table table-hover table-responsive'>
                        <thead style='display: table-header-group; vertical-align: middle; border-color: inherit;'>
                        <tr style='display: block; position: relative;'>
                            <th style='width: 300px;'>Foto</th>
                            <th style='width: 300px;'>Email</th>
                            <th style='width: 100px;'>Rol</th>
                            <th style='width: 116px;'>Active</th>
                        </tr>
                        </thead>
                        <tbody id='listaUsuarios' style='display: block; height: 200px; overflow: auto; width: 100%;'>";

                    $i=0;

                    for ($i=0;$i<count($arrayUsuario);$i++) 
                    {
                        $u = $arrayUsuario[$i];                        
                        //echo "<tr style='display: table-row; vertical-align: inherit;' data-href='index/index'>
                        //        <td style='width: 300px;'>";
                        echo "<tr style='display: table-row; vertical-align: inherit;' data-email=" . $u->getEmail() . ">
                                <td style='width: 300px;'>";
                        echo "foto";
                        echo "</td><td style='width: 300px;'>";
                        echo $u->getEmail();
                        echo "</td><td style='width: 100px;'>";
                        echo $u->getRol();
                        echo "</td><td style='width: 100px;'>";
                        echo $u->getActive();
                        echo "</td></tr>";
                    }

                    echo "</tbody></table>";
/*
echo "
<script type='text/javascript'>
$('tr[data-href]').on('click', function() {
    document.location = $(this).data('href');
});
</script>
";
*/
echo "
<script type='text/javascript'>
$(function(){

    $('body').on('click', '#listaUsuarios tr', function(event) {

        event.preventDefault();
        
        var busqueda = $(this).attr('data-email');

        $.ajax({
            url: '";
//Script_a.php
echo $this->url->get('trabajoadmin/ajaxUsuario');
echo "',
            type: 'POST',
            dataType: 'json',
            data: { action: 'getDataUsuario', email: busqueda },
            cache: false
        })
        .done( function( resultado ) {
            console.log('success');
            console.log(resultado);
            console.log(resultado.email);
            console.log(resultado.pass);
            console.log(resultado.rol);
            console.log(resultado.active);
            console.log(resultado.asignado);
            $('#usuarioInputEmail').val(resultado.email);
            $('#usuarioInputPass1').val(resultado.pass);
            $('#usuarioInputRol').val(resultado.rol);
            $('#usuarioInputActive').val(resultado.active);
            $('#usuarioInputUsuario').val(resultado.asignado);
        })
        .fail( function(resultado) {
            console.log('error');
            $('#usuarioInputEmail').val('');
            $('#usuarioInputPass1').val('');
            $('#usuarioInputRol').val('');
            $('#usuarioInputActive').val('');
            $('#usuarioInputUsuario').val('');
        })
        .always( function() {
            console.log('complete');
        });

    });

});
</script>
";

                }
                else
                {
                    $this->flash->error('Error en nombre/password');  
                    return $this->forward('index/index');
                }

                break;
            
            default:
                echo "resto";
                break;
        }
    }
}