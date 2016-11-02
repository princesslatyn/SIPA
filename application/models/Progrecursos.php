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
    
    /** @Column(type="string", length=50) */
    private $nombre;

     /** @Column(type="datetime") */
    private $fechacreacion;
    
    //Metodo Público
    public function setnombre($nom){
    $this->nombre =$nom;
        
    }
    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fechacreacion =new DateTime('now');
        
        
    }
    
    
}
