<?php
/**
 *
 */
class Soccer_Service_Soccer_Processor_User_Increaseconsumable extends Soccer_Service_Soccer_Processor
{
    /** @var array Data requirements **/
    public $received_data_requirements = array(
        'uID' => array(
            'required' => true,
            'type' => Soccer_Service_Soccer_Hook_DataValidation::DATA_REQUIREMENT_VAR_TYPE_INT
        ),
        'type' => array(
            'required' => true,
            'type' => Soccer_Service_Soccer_Hook_DataValidation::DATA_REQUIREMENT_VAR_TYPE_INT
        ),
        'amount' => array(
            'required' => true,
            'type' => Soccer_Service_Soccer_Hook_DataValidation::DATA_REQUIREMENT_VAR_TYPE_INT
        ),
    );
    /**
     * [$common_modules description]
     * @var array
     */
    protected $common_modules = array();

    /**
     * [$modules description]
     * @var array
     */
    protected $modules = array(
        'User', 'User_ConsumableFactory'
    );

    /**
     * [process description]
     * @return [type] [description]
     */
    public function process()
    {
        
        $userid        = $this->get('uID');
        $type          = $this->get('type');
        $value          = $this->get('amount');
        $consumableModule = $this->user_consumablefactory->factory($type);
        $this->set('data', $consumableModule->increase($userid, $value));
        return true;
    }
}
