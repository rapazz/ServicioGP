<?php




class Anexos extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idProyecto;


    /**
     *
     * @var integer
     */
    public $idAnexos;
     
    /**
     *
     * @var string
     */
    public $nombreAnexo;
     
    /**
     *
     * @var string
     */
    public $urlAnexo;
     
    /**
     *
     * @var integer
     */
    public $idTipoAnexo;
     
    /**
     *
     * @var string
     */
    public $activo;
     
    /**
     *
     * @var string
     */
    public $fechaCreacion;
     

    /**
     *
     * @var string
     */
    public $Anexoscol;

    public function initialize()
    {
        $this->belongsTo("idTipoAnexo", "Tipoadjunto", "idtipoAdjunto");
        $this->belongsTo("idProyecto", "Proyecto", "idProyecto");


    }


}
