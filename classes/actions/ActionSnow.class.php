<?php
class PluginSnow_ActionSnow extends ActionPlugin{

	protected $sMenuItemSelect = null;
	protected $sMenuSubItemSelect = null;

	public function Init(){
		$this -> SetDefaultEvent ('settings');
	}

	
	public function RegisterEvent(){
		$this -> AddEvent ('settings', 'EventSettings');
	}
	
	
	protected function EventSettings(){
		$this -> sMenuSubItemSelect = 'snow';
	}
	
	public function EventShutdown(){
		$this -> Viewer_Assign ('sMenuItemSelect', $this -> sMenuItemSelect);
		$this -> Viewer_Assign ('sMenuSubItemSelect', $this -> sMenuSubItemSelect);
	}
	

}
?>
