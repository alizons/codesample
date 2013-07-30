<?php

class Soccer_Service_Soccer_Module_User_Consumable_Scouting extends Soccer_Service_Soccer_Module_User_Consumable
{
    /**
     * Modules used
     *
     * @var array
     */
    protected $modules = array('User');

    protected $_propertyName = 'energy_scouting';
    protected $_propertyMaxAmountName = 'max_energy_scouting';
    
    /**
     * Decreases consumable amount
     *
     * return boolean
     */
    public function decrease($userid, $value) {
        return parent::decreaseProperty($userid, $value);
    }
    
    
    /**
     * Icreases consumable amount
     *
     * return boolean
     */
    public function increase($userid, $value) {
        return parent::increaseProperty($userid, $value);
    }
    
    /**
     * gets consumable amount
     *
     * return bool
     */
    public function get($userid) {
        return parent::getConsumable($userid, $this->_propertyName);
    }
    
    /**
     * Checks if increased consumable is not more than a maximum
     * @param int $userid
     * @param string $value 
     */
    protected function checkForMaxAmount($userid, $value) {
        return parent::checkForMaxAmountProperty($userid, $value);
    }
        
}
