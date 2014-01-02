<?php
class PluginSnow_ModuleSnow extends Module {
	protected $oMapper;
	
	
	public function Init()
    {
        $this->oMapper = Engine::GetMapper(__CLASS__);
	}
	
	
	public function GetToysList(){
		return $this->oMapper->GetToysList();
	}
	
	public function GetToysByArrayId($aArrayId){
		return $this->oMapper->GetToysByArrayId($aArrayId);
	}
	
	public function SubmitSnow(PluginSnow_ModuleSnow_EntitySnow $oSnow){
		//чистим зависимые кеши
		$this->Cache_Clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG,array('user_update'));
		$this->Cache_Delete("user_{$oSnow->getUserId()}");
		return $this->oMapper->SubmitSnow($oSnow);
	}
}


?>
