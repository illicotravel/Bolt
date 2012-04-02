<?php namespace Bolt\Core;

/**
 * Bolt MongoDB QueryBuider
 *
 * @category   Bolt
 * @package    Core
 * @todo       Implement mongodb aggregation
 * @author     Julien Alric <julien.alric@gmail.com>
 * @version    version 1.0
 */ class Collection {
    
    /**
     * Fields to return.
     * @var    array collection fields
     * @access private
     */ private $fields = array();
     
    /**
     * Entities order.
     * @var    array order
     * @access private
     */ private $order = array();
     
    /**
     * Number of returned elements.
     * @var    int limit
     * @access private
     */ private $limit = 0;
     
    /**
     * Number of skiped elements.
     * @var    int skip
     * @access private
     */ private $skip = 0;
     
    /**
     * Collection constructor
     * @param   array $aParams collection parameters
     * @return  none
     * @access  public
     */ public function __construct($base, $collection, $Mongo = null) {
            $Mongo = isset($Mongo) ? $Mongo : Connection::getInstance();
            $this->dbCon = $Mongo->$base->$collection;
        }

    /**
     * Search elements in a collection.
     * @param   array $query search criterias
     * @return  object instance of this
     * @access  public
     */ public function search($query = array()) {
            $aDocs = $this->dbCon->find($query->filter, $this->fields)->skip($this->skip)->limit($this->limit)->sort($this->order);
            return $aDocs;
        }
        
    /**
     * Search elements in a collection with javascript code.
     * @param   string $query javascript code
     * @return  array $aDocs MongoDB docs
     * @access  public
     */ public function where($query) {
            $aDocs = $this->dbCon->find(array('$where'=>$query), $this->fields)->skip($this->skip)->limit($this->limit)->sort($this->order);
            return $aDocs;
        }
        
    /**
     * Return the number of element in a collection.
     * @param   string $query search criterias
     * @return  int number of elements
     * @access  public
     */ public function count($query) {
            $iCount = $this->dbCon->find($query)->count();
            return $iCount;
        }
    
    /**
     * fields to be returned in the objects.
     * @param   array $fields
     * @param   boolean $include include or exclude fields
     * @return  object instance of this
     * @access  public
     */ public function fields($fields, $include = 1) {
            $this->fields = $fields;
            return $this;
        }
    
    /**
     * order function.
     * @param   array $order
     * @return  object instance of this
     * @access  public
     */ public function order($order = array()) {
            foreach($order as $key => $value) {
                if (is_string($key)) {
                    $this->order[$key] = $value;
                } else {
                    $this->order[$value] = 1;
                }
            }
            
            return $this;
        }
    
    /**
     * grouping function.
     * @todo implement mongodb aggregation
     * @param   array $params
     * @return  object instance of this
     * @access  public
     */ public function group($params = array()) {
            return $this;
        }
    
    /**
     * limit function.
     * @param   int $limit
     * @return  object instance of this
     * @access  public
     */ public function limit($limit = 0) {
            $this->limit = $limit;
            return $this;
        }
    
    /**
     * skip function.
     * @param   int $skip
     * @return  object instance of this
     * @access  public
     */ public function skip($skip = 0) {
            $this->skip = $skip;
            return $this;
        }
    }