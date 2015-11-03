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
    * Comprueba si el usuario existe y es activo
    */
    public function existe()
    {
    	$email = $this->getEmail();
    	$pass = $this->getPass();

    	$usuario = Usuarios::findFirst( array('email = :email: AND active = 1',
    											'bind' => array ( 'email' => $email
    															) 
    										)
    								);

    	if($usuario != false)
    	{
    		if($this->security->checkHash($pass, $usuario->getPass()))
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
    		$rol = Rolesusuarios::findFirst( array('idusuario = :idusuario:',
    												'bind' => array ( 'idusuario' => $usuario->getID()
    																) 
    											)
    									);
    		if($rol != false)
    		{
    			$this->putUsuario($usuario->getEmail(), $usuario->getPass(), $rol->getId(), $usuario->getActive());
    		}
    	}
    }

}