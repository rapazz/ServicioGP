<?php

//namespace Store\Toys;

class Empresas extends \Phalcon\Mvc\Model
{

/*  //Metodo para cambiar el origen de la tabla 
//Sirve para armar vistas.
 public function getSource()
    {
        return "the_robots";
    }

  */ 

    protected $id;

    protected $nombreEmpresa;

    public function getId()
    {
        return $this->id;
    }
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }


    public function setId($ids)
    {
        //The name is too short?
        if (strlen($ids) < 0) {
            throw new \InvalidArgumentException('Id debe ser mayor a 0');
        }
        $this->id = $ids;
    }

    public function setnombreEmpresa($nombre)
    {
       
        
        $this->nombreEmpresa = $nombre;
    }

}