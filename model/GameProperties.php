<?php

class Soccer_Service_Soccer_Module_User_GameProperties extends Soccer_Service_Soccer_Module
{
    /**
     * Modules used
     *
     * @var array
     */
    
    protected $modules = array(
        'User', 
    );
    
    protected $_properties;
    
    public function updateProperties(array $data) {
        try {
            if (!intval($data['id_user'])) {
                throw new Exception('Empty user id for getting user properties');
            }
            $userid = $data['id_user'];
            $properties = $this->getProperties($userid);
            foreach ($properties as $fieldName => $value) {
                if (array_key_exists($fieldName, $data)) {
                    $properties[$fieldName] = $data[$fieldName];
                }
            }
            $this->data->usergameproperties->execute('updateProperties', $properties);
            return true;
        }
        catch (Exception $e) {
            //TODO LOG EXCEPTION MESSAGE
        }
        return false;
    }
    
    public function getProperties($userid) {
        //TODO IMPLEMENT MEMCACHED
        if (is_array($this->_properties)) {
            return $this->_properties;
        }
        
        $data = $this->data->usergameproperties->find('getProperties', array('userid' => $userid));
        return $this->_properties = array_pop($data);
    }
    
    public function getProperty($userid, $propertyName) {
        $this->getProperties($userid);
        return $this->_properties[$propertyName];
    }
    
    
    
    
    
}
