<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * GOCRISTY CMS
 *
 * An open source content management system
 *
 * Copyright (c) 2018, Marcos Fermin.
 *
 * 
 *
 *
 *
 *
 *
 * @author	Marcos Fermin
 * @copyright   Copyright (c) 2018, Marcos Fermin.
 * @license	The MIT License (MIT)
 * @link	http://www.gocristy.com
 * @since	Version 0.0.1
 *
 *
 * Mysql database with MySQLi class - only one connection alowed
 */
class Database{

    public $_connection;

    // Constructor
    public function __construct($dbhost = '', $dbuser = '', $dbpass = '', $dbname = ''){
        $this->_connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        $this->_connection->set_charset('utf8');
        $this->_connection->query("SET collation_connection = utf8_general_ci");
        // Error handling
        if(mysqli_connect_error()){
            trigger_error("Failed to conencto to MySQL: ".mysqli_connect_error(), E_USER_ERROR);
        }
    }

    // Get mysqli connection
    public function connectDB(){
        return $this->_connection;
    }

    public function numrow($result){
        return $result->num_rows;
    }

    public function closeDB(){
        $this->_connection->close();
    }

    public function mysqli_multi_query_file($mysqli, $filename){
        /* error_reporting(E_ERROR | E_PARSE); */
        $sql = file_get_contents($filename);
        // remove comments
        $sql = preg_replace('#/\*.*?\*/#s', '', $sql);
        $sql = preg_replace('/^-- .*[\r\n]*/m', '', $sql);
        if(preg_match_all('/^DELIMITER\s+(\S+)$/m', $sql, $matches, PREG_SET_ORDER | PREG_OFFSET_CAPTURE)){
            $prev = null;
            $index = 0;
            foreach($matches as $match){
                $sqlPart = substr($sql, $index, $match[0][1] - $index);
                // move cursor after the delimiter
                $index = $match[0][1] + strlen($match[0][0]);
                if($prev && $prev[1][0] != ';'){
                    $sqlPart = explode($prev[1][0], $sqlPart);
                    foreach($sqlPart as $part){
                        if(trim($part)){ // no empty queries
                            $mysqli->query($part);
                        }
                    }
                }else{
                    if(trim($sqlPart)){ // no empty queries
                        $mysqli->multi_query($sqlPart);
                        while(@$mysqli->next_result()){
                            ;
                        }
                    }
                }
                $prev = $match;
            }
            // run the sql after the last delimiter
            $sqlPart = substr($sql, $index, strlen($sql) - $index);
            if($prev && $prev[1][0] != ';'){
                $sqlPart = explode($prev[1][0], $sqlPart);
                foreach($sqlPart as $part){
                    if(trim($part)){
                        $mysqli->query($part);
                    }
                }
            }else{
                if(trim($sqlPart)){
                    $mysqli->multi_query($sqlPart);
                    while(@$mysqli->next_result()){
                        ;
                    }
                }
            }
        }else{
            $mysqli->multi_query($sql);
            while(@$mysqli->next_result()){
                ;
            }
        }
    }

}

class Version{

    private function getVersionConfig(){
        $config = array();
        require '../gocristy/config/systemconfig.php';
        return $config['GoCristy_version'];
    }

    private function getReleaseConfig(){
        $config = array();
        require '../gocristy/config/systemconfig.php';
        return $config['GoCristy_release'];
    }

    public function getVersion(){
        $version = '';
        if($this->getReleaseConfig() == 'beta'){
            $version = $this->getVersionConfig().' Beta';
        }else{
            $version = $this->getVersionConfig();
        }
        return $version;
    }

    public function setTimezone($timezone){
        if(!$timezone)
            $timezone = 'America/New_York';
        if(function_exists('ini_set')){
            ini_set('max_execution_time', 300);
            ini_set('date.timezone', $timezone);
        }
    }

}

class GoCristyModel{

    /**
     * pwdEncypt
     *
     * Function for encyption the password with 3 step
     *
     * @param	string	$password    password
     * @return	string
     */
    public function pwdEncypt($password) {
        $options = array('cost' => 12);
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

}
