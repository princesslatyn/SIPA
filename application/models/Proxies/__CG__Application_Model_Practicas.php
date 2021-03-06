<?php

namespace App\Proxies\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Application_Model_Practicas extends \Application_Model_Practicas implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setnombre($nom)
    {
        $this->__load();
        return parent::setnombre($nom);
    }

    public function setnum_estudiantes($num)
    {
        $this->__load();
        return parent::setnum_estudiantes($num);
    }

    public function setnom_solicitante($sol)
    {
        $this->__load();
        return parent::setnom_solicitante($sol);
    }

    public function setjustificacion($jus)
    {
        $this->__load();
        return parent::setjustificacion($jus);
    }

    public function setobjetivo($obj)
    {
        $this->__load();
        return parent::setobjetivo($obj);
    }

    public function setactividad_doc($doc)
    {
        $this->__load();
        return parent::setactividad_doc($doc);
    }

    public function setactividad_est($est)
    {
        $this->__load();
        return parent::setactividad_est($est);
    }

    public function settipo_practica($tipo)
    {
        $this->__load();
        return parent::settipo_practica($tipo);
    }

    public function setsemestre($sem)
    {
        $this->__load();
        return parent::setsemestre($sem);
    }

    public function setdepartamento($dep)
    {
        $this->__load();
        return parent::setdepartamento($dep);
    }

    public function setcod_asignatura($cod)
    {
        $this->__load();
        return parent::setcod_asignatura($cod);
    }

    public function setid_facultad($fac)
    {
        $this->__load();
        return parent::setid_facultad($fac);
    }

    public function setid_programa($pro)
    {
        $this->__load();
        return parent::setid_programa($pro);
    }

    public function setprogramaciones($prog)
    {
        $this->__load();
        return parent::setprogramaciones($prog);
    }

    public function getprogramaciones()
    {
        $this->__load();
        return parent::getprogramaciones();
    }

    public function setid_calendario($cal)
    {
        $this->__load();
        return parent::setid_calendario($cal);
    }

    public function setid_grupo($gru)
    {
        $this->__load();
        return parent::setid_grupo($gru);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'cod_practica', 'nombre', 'num_estudiantes', 'nom_solicitante', 'justificacion', 'objetivo', 'actividad_doc', 'actividad_est', 'tipo_practica', 'fecha_registro', 'semestre', 'departamento', 'programaciones', 'cod_asignatura', 'id_facultad', 'id_programa', 'id_calendario', 'id_grupo');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}