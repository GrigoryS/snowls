<?php
class PluginSnow_ModuleSnow_EntitySnow extends Entity {

	public function getUnserializeSnowExtra() {
		return @unserialize($this->_getDataOne('snow_extra'));
	}
	
	public function getSnowExtra() {
		return $this->_getDataOne('snow_extra');
	}
	
	public function setSnowExtra($data) {
		$this->_aData['snow_extra'] = serialize($data);
	}
	
	public function getShowSnow() {
		$aExtra = $this->getUnserializeSnowExtra();
		
		if($aExtra){
			if(isset($aExtra['snow']) and $aExtra['snow']===true)
				return true;
			else
				return false;
		}
		return false;
	}
	
	public function getSnowToys() {
		$aExtra = $this->getUnserializeSnowExtra();
		
		if($aExtra){
			if(isset($aExtra['toys'])){
				return $aExtra['toys'];
			}
			return false;
		}
		return false;
	}

}

?>
