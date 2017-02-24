<?php

/**
 * @Entity
 * @Table(name="participante_responsable")
 */

class Application_Model_Partirespos {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id_responsable;
    
     /** @Column(type="string", length=256) */
    private $viaticos;
    
    /** @Column(type="string", length=256) */
    private $aux_estudiante;
    
     /** @Column(type="string", length=256) */
    private $transporte_especial;

     /** @Column(type="datetime") */
    private $fecha_pago;
    
      /** @Column(type="datetime") */
    private $fecha_legalizado;
    
      /** @Column(type="datetime") */
    private $fecha_modificacion;
    
      /** @Column(type="string", length=256) */
    private $legalizado;
    
      /** @Column(type="string", length=256) */
    private $pagado;
    
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Programacion")
     * @JoinColumn(name="codigo_prog", referencedColumnName="codigo_prog")
     */
    private $codigo_prog;
    /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Participantes")
     * @JoinColumn(name="id_participante", referencedColumnName="id_participante")
     */
    private $id_participante;
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Progrecursos")
     * @JoinColumn(name="id_pro", referencedColumnName="id_pro")
     */
     private $id_pro;


    //Metodo Público
    public function setviaticos($via){
        $this->viaticos= $via;
    } 
     
    public function setaux_estudiante($aux){
    $this->aux_estudiante =$aux;
        
    }
    public function settransporte_especial($tra){
        $this->transporte_especial=$tra;
    }
    public function setfecha_pago($fe){
        $this->fecha_pago=$fe;  
    }
    public function setfecha_legalizado($lega){
        $this->fecha_legalizado=$lega;
    }
    public function setlegalizado($le){
        $this->legalizado=$le;
    }
    public function setpagado($paga){
        $this->pagado=$paga;
    }
    public function setcodigo_prog($cod){
        $this->codigo_prog=$cod;
    }
     public function setid_participante($par){
        $this->id_participante=$par;
    }
     public function setid_pro($pro){
        $this->id_pro=$pro;
    }

    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_modificacion =new DateTime('now');
        
        
    }
    
    
}
