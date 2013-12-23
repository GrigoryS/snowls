<?php
/*
 Разработчик - Grigory Smirnov. Пишите на grigory_dev@yahoo.com
 2013. С новым Годом вас!


 Developer is Grigory Smirnov. Write to grigory_dev@yahoo.com or grigory_smirnov@mail.ru
 2013. Happy New Year!
*/ 

 //Запрещаем напрямую обращение к этому файлу.
if (!class_exists('Plugin')) {
	die('Oh, Hacking attemp!');
}

class PluginSnow extends Plugin {

    //Дальнейшие комментариии чисто для меня
    // Объявление делегирований (свои экшны и шаблоны)
	public $aDelegates = array(
            
    );

	// Объявление переопределений
	protected $aInherits=array( 	   
    );

	// Активация плагина
	public function Activate() { 
		return true;
	}
    
	// Деактивация плагина
	public function Deactivate(){        
		return true;	 
    }


	// Инициализация плагина
	public function Init() {
        //$this->Viewer_AppendScript(Plugin::GetTemplateWebPath(__CLASS__).'js/snow.js');
        //$this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__) . 'snow_header.tpl');
		
	}

   
}
?>
