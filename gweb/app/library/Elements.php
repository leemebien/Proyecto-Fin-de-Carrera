<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
	private $_menuCabeceraPublica;
    private $_menuCabeceraPrivado;
    private $_menuCabeceraPrivadoPadre;
    private $_menuCabeceraPrivadoProfe;
    private $_menuCabeceraPrivadoAdmin;


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
                    
                    echo '</td></tr></table>';
                    
                    echo $this->tag->endForm();
                }
                else {
                    echo $this->tag->linkTo($controller . "/" . $option['action'], $option['caption']);
                }

                echo '</li>';
            }

            echo '<li><div id="dialogInfoLogin" title="Información">';
            echo '<P>';
            $this->flash->output(); 
            echo '</P>';
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
            
            default:
                echo "resto";
                break;
        }
    }
}