<?php

namespace App\Proxies\__CG__;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Application_Model_Asignaturas extends \Application_Model_Asignaturas implements \Doctrine\ORM\Proxy\Proxy
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

    public function setcodigo($cod)
    {
        $this->__load();
        return parent::setcodigo($cod);
    }

    public function setgrupo($gru)
    {
        $this->__load();
        return parent::setgrupo($gru);
    }

    public function setcod_programa($cod)
    {
        $this->__load();
        return parent::setcod_programa($cod);
    }

    public function setid_facultad($fac)
    {
        $this->__load();
        return parent::setid_facultad($fac);
    }

    public function setid_sede($se)
    {
        $this->__load();
        return parent::setid_sede($se);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'cod_asignatura', 'nombre', 'codigo', 'grupo', 'fecha_registro', 'cod_programa', 'id_facultad', 'id_sede');
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