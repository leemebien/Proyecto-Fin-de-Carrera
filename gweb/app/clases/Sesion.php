<?php

class Sesion extends ClaseAbstracta
{

    /**
     *
     * @var string
     */
    private $numerosesion;

    /**
     *
     * @var string
     */
    private $user;

    /**
     *
     * @var string
     */
    private $rol;

    /**
     *
     * @var string
     */
    private $fechaactual;

    /**
     *
     * @var string
     */
    private $fechacaducidad;

    /**
    * Guardar valores
    */
    public function putSesion($numerosesion, $user, $rol, $fechaactual, $fechacaducidad)
    {
        $this->numerosesion = $numerosesion;
        $this->user = $user;
        $this->rol = $rol;
        $this->fechaactual = $fechaactual;
        $this->fechacaducidad = $fechacaducidad;
    }

    /**
    * Coger valor numerosesion
    */
    public function getNumeroSesion()
    {
        return $this->numerosesion;
    }

    /**
    * Coner valor numerosesion
    */
    public function putNumeroSesion($numerosesion)
    {
        $this->numerosesion = $numerosesion;
    }

    /**
    * Coger valor user
    */
    public function getUser()
    {
        return $this->user;
    }

    /**
    * Coner valor user
    */
    public function putUser($user)
    {
        $this->user = $user;
    }

    /**
    * Coger valor rol
    */
    public function getRol()
    {
        return $this->rol;
    }

    /**
    * Coner valor rol
    */
    public function putRol($rol)
    {
        $this->rol = $rol;
    }

    /**
    * Coger valor fechaactual
    */
    public function getFechaActual()
    {
        return $this->fechaactual;
    }

    /**
    * Coner valor fechaactual
    */
    public function putFechaActual($fechaactual)
    {
        $this->fechaactual = $fechaactual;
    }

    /**
    * Coger valor fechacaducidad
    */
    public function getFechaCaducidad()
    {
        return $this->fechacaducidad;
    }

    /**
    * Poner valor fechacaducidad
    */
    public function putFechaCaducidad($fechacaducidad)
    {
        $this->fechacaducidad = $fechacaducidad;
    }

    /**
    * Comprovar si la sesion es de un invitado
    */
    public function esInvitado()
    {
        if($this->getNumeroSesion() == 0)
        {
            return true;
        }
        else
        {
            return false;            
        }
    }

    /**
    * Checkea si la sesion es correcta tanto en el numero de sesion como en usuario, rol y fecha caducidad
    */
    public function checkearEstado()
    {
        $numero = $this->getNumeroSesion();
        $user = $this->getUser();
        $rol = $this->getRol();
        $fechaa = $this->getFechaActual();
        $fechac = $this->getFechaCaducidad();

        $sesion = Sesiones::findFirst( array ( 'numerosesion = :numerosesion: AND usuario = :usuario: AND fechacaducidad = :fechacaducidad: AND fechacaducidad > :fechaactual:',
                                                'bind' => array ( 'numerosesion' => $numero,
                                                                    'usuario' => $user,
                                                                    'fechacaducidad' => $fechac,
                                                                    'fechaactual' => $fechaa
                                                                )
                                            )
                                    );

        if($sesion != false)
        {
            $rolusuario = Rolesusuarios::findFirst( array('idusuario = :idusuario: AND idrol = :idrol:',
                                                        'bind' => array ( 'idusuario' => $user,
                                                                            'idrol' => $rol
                                                                        ) 
                                                )
                                        );
            if($rolusuario != false)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

    }

    /**
    * Genera una nueva sesion con el usuario que nos pasan, y la guarda
    */
    public function generarNueva($usuario)
    {

        $usuario = Usuarios::findFirst( array('email = :email: AND active = :active:',
                                                'bind' => array ( 'email' => $usuario->getEmail(),
                                                                    'active' => $usuario->getActive()
                                                                ) 
                                            )
                                    );

        if($usuario != false)
        {
            $numerossesion = xxxx;

            $sesion = new Sesiones();

            $sesion->numerosesion = $numerossesion;
            $sesion->usuario = $usuario->id;
            $sesion->fechaactual = date('Y/m/d_H:i:s');
            $sesion->fechacaducidad = date('Y/m/d_H:i:s',mktime(date('H'), date('i') + 10, 0, date('m'), date('d'), date('Y')));

            $success = $sesion->save();

            if($success)
            {

            }
        }



    }

}