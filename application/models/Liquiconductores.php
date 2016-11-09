<?php

/**
 * @Entity
 * @Table(name="liquidacion_conductor")
 */

class Application_Model_Liquiconductores {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string", length=256) */
    private $combustible;
    
     /** @Column(type="string", length=256) */
    private $peajes;
    
     /** @Column(type="string", length=256) */
    private $viaticos;
    
     /** @Column(type="string", length=256) */
    private $imprevistos;
    
     /** @Column(type="string", length=256) */
    private $pagado;
    
     /** @Column(type="string", length=50) */
    private $legalizado;
    
     /** @Column(type="datetime") */
    private $fecha_pago;
    
     /** @Column(type="datetime") */
    private $fecha_legalizado;
    
     /** @Column(type="datetime") */
    private $fecha_modificacion;
    
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
     * @ManyToOne(targetEntity="Application_Model_Conductores")
     * @JoinColumn(name="id_conductor", referencedColumnName="id_conductor")
     */
    private $id_conductor;
    
      /** @Column(type="string", length=50) */
    private $registrado;
    
    //Metodo Público
    public function setcombustible($com){
    $this->combustible =$com;
        
    }
    public function setpeajes($pe){
    $this->peajes=$pe;    
    }
    public function setviaticos($via){
        $this->viaticos=$via;    
    }
    public function setimprevistos($impre){
        $this->imprevistos=$impre;
    }
    public function setpagado($paga){
        $this->pagado=$paga;
    }
    public function setlegalizado($lega){
        $this->legalizado=$lega;
    }
    public function setfecha_pago($fecha){
        $this->fecha_pago=$fecha;
    }
    public function setfecha_legalizado($fe){
        $this->fecha_legalizado=$fe;
    }
    public function setcodigo_prog($codi){
        $this->codigo_prog=$codi;
    }
    public function setid_conductor($condu){
        $this->id_conductor=$condu;
    }
    public function setregistrado($regi){
        $this->registrado=$regi;
    }

    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_modificacion =new DateTime('now');
        
        
    }
    
    
}
