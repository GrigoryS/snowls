<?php

class PluginSnow_HookSnow extends Hook {

	public function RegisterHook () {
		$this -> AddHook ('template_html_head_end', 'HeadEnd');                              // for main init
	}
	
	// ---

	public function HeadEnd () {
		return $this -> Viewer_Fetch (Plugin::GetTemplatePath (__CLASS__) . 'snow_begin.tpl');
	}
	
	// ---
}
?>
