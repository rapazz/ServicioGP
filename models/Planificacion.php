<?php
use Phalcon\Mvc\Model\Behavior\SoftDelete;




class Planificacion extends \Phalcon\Mvc\Model
{
    const DELETED = 0;

    const NOT_DELETED = 1;

    /**
     *
     * @var integer
     */
    public $idPlanificacion;
     
    /**
     *
     * @var integer
     */
    public $idproyecto;
     
    /**
     *
     * @var VARCHAR(11)
     */
    public $mes1;
     
    /**
     *
     * @var VARCHAR(11)
     */
    public $mes2;
     
    /**
     *
     * @var VARCHAR(11)
     */
    public $mes3;
     
    /**
     *
     * @var VARCHAR(11)
     */
    public $mes4;
     
    /**
     *
     * @var integer
     */
    public $estadoMes1;
     
    /**
     *
     * @var integer
     */
    public $estadoMes2;
     
    /**
     *
     * @var integer
     */
    public $estadoMes3;
     
    /**
     *
     * @var integer
     */
    public $estadoMes4;
     
    /**
     *
     * @var string
     */
    public $fechacreacion;

    public $activo;

    public function initialize()
    {
        $this->addBehavior(new SoftDelete(
            array(
                'field' => 'activo',
                'value' => Planificacion::DELETED
            )
        ));

        $this->belongsTo("idproyecto", "Proyecto", "idProyecto");
        $this->belongsTo("estadoMes1", "Etapaproyecto", "idetapaProyecto");
        $this->belongsTo("estadoMes2", "Etapaproyecto", "idetapaProyecto");
        $this->belongsTo("estadoMes3", "Etapaproyecto", "idetapaProyecto");
       // $this->belongsTo("estadoMes4", "Etapaproyecto", "idetapaProyecto");

    }
}
