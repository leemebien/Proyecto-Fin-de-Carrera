<?php

class Usuario extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nombre;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $entidad;

    /**
     *
     * @var integer
     */
    public $rol;

    /**
     *
     * @var integer
     */
    public $estado;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('entidad', 'Entidad', 'id', array('alias' => 'Entidad'));
        $this->belongsTo('rol', 'Rol', 'id', array('alias' => 'Rol'));
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'nombre' => 'nombre', 
            'password' => 'password', 
            'entidad' => 'entidad', 
            'rol' => 'rol', 
            'estado' => 'estado'
        );
    }
 
    /*
    * @desc - personalizamos los mensajes para cada caso
    */
    public function getMessages($filter = NULL)
    {
        $messages = array();
        foreach (parent::getMessages() as $message) 
        {
            switch ($message->getType()) 
            {
                case 'PresenceOf':
                    $messages[] = 'El campo ' . $message->getField() . ' es obligatorio.';
                    break;
                case 'Email':
                    $messages[] = 'El campo ' . $message->getField() . ' no tiene un formato válido.';
                    break;
                case 'Unique':
                    $messages[] = 'El campo ' . $message->getField() . ' ya está en uso.';
                    break;
                case 'TooShort':
                    $messages[] = 'El campo ' . $message->getField() . ' es demasiado corto(min 2 chars).';
                    break;
                case 'TooLong':
                    $messages[] = 'El campo ' . $message->getField() . ' es demasiado largo(max 30 chars).';
                    break;
            }
        }
        return $messages;
    }

}
