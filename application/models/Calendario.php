<?php

/**
 * @Entity
 * @Table(name="calendario_practica")
 */

class Application_Model_Calendario {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string", length=50) */
    private $annio;
    
     /** @Column(type="string", length=20) */
    private $periodo;
    
      /** @Column(type="datetime") */
    private $fecha_inicio;
    
      /** @Column(type="datetime") */
    private $fecha_fin;

     /** @Column(type="datetime") */
    private $fecha_registro;
    
    //Metodo Público
    public function setannio($anni){
    $this->annio =$anni;
        
    }
     public function setperiodo($per){
    $this->periodo =$per;
        
    }
    public function setfecha_inicio($ini){
    $this->fecha_inicio =$ini;
        
    }
    public function setfecha_fin($fin){
    $this->fecha_fin =$fin;
        
    } 
    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_inicio=new DateTime('now');
        $this->fecha_fin =new DateTime('now');
        $this->fecha_registro =new DateTime('now');
        
        
    }
    
    
}
