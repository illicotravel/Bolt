<?php namespace Bolt\Core;

use \MongoCursor;

/**
 * Nirina Fast QueryBuilder
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.nirina.org/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@nirina.org so we can send you a copy immediately.
 *
 * @category   Nirina
 * @package    Core
 * @todo       Implement mongodb aggregation
 * @author     Julien Alric <julien.alric@spareo.net>
 * @copyright  Copyright (c) 2011-2012 OpenTechs (http://www.opentechs.net)
 * @license    http://www.nirina.org/license     New BSD License
 * @version    version 1.0
 */ Class Entity {
    
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
            var_dump($this->_entity);
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