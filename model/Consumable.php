<?php
/**
 * Handles whether a user can store the item in their inventory
 *
 * @package GUK1:Soccer
 *
 * @todo Method to check if the user has enough space for Storage
 */

/**
 * Soccer_Service_Soccer_Module_Storage
 *
 * @package GUK1:Soccer
 */
abstract class Soccer_Service_Soccer_Module_User_Consumable extends Soccer_Service_Soccer_Module
{
    /**
     * Modules used
     *
     * @var array
     */
    
    protected $modules = array();
    
    protected $_gameProperties;
    /**
     * Store the card
     *
     * return bool
     */
    abstract public function decrease($userid, $value);
    
    /**
     * Icreases energy level
     *
     * return bool
     */
    abstract public function increase($userid, $value);
    
    /**
     * gets energy level
     *
     * return bool
     */
    abstract public function get($userid);
    
    /**
     * gets energy level
     *
     * return bool
     */
    abstract protected function checkForMaxAmount($userid, $value);
    
    
    protected function _getPropertiesInstance() {
        if (!$this->_gameProperties) {
            $this->_gameProperties = $this->module->user_gameProperties;
        }
        return $this->_gameProperties;
    }
    
    
    /**
     * Decreases consumable amount
     *
     * return boolean
     */
    protected function decreaseProperty($userid, $value) {
        try {
            $params = array();
            $currentValue = $this->get($userid);
            $currentValue = (int)$currentValue;
            $value = (int)$value;
            $params['id_user'] = $userid;
            $params[$this->_propertyName] = $currentValue - $value;
            if ($params[$this->_propertyName] < 0) {
                return false;
            }
            $this->_getPropertiesInstance()->updateProperties($params);
            return true;
        }
        catch (Exception $e) {
            //TODO LOG EXCEPTION HERE
        }
        return false;
    }
    
    /**
     * Icreases consumable amount
     *
     * return boolean
     */
    protected function increaseProperty($userid, $value) {
        try {
            $params = array();
            $currentValue = $this->get($userid);
            $currentValue = (int)$currentValue;
            $value = (int)$value;
            $params['id_user'] = $userid;
            $value = (int)$value;
            $params[$this->_propertyName] = min( $currentValue + $value, (int)$this->getMaximumFieldAmount($userid) );
            if ( $currentValue < $params[$this->_propertyName] ) { //only update if something changed
                $this->_getPropertiesInstance()->updateProperties($params);
            }
            return true;
        }
        catch (Exception $e) {
            echo $e->getMessage();
            //TODO LOG EXCEPTION HERE
        }
        return false;
    }
    
    /**
     * Check if user reached maximum amount of consumable property 
     */
    protected function checkForMaxAmountProperty($userid, $valueToCheck) {
        $maximumValue = (int)$this->getMaximumFieldAmount($userid);
        
        $valueToCheck = (int)$valueToCheck;
        if ($valueToCheck > $maximumValue) {
            throw new Exception('Maximim value amount exceeded');
            //TODO LOG EXCEPTION HERE
        }
        return true;
    }
    
    /**
     * gets consumable value by property name and user id
     * @param int $userid
     * @param string $name
     * @return mixed 
     */
    protected function getConsumable($userid, $name) {
        return $this->_getPropertiesInstance()->getProperty($userid, $name);
    }
    
    
    protected function getMaximumFieldAmount($userid) {
        return $this->getConsumable($userid, $this->_propertyMaxAmountName);
    }
    
}
