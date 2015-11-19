<?php

class Foto extends ClaseAbstracta
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
     *
     * @var longblob
     */
    public $fotobinaria;

    /**
     *
     * @var string
     */
    public $tipo;

    /**
    * Guardar valores
    */
    public function putFoto($id, $nombre, $fotobinaria, $tipo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fotobinaria = $fotobinaria;
        $this->tipo = $tipo;
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
    * Coger valor nombre
    */
    public function getFotobinaria()
    {
        return $this->nombre;
    }

    /**
    * Coner valor fotobinaria
    */
    public function putFotobinaria($fotobinaria)
    {
        $this->fotobinaria = $fotobinaria;
    }

    /**
    * Coger valor tipo
    */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
    * Coner valor tipo
    */
    public function putTipo($tipo)
    {
        $this->tipo = $tipo;
    }


    /**
    * Obtenemos listado
    */
    public function getListado()
    {
        $arrayFotos = Fotos::find();
//return $arrayRoles[2]->nombre;
        $i = 0;

        foreach ($arrayFotos as $foto) 
        {
            $f = new Foto();
            $f->putFoto($foto->id, $foto->nombre, $foto->fotobinaria, $foto->tipo);
            $resultado[$i] = $f;
            $i++;
        }

        //return $arrayRoles;
        return $resultado;
    }

    
    /**
    * Indica si existe el foto con el id
    */
    public function existeId($id)
    {
        $resultado = false;
        $foto = Fotos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                    )
                                );
        
        if($foto != false)
        {
            $resultado = true;
        }
        return $resultado;
    }

    
    /**
    * Indica si existe el foto con el nombre
    */
    public function existeNombre($nombre)
    {
        $resultado = false;
        $foto = Fotos::findFirst( array('nombre = :nombre:',
                                        'bind' => array ( 'nombre' => $nombre
                                                        ) 
                                    )
                                );
        
        if($foto != false)
        {
            $resultado = true;
        }
        return $resultado;
    }


    /**
    * Obtenemos datos del foto segun el id
    */
    public function obtenerValores()
    {
        $id = $this->getId();

        $foto = Fotos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                    )
                                );

        if($foto != false)
        {
            $this->putFoto($foto->id, $foto->nombre, $foto->fotobinaria, $foto->tipo);
        }
    }

    /**
    * Generar un nuevo foto
    */
    public function generarNuevo($nombre, $fotobinaria, $tipo)
    {
        $foto = new Fotos();

        $foto->nombre = $nombre;
        $foto->fotobinaria = $fotobinaria;
        $foto->tipo = $tipo;

        $success = $foto->save();

        if($success)
        {
            $this->putFoto($foto->id, $foto->nombre, $foto->fotobinaria, $foto->tipo);
        }
    }
    
    /**
    * Actualizamos foto
    */
    public function actualizarFoto($id, $nombre, $fotobinaria, $tipo)
    {    
        $foto = Fotos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                        )
                                );

        $foto->nombre = $nombre;
        $foto->fotobinaria = $fotobinaria;
        $foto->tipo = $tipo;

        $success = $foto->update();

        if($success)
        {
            $this->putFoto($foto->id, $foto->nombre, $foto->fotobinaria, $foto->tipo);
        }
    }
    
    /**
    * Borramos foto
    */
    public function borrarTipo($id, $nombre, $fotobinaria, $tipo)
    {    
        $foto = Fotos::findFirst( array('id = :id:',
                                        'bind' => array ( 'id' => $id
                                                        ) 
                                        )
                                );
        if($foto != false)
        {
            $success = $foto->delete();
        }
    }

}