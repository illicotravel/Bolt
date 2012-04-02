<?php namespace Bolt\Core;

/**
 * Nirina Framework
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
 * @author     Julien Alric <julien.alric@spareo.net>
 * @copyright  Copyright (c) 2011-2012 OpenTechs (http://www.opentechs.net)
 * @license    http://www.nirina.org/license     New BSD License
 * @version    version 1.0
 */ class Filter {

    /**
     * Class constructor
     * @param   none
     * @return  none
     * @access  public
     */ public function __construct($key = null) {
            if (isset($key)) {
                $this->key($key);
            }
            
            $this->filter = array();
        }    
        
    /**
     * Set the current key.
     * @param   string $sKey
     * @return  object intance of this
     * @access  public
     */ public function key($key) {
            $this->currentKey = $key;
            return $this;
        } 
        
    /**
     * Adds an equality condition to the current key.
     * @param   mixed $value
     * @return  object intance of this
     * @access  public
     */ public function equals($value) {
            $this->filter[$this->currentKey] = $value;
            return $this;
        }
        
    /**
     * Adds an inequality condition to the current key.
     * MongoDB operator : $ne
     * @param   mixed $value
     * @return  object intance of this
     * @access  public
     */  public function notEquals($value) {
            $this->filter[$this->currentKey]['$ne'] = $value;
            return $this;
        }
        
    /**
     * Adds a "greater than" condition to the current key.
     * MongoDB operator : $gt
     * @param   mixed $value
     * @return  object intance of this
     * @access  public
     */ public function greaterThan($value) {
            $this->filter[$this->currentKey]['$gt'] = $value;
            return $this;
        } 
      
    /**
     * Adds a "less than" condition to the current key.
     * MongoDB operator : $lt
     * @param   mixed $value
     * @return  object intance of this
     * @access  public
     */ public function lessThan($value) {
            $this->filter[$this->currentKey]['$lt'] = $value;
            return $this;
        } 
        
    /**
     * Adds a "greater than or equal" condition to the current key.
     * MongoDB operator : $gte
     * @param   mixed $value
     * @return  object intance of this
     * @access  public
     */ public function greaterThanOrEquals($value) {
            $this->filter[$this->currentKey]['$gte'] = $value;
            return $this;
        } 
        
    /**
     * Adds a "less than or equal" condition to the current key.
     * MongoDB operator : $lte
     * @param   mixed $value
     * @return  object intance of this
     * @access  public
     */ public function lessThanOrEquals($value) {
            $this->filter[$this->currentKey]['$lte'] = $value;
            return $this;
        }

    /**
     * Adds a "contains" condition to the current key.
     * MongoDB operator : $all
     * @param   mixed $value single value or array
     * @return  object intance of this
     * @access  public
     */ public function contains($value) {
            $value = (is_array($value)) ? $value : array($value);
            $this->filter[$this->currentKey]['$all'] = $value;
            return $this;
        } 
   
    /**
     * Adds a "exists" condition to the current key.
     * MongoDB operator : $exists
     * @param   boolean $b default value : true
     * @return  object intance of this
     * @access  public
     */ public function exists($b = true) {
            $this->filter[$this->currentKey]['$exists'] = $b;
            return $this;
        }
        
    /**
     * Adds a "not exists" condition to the current key.
     * MongoDB operator : $exists
     * @param   boolean $b default value : true
     * @return  object intance of this
     * @access  public
     */ public function notExists($b = true) {
            $this->filter[$this->currentKey]['$exists'] = !$b;
            return $this;
        }
        
    /**
     * Adds a "mod" condition to the current key.
     * Check if $value is the remainder of current key divised by $divisor.
     * MongoDB operator : $mod
     * @param   int $divisor
     * @param   int $value
     * @return  object intance of this
     * @access  public
     */ public function mod($divisor, $value) {
            $this->filter[$this->currentKey]['$mod'] = array($divisor, $value);
            return $this;
        }
        
    /**
     * Adds a "in" condition to the current key.
     * MongoDB operator : $in
     * @param   array $values
     * @return  object intance of this
     * @access  public
     */ public function in($values) {
            $this->filter[$this->currentKey]['$in'] = $values;
            return $this;
        }
        
    /**
     * Adds a "not in" condition to the current key.
     * MongoDB operator : $nin
     * @param   array $values
     * @return  object intance of this
     * @access  public
     */ public function notIn($values) {
            $this->filter[$this->currentKey]['$nin'] = $values;
            return $this;
        }
        
    /**
     * Adds a "size" condition to the current key.
     * Current key must be an array, and "size" is the number of elements.
     * MongoDB operator : $size
     * @param   int $size
     * @return  object intance of this
     * @access  public
     */ public function size($size) {
            $this->filter[$this->currentKey]['$size'] = $size;
            return $this;
        }
        
    /**
     * Adds a "regex" condition to the current key.
     * See mongo doc for more informations.
     * MongoDB operators : $regex and $options
     * @param   string $regex
     * @param   string $options
     * @return  object intance of this
     * @access  public
     */ public function regex($regex, $options) {
            $this->filter[$this->currentKey]['$regex'] = $regex;
            $this->filter[$this->currentKey]['$options'] = $options;
            return $this;
        }
        
    /**
     * Adds a "element match" condition to the current key.
     * See mongo doc for more informations.
     * MongoDB operator : $elemMatch
     * @param   object $elemMatch filter object
     * @return  object intance of this
     * @access  public
     */ public function elementMatch($elemMatch) {
            $this->filter[$this->currentKey]['$elemMatch'] = $elemMatch;
            return $this;
        }
        
    /**
     * Specify a query expression in javascript.
     * See mongo doc for more informations.
     * MongoDB operator : $where
     * @param   string $javascript javascript query expression
     * @return  object intance of this
     * @access  public
     */ public function where($javascript) {
            $this->filter['$where'] = $javascript;
            return $this;
        }
        
      /**
     * At least one of the filters must be satisfied.
     * Takes any number of parameters. Each parameter must be a filter object.
     * MongoDB operators : $or
     * @return  object intance of this
     * @access  public
     */ public function leastOne() {
            $args = func_get_args();
            $this->filter['$or'] = $args;
            return $this;
        }
        
    /**
     * None of the filters must be satisfied.
     * Takes any number of parameters. Each parameter must be a filter object.
     * MongoDB operator : $nor
     * @return  object intance of this
     * @access  public
     */ public function none() {
            $args = func_get_args();
            $this->filter['$nor'] = $args;
            return $this;
        }
        
    /**
     * All the filters must be satisfied.
     * Takes any number of parameters. Each parameter must be a filter object.
     * MongoDB operator : $and
     * @return  object intance of this
     * @access  public
     */ public function each() {
            $args = func_get_args();
            $this->filter['$and'] = $args;
            return $this;
        }
        
    /**
     * Adds a "isDouble" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isDouble() {
            $this->filter[$this->currentKey]['$type'] = 1;
            return $this;
        }
        
    /**
     * Adds a "isString" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isString() {
            $this->filter[$this->currentKey]['$type'] = 2;
            return $this;
        }
        
    /**
     * Adds a "isObject" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isObject() {
            $this->filter[$this->currentKey]['$type'] = 3;
            return $this;
        }
        
    /**
     * Adds a "isArray" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isArray() {
            $this->filter[$this->currentKey]['$type'] = 4;
            return $this;
        }
        
    /**
     * Adds a "isBinaryData" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isBinaryData() {
            $this->filter[$this->currentKey]['$type'] = 5;
            return $this;
        }
        
    /**
     * Adds a "isObjectId" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isObjectId() {
            $this->filter[$this->currentKey]['$type'] = 7;
            return $this;
        }
        
    /**
     * Adds a "isBoolean" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isBoolean() {
            $this->filter[$this->currentKey]['$type'] = 8;
            return $this;
        }
        
    /**
     * Adds a "isDate" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isDate() {
            $this->filter[$this->currentKey]['$type'] = 9;
            return $this;
        }
        
    /**
     * Adds a "isNull" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isNull() {
            $this->filter[$this->currentKey]['$type'] = 10;
            return $this;
        }
        
    /**
     * Adds a "isRegularExpression" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isRegularExpression() {
            $this->filter[$this->currentKey]['$type'] = 11;
            return $this;
        }
        
    /**
     * Adds a "isJavaScriptCode" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isJavaScriptCode() {
            $this->filter[$this->currentKey]['$type'] = 13;
            return $this;
        }
        
    /**
     * Adds a "isSymbol" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isSymbol() {
            $this->filter[$this->currentKey]['$type'] = 14;
            return $this;
        }
        
    /**
     * Adds a "isJavaScriptCodeWithScope" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isJavaScriptCodeWithScope() {
            $this->filter[$this->currentKey]['$type'] = 15;
            return $this;
        }
        
    /**
     * Adds a "is32bitInteger" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function is32bitInteger() {
            $this->filter[$this->currentKey]['$type'] = 16;
            return $this;
        }
        
    /**
     * Adds a "isTimestamp" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isTimestamp() {
            $this->filter[$this->currentKey]['$type'] = 17;
            return $this;
        }
        
    /**
     * Adds a "is64bitInteger" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function is64bitInteger() {
            $this->filter[$this->currentKey]['$type'] = 18;
            return $this;
        }
        
    /**
     * Adds a "isMinKey" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isMinKey() {
            $this->filter[$this->currentKey]['$type'] = 255;
            return $this;
        }
        
    /**
     * Adds a "isMaxKey" type condition to the current key.
     * MongoDB operator : $type
     * @return  object intance of this
     * @access  public
     */ public function isMaxKey() {
            $this->filter[$this->currentKey]['$type'] = 127;
            return $this;
        }
    }