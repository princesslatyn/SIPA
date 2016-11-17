<?php

/**
 * @Entity
 * @Table(name="periodo")
 */

class Application_Model_Periodo {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
   private $id_periodo;
   
    /** @Column(type="string", length=2) */
    private $periodo;

   
   
  
   //Set id_rol
   public function setid_periodo($per){
   $this->id_periodo= $per; 
   }
   //Set de Nombre   
  public function setperiodo($pe){
      $this->periodo =$pe;
  }
  
    
}
