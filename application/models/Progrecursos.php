<?php

/**
 * @Entity
 * @Table(name="programacion_recursos")
 */

class Application_Model_Progrecursos {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id_pro;
    
    /** @Column(type="string", length=256) */
    private $valor;
    
       /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Recurespeciales")
     * @JoinColumn(name="id_recursos", referencedColumnName="id_recursos")
     */
    private $id_recursos;
    
    /** @Column(type="string", length=256) */
    private $registrado;

     /** @Column(type="datetime") */
    private $fecha_registro;
    
    //Metodo Público
    public function getid_pro(){
        return $this->id_pro;  
    }


    public function setvalor($val){
    $this->valor =$val;
        
    }
    
     public function setid_recursos($re){
    $this->id_recursos =$re;
        
    }
     public function setregistrado($reg){
    $this->registrado =$reg;
        
    }


    
    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_registro =new DateTime('now');
        
        
    }
    
    
}
