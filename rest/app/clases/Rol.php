<?php

class Rol extends ClaseAbstracta
{

    /**
     *
     * @var integer
     */
    private $id;

    /**
     *
     * @var string
     */
    private $nombre;

    /**
    * Guardar valores
    */
    public function putRol($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    /**
    * Coger valor id
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Coner valor id
    */
    public function putId($id)
    {
        $this->id = $id;
    }

    /**
    * Coger valor nombre
    */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
    * Coner valor nombre
    */
    public function putNombre($nombre)
    {
        $this->nombre = $nombre;
    }


    /**
    * Obtenemos listado
    */
    public function getListado()
    {
        $arrayRoles = Roles::find();
//return $arrayRoles[2]->nombre;
        $i = 0;

        foreach ($arrayRoles as $rol) 
        {
        	$r = new Rol();
        	$r->putRol($rol->id, $rol->nombre);
            $resultado[$i] = $r;
            $i++;
        }

        //return $arrayRoles;
        return $resultado;
    }

    
    /**
    * Indica si existe el rol con el id
    */
    public function existeId($id)
    {
        $resultado = false;
        $rol = Roles::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                    )
                                );
        
        if($rol != false)
        {
            $resultado = true;
        }
        return $resultado;
    }

    
    /**
    * Indica si existe el rol con el nombre
    */
    public function existeNombre($nombre)
    {
        $resultado = false;
        $rol = Roles::findFirst( array('nombre = :nombre:',
                                        'bind' => array ( 'nombre' => $nombre
                                                        ) 
                                    )
                                );
        
        if($rol != false)
        {
            $resultado = true;
        }
        return $resultado;
    }


    /**
    * Obtenemos datos del rol segun el id
    */
    public function obtenerValores()
    {
        $id = $this->getId();

        $rol = ROLES::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                    )
                                );

        if($rol != false)
        {
            $this->putRol($rol->id, $rol->nombre);
        }
    }

    /**
    * Generar un nuevo rol
    */
    public function generarNuevo($nombre)
    {
        $rol = new Roles();

        $rol->nombre = $nombre;

        $success = $rol->save();

        if($success)
        {
            $this->putRol($rol->id, $rol->nombre);
        }
    }
    
    /**
    * Actualizamos rol
    */
    public function actualizarRol($id, $nombre)
    {    
        $rol = Roles::findFirst( array('id = :id:',
                                                'bind' => array ( 'id' => $id
                                                                ) 
                                            )
                                    );

        $rol->nombre = $nombre;

        $success = $rol->update();

        if($success)
        {
            $this->putRol($rol->id, $rol->nombre);
        }
    }
    
    /**
    * Borramos rol
    */
    public function borrarRol($id, $nombre)
    {    
        $rol = Roles::findFirst( array('id = :id:',
                                                'bind' => array ( 'id' => $id
                                                                ) 
                                            )
                                    );
        if($rol != false)
        {
            $success = $rol->delete();
        }
    }

}