<?php

class PluginSnow_HookSnow extends Hook {

	public function RegisterHook () {
		if (Config::Get('plugin.snow.show_snow')){
			$this -> AddHook ('template_html_head_end', 'HeadEnd');                              // for main init
		}
		
		$this -> AddHook ('template_menu_settings_settings_item', 'TplMenuSettings');        // 
		
		$this -> AddHook ('template_body_begin', 'TplBodyBegin');        // 
	}
	
	// ---

	public function HeadEnd () {
		return $this -> Viewer_Fetch (Plugin::GetTemplatePath (__CLASS__) . 'snow_begin.tpl');
	}
	
	// ---
	
	public function TplMenuSettings () {
		return $this -> Viewer_Fetch (Plugin::GetTemplatePath (__CLASS__) . 'menu.snow.tpl');
	}
	
	// ---
	
	public function TplBodyBegin () {
		return $this -> Viewer_Fetch (Plugin::GetTemplatePath (__CLASS__) . 'inject.toys.tpl');
	}
	
	// ---
}
?>
