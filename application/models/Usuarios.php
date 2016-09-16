<?php

/**
 * @Entity
 * @Table(name="usuario")
 */



class Application_Model_Usuarios {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id_usuario;
    
    /** @Column(type="string", length=70) */
    
    private $nombre;
    
     /** @Column(type="string", length=70) */
    
    private $apellidos;
    
    /** @Column(type="string", length=100) */
    private $identificacion;
    
    /** @Column(type="string", length=100) */
    private $correo;
    
    /** @Column(type="string", length=100) */
    private $usuario;
    
    /** @Column(type="string", length=100) */
    private $contrasena;
    
   /** @Column(type="datetime") */
    private $fecha_creacion;
    
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Roles")
     * @JoinColumn(name="id_rol", referencedColumnName="id_rol")
     */
  private $id_rol;
  
   /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Programas")
     * @JoinColumn(name="cod_programa", referencedColumnName="id_programa")
     */
  private $cod_programa;
  
  public function setid_usuario($idusuario){
      $this->id_usuario= $idusuario;
  }
  
  public function setnombre($nom){
       $this->nombre= $nom;     
  }
  public function setapellidos($ape){
      $this->apellidos= $ape; 
  }

  public function setidentificacion($identi){
      $this->identificacion= $identi;
  }
  public function setcorreo($cor){
      $this->correo= $cor;
  }
  public function setusuario($user){
      $this->usuario= $user;
  }
  public function setcontrasena($pass){
      $this->contrasena= $pass;
  }
  public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_creacion =new DateTime('now');       
    }  
  public function setid_rol($rol){
      $this->id_rol= $rol;
  }
  public function setcod_programa($cod){
      $this->cod_programa= $cod; 
  }
}
