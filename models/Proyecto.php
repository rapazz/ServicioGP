<?php




class Proyecto extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $idProyecto;
     
    /**
     *
     * @var string
     */
    public $nombreProyecto;
     
    /**
     *
     * @var string
     */
    public $descripcionProyecto;
     
    /**
     *
     * @var string
     */
    public $jefeProyecto;
     
    /**
     *
     * @var string
     */
    public $bpProyecto;
     
    /**
     *
     * @var string
     */
    public $fechaSolicitud;
     
    /**
     *
     * @var string
     */
    public $fechaTermino;
     
    /**
     *
     * @var string
     */
    public $fechaRealTermino;
     
    /**
     *
     * @var string
     */
    public $nombreSolicitante;
     
    /**
     *
     * @var integer
     */
    public $idEmpresa;
     
    /**
     *
     * @var string
     */
    public $financiadoPor;
     
    /**
     *
     * @var integer
     */
    public $idTipoProyecto;
     
    /**
     *
     * @var string
     */
    public $areaCliente;
     
    /**
     *
     * @var integer
     */
    public $costoOneOff;
     
    /**
     *
     * @var integer
     */
    public $costoOnGoing;
     
    /**
     *
     * @var integer
     */
    public $beneficios;
     
    /**
     *
     * @var integer
     */
    public $idStatusProyecto;
     
    /**
     *
     * @var integer
     */
    public $idEtapaProyecto;
     
    /**
     *
     * @var integer
     */
    public $idSaludProyecto;
     
    /**
     *
     * @var integer
     */
    public $avance;
     
    /**
     *
     * @var string
     */
    public $activo;
     
    /**
     *
     * @var string
     */
    public $idTipoEstrategiaProyecto;
     
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
     * @var string
     */
    public $comentarioAlcance;
     
    /**
     *
     * @var string
     */
    public $fechaUltimoAvance;
     
public $desviacionTiempo;


    public function getPlanificacion($parameters=null)
    {
        return $this->getRelated('Planificacion', $parameters);
    }

public function initialize()
{
    $this->belongsTo("idEmpresa", "Empresas", "idEmpresa");
    $this->belongsTo("idEtapaProyecto", "Etapaproyecto", "idetapaProyecto");
    $this->belongsTo("idStatusProyecto", "Statusproyecto", "idstatusProyecto");
    $this->belongsTo("idSaludProyecto", "Saludproyecto", "idsaludProyecto");
    $this->belongsTo("idTipoEstrategiaProyecto", "estrategiaProyecto", "idEstrategia");

    $this->belongsTo("idProyecto", "Planificacion", "idproyecto");

}
}