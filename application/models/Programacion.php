<?php

/**
 * @Entity
 * @Table(name="programacion")
 */

class Application_Model_Programacion {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $codigo_prog;
    
     /** @Column(type="string", length=100) */
    private $num_dias;
    
    /** @Column(type="string", length=256) */
    private $recorrido;
    
     /** @Column(type="datetime") */
    private $fecha_salida;
    
     /** @Column(type="datetime") */
    private $fecha_llegada;
    
    /** @Column(type="string", length=50) */
    private $departamental;
    
     /** @Column(type="string", length=2000) */
    private $lugar_encuentro;
    
     /** @Column(type="string", length=20) */
    private $dias_pernoctados;

     /** @Column(type="datetime") */
    private $fecha_registro;
    
      /** @Column(type="string", length=100) */
    private $num_pasajeros;
    
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_calendar")
     * @JoinColumn(name="id_calendario", referencedColumnName="id")
     */
    private $id_calendario;
    
    /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Practicas")
     * @JoinColumn(name="cod_practica", referencedColumnName="cod_practica")
     */
    private $cod_practica;
    
    //Metodo Público
    public function setnum_dias($num){
        $this->num_dias =$num;
    }
    public function setrecorrido($reco){
        $this->recorrido =$reco;
    }
    public function setfecha_salida($sal){
    $this->fecha_salida =$sal;
        
    }
    public function setfecha_llegada($lle){
        $this->fecha_llegada= $lle;
        
    }
    public function setdepartamental($dep){
        $this->departamental= $dep;
        
    }
    public function setlugar_encuentro($lug){
        $this->lugar_encuentro= $lug;
        
    }
    public function setdias_pernoctados($per){
        $this->dias_pernoctados= $per;
        
    }
    public function setnum_pasajeros($pas){
        $this->num_pasajeros= $pas;
        
    }
    public function setid_calendario($cal){
        $this->id_calendario= $cal;
           
    }
    public function setcod_practica($pra){
        $this->cod_practica= $pra;
    }

    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_registro =new DateTime('now');
        
        
    }
    
    
}
