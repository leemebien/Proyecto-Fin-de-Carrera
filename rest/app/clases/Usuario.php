<?php

class Usuario extends ClaseAbstracta
{

    /**
     *
     * @var string
     */
    private $email;

    /**
     *
     * @var string
     */
    private $pass;

    /**
     *
     * @var string
     */
    private $rol;

    /**
     *
     * @var boolean
     */
    private $active;

    /**
    * Guardar valores
    */
    public function putUsuario($email, $pass, $rol, $active)
    {
        $this->email = $email;
        $this->pass = $pass;
        $this->rol = $rol;
        $this->active = $active;
    }

    /**
    * Coger valor email
    */
    public function getEmail()
    {
        return $this->email;
    }

    /**
    * Coner valor email
    */
    public function putEmail($email)
    {
        $this->email = $email;
    }

    /**
    * Coger valor pass
    */
    public function getPass()
    {
        return $this->pass;
    }

    /**
    * Coner valor pass
    */
    public function putPass($pass)
    {
        $this->pass = $pass;
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
    * Coger valor active
    */
    public function getActive()
    {
        return $this->active;
    }

    /**
    * Coner valor active
    */
    public function putActive($active)
    {
        $this->active = $active;
    }

    /**
    * Comprueba si el usuario existe, es activo y su clave es correcta
    */
    public function existe()
    {
    	$email = $this->getEmail();
    	$pass = $this->getPass();

        $security = new Phalcon\Security();

    	$usuario = Usuarios::findFirst( array('email = :email: AND active = 1',
    											'bind' => array ( 'email' => $email
    															) 
    										)
    								);

    	if($usuario != false)
    	{
            if($security->checkHash($pass, $usuario->pass))
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
    * Comprueba si el usuario existe
    */
    public function existe2()
    {
        $email = $this->getEmail();
        $pass = $this->getPass();

        $usuario = Usuarios::findFirst( array('email = :email: ',
                                                'bind' => array ( 'email' => $email
                                                                ) 
                                            )
                                    );

        if($usuario != false)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
    * Recuperamos los datos
    */
    public function obtenerValores()
    {
    	$email = $this->getEmail();

    	$usuario = Usuarios::findFirst( array('email = :email:',
    											'bind' => array ( 'email' => $email
    															) 
    										)
    								);

    	if($usuario != false)
    	{
/*    		$rol = Rolesusuarios::findFirst( array('idusuario = :idusuario:',
    												'bind' => array ( 'idusuario' => $usuario->id
    																) 
    											)
    									);

    		if($rol != false)
    		{
    			$this->putUsuario($usuario->email, $usuario->pass, $rol->idrol, $usuario->active);
*/                $this->putUsuario($usuario->email, $usuario->pass, $usuario->idrol, $usuario->active);
//    		}
    	}
    }


    /**
    * Creamos un nuevo usuario
    */
    public function generarNuevo($email, $pass, $rol, $active)
    {
        $usuario = new Usuarios();

        $usuario->email = $email;
        $usuario->pass = $pass;
        $usuario->active = $active;
        $usuario->idrol = $rol;

        $success = $usuario->save();

        if($success)
        {
/*            $rolusuario = new Rolesusuarios();

            $rolusuario->idusuario = $usuario->id;
            $rolusuario->idrol = $rol;

            $success = $rolusuario->save();

            if($success)
            {
                $this->putUsuario($usuario->email, $usuario->pass, $rolusuario->idrol, $usuario->active);
*/                $this->putUsuario($usuario->email, $usuario->pass, $usuario->idrol, $usuario->active);
//            }
        }
    }


    /**
    * Actualizamos usuario
    */
    public function actualizarUsuario($email, $pass, $rol, $active)
    {    
        $usuario = Usuarios::findFirst( array('email = :email:',
                                                'bind' => array ( 'email' => $email
                                                                ) 
                                            )
                                    );

        if ((!password_verify('', $pass)) || ($usuario->pass != $pass))
        {
            $usuario->pass = $pass;
        }

        $usuario->active = $active;
        $usuario->idrol = $rol;

        $success = $usuario->update();

        if($success)
        {
/*            $rolusuario = Rolesusuarios::findFirst( array('idusuario = :idusuario:',
                                                        'bind' => array ( 'idusuario' => $usuario->id
                                                                        )
                                                    )
                                                );
            if($rolusuario->idrol != $rol)
            {
                $rolusuario->idrol = $rol;
                $success = $rolusuario->update();
            }

            if($success)
            {
                $this->putUsuario($usuario->email, $usuario->pass, $rolusuario->idrol, $usuario->active);
*/                $this->putUsuario($usuario->email, $usuario->pass, $usuario->idrol, $usuario->active);
//            }

        }
    }


    /**
    * Actualizamos password usuario
    */
    public function actualizarPassUsuario($email, $pass)
    {    
        $usuario = Usuarios::findFirst( array('email = :email:',
                                                'bind' => array ( 'email' => $email
                                                                ) 
                                            )
                                    );

        $usuario->pass = $pass;

        $success = $usuario->update();

        if($success)
        {
            $this->putUsuario($usuario->email, $usuario->pass, $usuario->idrol, $usuario->active);
        }
    }


    /**
    * Borramos usuario
    */
    public function borrarUsuario($email)
    {    
        $usuario = Usuarios::findFirst( array('email = :email:',
                                                'bind' => array ( 'email' => $email
                                                                ) 
                                            )
                                    );

        if($usuario != false)
        {
/*            $rolusuario = Rolesusuarios::find( array('idusuario = :idusuario:',
                                                    'bind' => array ( 'idusuario' => $usuario->id
                                                                    )
                                                )
                                            );
            
            $success = $rolusuario->delete();
            
            if($success)
            {
*/                $success = $usuario->delete();
//            }

        }
    }


    /**
    * Obtenemos listado
    */
    public function getListado()
    {
        $arrayUsuarios = Usuarios::find();
        $i = 0;

        foreach ($arrayUsuarios as $usuarios) 
        {
/*            $rol = Rolesusuarios::findFirst( array('idusuario = :idusuario:',
                                                    'bind' => array ( 'idusuario' => $usuarios->id
                                                                    ) 
                                                )
                                        );
*/            $u = new Usuario();
//            $u->putUsuario($usuarios->email, $usuarios->pass, $rol->idrol, $usuarios->active);
            $u->putUsuario($usuarios->email, $usuarios->pass, $usuarios->idrol, $usuarios->active);

            //$arrayUsuario[$usuarios->id] = $this->putUsuario($usuarios->email, $usuarios->pass, $rol->idrol, $usuarios->active);
            $arrayUsuario[$i] = $u;
            $i++;
        }
        return $arrayUsuario;
    }

    /**
    * Comprobar que email existe
    */
    public function existeEmail($email)
    {
        $resultado = false;
        $usuario = Usuarios::findFirst( array('email = :email:',
                                                'bind' => array ( 'email' => $email
                                                                ) 
                                            )
                                    );
        
        if($usuario != false)
        {
            $resultado = true;
        }
        return $resultado;
    }

}