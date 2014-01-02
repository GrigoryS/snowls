<?php
class PluginSnow_ModuleUser_MapperUser extends PluginSnow_Inherit_ModuleUser_MapperUser
{
  
  public function GetUsersByArrayId($aArrayId) {
		//Возвращаем данные от родителя
		$aUsers = parent::GetUsersByArrayId($aArrayId);
		
		//Собираем данные о подарках
		$aToys = $this->GetCurrentUserToys($aArrayId);
		
		//Добавляем объект с существующими подарками пользователю
		foreach ($aUsers as $oUser) {
			if (!empty($aToys[$oUser->getId()]))
				$oUser->setToys($aToys[$oUser->getId()]);
		}
		return $aUsers;
	}
	
	protected function GetCurrentUserToys($aArrayId){
		if (!is_array($aArrayId) or count($aArrayId) == 0) {
			return array();
		}
		
		$sql = 'SELECT *
			FROM 
				' . Config::Get('db.table.snow_users') . '
			WHERE
				`user_id` IN (?a)			
		';		
		$aResult = array();
		
		if($aRows=$this->oDb->select($sql,$aArrayId)) {
			if(count($aRows)>0){
				foreach($aRows as $aRow){

					$aExtra = @unserialize($aRow['snow_extra']);
					if(isset($aExtra['toys']) and count($aExtra['toys'])>0){
						$aToysId = array();
						
						foreach($aExtra['toys'] as $key=>$aExtraToy){
							$aToysId[] = key($aExtraToy);				
						}

						$oEngine = Engine::GetInstance();
						$aToys = $oEngine->PluginSnow_Snow_GetToysByArrayId(array_unique($aToysId));
						$i = 0;
						foreach($aExtra['toys'] as $key=>$aExtraToy){
							$aExtra['toys'][$key][key($aExtraToy)]['src'] = $aToys[key($aExtraToy)];
						}
					}
					$aRow['snow_extra'] = serialize($aExtra);
					$aResult[$aRow['user_id']] = Engine::GetEntity('PluginSnow_Snow_Snow',$aRow);
				}
			}
		}
		
		return $aResult;
	}

}
?>
