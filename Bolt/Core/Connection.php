<?php namespace Bolt\Core;

use \Mongo;

/**
 * Bolt MongoDB QueryBuider
 *
 * @category   Bolt
 * @package    Core
 * @todo       Implement mongodb aggregation
 * @author     Julien Alric <julien.alric@gmail.com>
 * @version    version 1.0
 */ class Connection {
 
    /**
     * Databases instances.
     * @var    array instances
     * @access protected
     */ protected static $_instance;
     
    /**
     * Class constructor.
     * @param     string $sEntity entity
     * @return     void
     * @access    protected
     */ protected function __construct() {
            $host = 'localhost';
            $port = 27017;
            $user = 'username';
            $pass = 'password';
            $base = 'admin';
            
            $this->dbCon = new Mongo("mongodb://{$host}:{$port}", array('username'=>$user, 'password'=>$pass, 'db'=>$base));
        }
       
    /**
     * Create and return a collection connection.
     * @param   string $sEntity entity name
     * @return  object collection connection
     * @access  public
     */ public static function getInstance(){
            if (!isset(static::$_instance)) {
                static::$_instance = new static();
            }
            return static::$_instance->dbCon;
        }
    }