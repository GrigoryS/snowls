<?php
class PluginSnow_ActionSnow extends ActionPlugin{

	protected $sMenuItemSelect = null;
	protected $sMenuSubItemSelect = null;

	/**
	 * Текущий юзер
	 *
	 * @var ModuleUser_EntityUser|null
	 */
	protected $oUserCurrent=null;
	
	public function Init(){
		/**
		 * Проверяем авторизован ли юзер
		 */
		if (!$this->User_IsAuthorization()) {
			return parent::EventNotFound();
		}
		$this->oUserCurrent=$this->User_GetUserCurrent();
		/**
		 * Усанавливаем дефолтный евент
		 */
		$this -> SetDefaultEvent ('settings');
		
		/**
		 * Устанавливаем title страницы
		 */
		$this->Viewer_AddHtmlTitle($this->Lang_Get('plugin.snow.menu_draw_me'));
	}

	
	public function RegisterEvent(){
		$this -> AddEvent ('settings', 'EventSettings');
	}
	
	
	protected function EventSettings(){
		$this -> sMenuSubItemSelect = 'snow';
		
		/**
		 * Загружаем список доступных игрушки
		 */
		$aToys = $this->PluginSnow_Snow_GetToysList();
		$this -> Viewer_Assign ('aToys', $aToys);
		
		/**
		 * Если форма отправлена
		 */
		if(isPost('submit_snow')){
			return $this->SubmitEdit();
		}
		$this -> Viewer_Assign ('oUserProfile', $this->oUserCurrent);
		$this -> Viewer_AddBlock('right','actions/ActionProfile/sidebar.tpl');
	}
	
	protected function SubmitEdit(){
		$this->Security_ValidateSendForm();
		
		$oSnow=Engine::GetEntity('PluginSnow_Snow_Snow');
		$oSnow->setUserId($this->oUserCurrent->getId());
		$aSnowExtra = array();
		/**
		 * Заполняем поле ИД строки
		 */
		if(getRequest('snow_id')){
			$oSnow->setSnowId(getRequest('snow_id'));
		}
		
		/**
		 * Заполняем поле с выбранными игрушками
		 */
		if(getRequest('toy')){	
			// @todo: валидация входящего массива
			foreach(getRequest('toy') as $aToy){
				$aSnowExtra['toys'][] = $aToy;
			}
		}
		
		/**
		 * Заполняем поле с снегом
		 */
		if(getRequest('show_snow')){
			$aSnowExtra['snow'] = true;
		} else {
			$aSnowExtra['snow'] = false;
		}
		
		if(!empty($aSnowExtra))
			$oSnow->setSnowExtra($aSnowExtra);
		else
			$oSnow->setSnowExtra(null);
			
			
		if(!is_null($oSnow->getSnowExtra()) and $this->PluginSnow_Snow_SubmitSnow($oSnow)){
			return Router::Location(Config::Get('path.root.web'));
		} else {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'));
			return Router::Action('error');
		}
	}
	
	public function EventShutdown(){
		$this -> Viewer_Assign ('sMenuItemSelect', $this -> sMenuItemSelect);
		$this -> Viewer_Assign ('sMenuSubItemSelect', $this -> sMenuSubItemSelect);
	}
	

}
?>
