<?php

/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 22/02/16
 * Time: 4:11 PM
 */

final class ArgParcer
{

    private static $unformattedArguments;
    private static $formattedArguments;

    private static $instance = null;

    /**
     * ArgParcer constructor. Made private so that it can not be initialized. This enforces a singleton
     */
    private function __construct(){}

    public static function setupArgParcer($argv){
        ArgParcer::$unformattedArguments = $argv;

        // format argv into associative array with keys being the passed flag and the value being the value
        // passed for the flag

        // also look for toggle flags and set them as appropriate

        return self::getInstance();
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new ArgParcer();
        }
        return self::$instance;
    }

    /**
     * getValue is the main use method of the ArgPArcer in getting a value passed in as an argument. Getting a value
     * first checks if the value isset. Since isset returns false if a variable has been set to NULL, array_key_exist
     * is also runby it to check if the value exists. The reasoning for the double function calls is the isset is
     * substantialy faster then array_key_exists and therefor is preferrable. Use of php's short-circuited if statements
     * is used to get the best of both worlds
     * @param $key String - the flag that the value we are looking for belongs to
     * @return null OR String - the value belonging to the key, or null if the key does not exist
     */
    public function getValue($key){
        //check if key is set
        if (isset(self::$formattedArguments[$key]) || array_key_exists($key, self::$formattedArguments)) {
            return self::$formattedArguments[$key];
        }else{
            return null;
        }
    }
}