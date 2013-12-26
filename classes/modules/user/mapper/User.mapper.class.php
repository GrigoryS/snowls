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
				' . Config::Get('db.table.snow_users') . ' as su
			INNER JOIN
				' . Config::Get('db.table.snow_toys') . ' as st
			ON
				su.toy_id = st.toy_id
			WHERE
				`user_id` IN (?a)			
		';		
		$aResult = array();
		
		if($aRows=$this->oDb->select($sql,$aArrayId)) {
			foreach($aRows as $aRow){
				$aResult[$aRow['user_id']][] = $aRow;
			}
			
		}
		return $aResult;
	}

}
?>
