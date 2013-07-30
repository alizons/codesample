<?php

class Soccer_Service_Soccer_Module_User_ConsumableFactory extends Soccer_Service_Soccer_Module
{
    /**
     * Modules used
     *
     * @var array
     */
    
    protected $modules = array(
        'User_Consumable_Match', 
        'User_Consumable_Scouting',
        'User_Consumable_Training',
        'User_Consumable_Gacha'
    );
    
    CONST CONSUMABLE_TYPE_MATCH_ENERGY = 1;
    CONST CONSUMABLE_TYPE_SCOUTING_ENERGY = 2;
    CONST CONSUMABLE_TYPE_POINTS_TRAINING = 3;
    CONST CONSUMABLE_TYPE_POINTS_GACHA = 4;
    
    public function factory($type) {
        switch ($type) {
            case self::CONSUMABLE_TYPE_MATCH_ENERGY : {
                return $this->module->user_consumable_match;
            }
            break;
            case self::CONSUMABLE_TYPE_SCOUTING_ENERGY : {
                return $this->module->user_consumable_scouting;
            }
            break;
            case self::CONSUMABLE_TYPE_POINTS_TRAINING : {
                return $this->module->user_consumable_training;
            }
            break;
            case self::CONSUMABLE_TYPE_POINTS_GACHA: {
                return $this->module->user_consumable_gacha;
            }
            break;
        }
    }
}
