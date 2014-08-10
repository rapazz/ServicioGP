<?php
/**
 * Created by PhpStorm.
 * User: mbravo
 * Date: 24-03-14
 * Time: 22:08
 */





class Historialproyecto extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idhistorial;

    /**
     *
     * @var integer
     */
    public $idProyecto;

    /**
     *
     * @var string
     */
    public $fechaCreacion;

    /**
     *
     * @var integer
     */
    public $avance;

    /**
     *
     * @var string
     */
    public $comentario;

    /**
     *
     * @var integer
     */
    public $idSaludProyecto;

    /**
     *
     * @var integer
     */
    public $idEtapaProyecto;

    /**
     *
     * @var integer
     */
    public $idStatusProyecto;

    /**
     *
     * @var integer
     */
    public $desviacionPresupuesto;

    /**
     *
     * @var integer
     */
    public $desviacionAlcance;

    /**
     *
     * @var integer
     */
    public $desviacionTiempo;





public function initialize()
{
    $this->belongsTo("idEtapaProyecto", "Etapaproyecto", "idetapaProyecto");
    $this->belongsTo("idStatusProyecto", "Statusproyecto", "idstatusProyecto");
    $this->belongsTo("idSaludProyecto", "Saludproyecto", "idsaludProyecto");


}
}