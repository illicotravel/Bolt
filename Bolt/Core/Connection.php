<?php namespace Bolt\Core;

use \Mongo;

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
 */ Class Connection {
 
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