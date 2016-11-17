<?php

/**
 * @Entity
 * @Table(name="annio")
 */

class Application_Model_Annio{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
   private $id_innio;
   
    /** @Column(type="string", length=50) */
    private $annio;

 
   
  
   //Set id_rol
   public function setid_innio($in){
   $this->id_innio= $in; 
   }
   //Set de Nombre   
  public function setannio($ann){
      $this->annio =$ann;
  }
 
}
