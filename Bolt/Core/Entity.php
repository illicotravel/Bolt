<?php namespace Bolt\Core;

/**
 * Bolt MongoDB QueryBuider
 *
 * @category   Bolt
 * @package    Core
 * @todo       Implement mongodb aggregation
 * @author     Julien Alric <julien.alric@gmail.com>
 * @version    version 1.0
 */ class Entity {
    
    /**
     * Entity name
     * @var     string entity
     * @access  protected
     */ protected $_entity;
     
    /**
     * Entity name
     * @var     string entity
     * @access  protected
     */ protected $dbCon;
     
    /**
     * Collection constructor
     * @param   array $aParams collection parameters
     * @return  none
     * @access  public
     */ public function __construct($base, $collection, $datas = null, $Mongo = null) {
            $Mongo = isset($Mongo) ? $Mongo : Connection::getInstance();
            $this->dbCon = $Mongo->$base->$collection;
            
            if (isset($datas)) {
                foreach ($datas as $key => $value) {
                    $this->_entity[$key] = $value;
                }
            }
        }

    /**
     * Save the entity
     * @param   none
     * @return  object $this 
     * @access  public
     */ public function save($options = array()) {  
            $this->dbCon->insert($this->_entity, $options);
        }
        
    /**
     * Save the entity
     * @param   none
     * @return  object $this 
     * @access  public
     */ public function delete($options = array()) {    
            $this->dbCon->remove($this->_entity, $options);
        }
        
    /**
     * Set entity properties
     * @return  none
     * @access  public
     */ public function __set($key, $value) {
            $this->_entity[$key] = $value;
        }
        
    /**
     * Get entity properties
     * @return  mixed $this->$key property
     * @access  public
     */ public function __get($key) {
            if (isset($this->_entity[$key])) {
                return $this->_entity[$key];
            }
        }
    }