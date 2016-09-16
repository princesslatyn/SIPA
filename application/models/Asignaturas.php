<?php

/**
 * @Entity
 * @Table(name="asignatura")
 */

class Application_Model_Asignaturas {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
   private $cod_asignatura;
   
    /** @Column(type="string", length=100) */
    private $nombre;
   
   /** @Column(type="datetime") */
   private $fecha_registro;
   
  
   
    /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Programas")
     * @JoinColumn(name="cod_programa", referencedColumnName="id_programa")
     */
  private $cod_programa;
  
  //Set de Nombre   
  public function setnombre($nom){
      $this->nombre =$nom;
  }
  public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_registro =new DateTime('now');
           
    }  
    public function setcod_programa($cod){
        $this->cod_programa =$cod;
    }
}
