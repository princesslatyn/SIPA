<?php
use Doctrine\Common\Collections\ArrayCollection;

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
     /** @Column(type="string", length=256) */
    private $tipo;
    
    /** @Column(type="string", length=3000) */
    private $valor;
    
     /** @Column(type="string", length=256) */
    private $observaciones;
    
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
     * @ManyToOne(targetEntity="Application_Model_Practicas", inversedBy="programaciones")
     * @JoinColumn(name="cod_practica", referencedColumnName="cod_practica")
     */
    private $cod_practica;
      /**
     * Bidirectional - Many users have Many favorite comments (OWNING SIDE)
     *
     * @ManyToOne(targetEntity="Application_Model_Participantes")
     * @JoinColumn(name="id_participante", referencedColumnName="id_participante")
     */
    private $id_participante;
    /**
     * @ManyToMany(targetEntity="participantes")
     * @JoinTable(name="participante_responsable",
     *      joinColumns={@JoinColumn(name="codigo_prog", referencedColumnName="codigo_prog")},
     *      inverseJoinColumns={@JoinColumn(name="id_participante", referencedColumnName="id_participante")}
     *      )
     */

    private $participantes;




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
    public function settipo($ti){
        $this->tipo= $ti;
        
    }
    public function setvalor($va){
        $this->valor= $va;
    }
    public function setobservaciones($obs){
        $this->observaciones= $obs;
    }

    
    public function setid_calendario($cal){
        $this->id_calendario= $cal;
           
    }
    public function setcod_practica($pra){
        $this->cod_practica= $pra;
    }
    public function setid_participante($par){
        $this->id_participante= $par;
    }
    public function setparticipantes($parti){
        $this->participantes= $parti;
    }
    public function getparticipantes(){
        return $this->participantes;
    }

    public function __construct() {
        // la variable now, se comporta como un objeto donde la fecha se haga automaticamente..
        $this->fecha_registro =new DateTime('now');
         $this->participantes = new ArrayCollection();
        
    }
    
    
}
