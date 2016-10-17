<?php

/**
 * @Entity
 * @Table(name="participante")
 */

class Application_Model_Participantes {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id_participante;
    
    /** @Column(type="string", length=100) */
    private $identificacion;

     /** @Column(type="string", length=100) */
    private $nombre;
    
      /** @Column(type="string", length=50) */
    private $tipo_participante;
    
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Programas")
     * @JoinColumn(name="id_programa", referencedColumnName="id_programa")
     */
 
   private $id_programa;
    
    //Metodo Público
    public function setidentificacion($ide){
        $this->identificacion =$ide;
    }
    public function setnombre($nom){
    $this->nombre =$nom;
        
    }
    public function settipo_participante($tipo){
        $this->tipo_participante= $tipo;
    }
    public function setid_programa($pro){
        $this->id_programa= $pro;
    }
   
    
    
}
