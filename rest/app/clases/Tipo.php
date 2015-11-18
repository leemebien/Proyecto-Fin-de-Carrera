<?php

class Tipo extends ClaseAbstracta
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
    public function putTipo($id, $nombre)
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
        $arrayTipos = Tipos::find();
//return $arrayRoles[2]->nombre;
        $i = 0;

        foreach ($arrayTipos as $tipo) 
        {
            $t = new Tipo();
            $t->putTipo($tipo->id, $tipo->nombre);
            $resultado[$i] = $t;
            $i++;
        }

        //return $arrayRoles;
        return $resultado;
    }

    
    /**
    * Indica si existe el tipo con el id
    */
    public function existeId($id)
    {
        $resultado = false;
        $tipo = Tipos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                    )
                                );
        
        if($tipo != false)
        {
            $resultado = true;
        }
        return $resultado;
    }

    
    /**
    * Indica si existe el tipo con el nombre
    */
    public function existeNombre($nombre)
    {
        $resultado = false;
        $tipo = Tipos::findFirst( array('nombre = :nombre:',
                                        'bind' => array ( 'nombre' => $nombre
                                                        ) 
                                    )
                                );
        
        if($tipo != false)
        {
            $resultado = true;
        }
        return $resultado;
    }


    /**
    * Obtenemos datos del tipo segun el id
    */
    public function obtenerValores()
    {
        $id = $this->getId();

        $tipo = Tipos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                    )
                                );

        if($tipo != false)
        {
            $this->putTipo($tipo->id, $tipo->nombre);
        }
    }

    /**
    * Generar un nuevo tipo
    */
    public function generarNuevo($nombre)
    {
        $tipo = new Tipos();

        $tipo->nombre = $nombre;

        $success = $tipo->save();

        if($success)
        {
            $this->putTipo($tipo->id, $tipo->nombre);
        }
    }
    
    /**
    * Actualizamos tipo
    */
    public function actualizarTipo($id, $nombre)
    {    
        $tipo = Tipos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                        )
                                );

        $tipo->nombre = $nombre;

        $success = $tipo->update();

        if($success)
        {
            $this->putTipo($tipo->id, $tipo->nombre);
        }
    }
    
    /**
    * Borramos tipo
    */
    public function borrarTipo($id, $nombre)
    {    
        $tipo = Tipos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                        )
                                );
        if($tipo != false)
        {
            $success = $tipo->delete();
        }
    }

}