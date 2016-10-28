 <?php
 use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="practica")
 */

class Application_Model_Practicas {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $cod_practica;
    
    /** @Column(type="string", length=100) */
    private $nombre;
    
    /** @Column(type="string", length=100) */
    private $num_estudiantes;
    
    /** @Column(type="string", length=100) */
    private $nom_solicitante;
     
     /** @Column(type="string", length=3000) */
    private $justificacion;
    
     /** @Column(type="string", length=2000) */
    private $objetivo;
    
     /** @Column(type="string", length=2000) */
    private $actividad_doc;
    
     /** @Column(type="string", length=2000) */
    private $actividad_est;
    
     /** @Column(type="string", length=300) */
    private $tipo_practica;
    
     /** @Column(type="datetime") */
    private $fecha_registro;
    
     /** @Column(type="string", length=20) */
    private $semestre;
    
     /** @Column(type="string", length=256) */
    private $departamento;
    
    /**
     * @OneToMany(targetEntity="Application_Model_Programacion", mappedBy="cod_practica", cascade={"persist"})
     */
   
     private $programaciones;
      
    
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Asignaturas")
     * @JoinColumn(name="cod_asignatura", referencedColumnName="cod_asignatura")
     */
    private $cod_asignatura;
     /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Facultades")
     * @JoinColumn(name="id_facultad", referencedColumnName="id_facultad")
     */
     private $id_facultad;
      /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Programas")
     * @JoinColumn(name="id_programa", referencedColumnName="id_programa")
     */
    private  $id_programa;
        /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_calendar")
     * @JoinColumn(name="id_calendario", referencedColumnName="id")
     */
    private $id_calendario;



        //Metodo Público
    public function setnombre($nom){
    $this->nombre =$nom;
        
    }
    public function setnum_estudiantes($num){
        $this->num_estudiantes= $num;
    }

    public function setnom_solicitante($sol){
    $this->nom_solicitante =$sol;
        
    }
    
    public function setjustificacion($jus){
        $this->justificacion= $jus;
        
    }
    public function setobjetivo($obj){
        $this->objetivo= $obj;
        
    }
    public function setactividad_doc($doc){
        $this->actividad_doc= $doc;
        
    }
    public function setactividad_est($est){
        $this->actividad_est= $est;
        
    }
    public function settipo_practica($tipo){
        $this->tipo_practica =$tipo;
        
    }
    public function setsemestre($sem){
        $this->semestre= $sem;
        
    }
    public function setdepartamento($dep){
        $this->departamento= $dep;
        
    }
    public function setcod_asignatura($cod){
        $this->cod_asignatura= $cod;
        
    }
    public function setid_facultad($fac){
        $this->id_facultad= $fac;
    }
    public function setid_programa($pro){
        $this->id_programa=$pro;
    }
    public function setprogramaciones($prog){
        $this->programaciones=$prog;
    }
    public function getprogramaciones(){
        return $this->programaciones;
    }
    public function setid_calendario($cal){
        $this->id_calendario= $cal;
    }

    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_registro =new DateTime('now');
        $this->programaciones = new ArrayCollection();
        
        
    }
    
    
    
}
