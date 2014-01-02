<?php
class PluginSnow_ModuleSnow_MapperSnow extends Mapper {


	public function GetToysList(){
		$sql = 'SELECT *
			FROM 
				' . Config::Get('db.table.snow_toys') . '
		';		
		$aResult = array();
		
		if($aRows=$this->oDb->select($sql)) {
			foreach($aRows as $aRow){
				$aResult[] = Engine::GetEntity('PluginSnow_ModuleSnow_EntitySnow',$aRow);
			}
		}
		return $aResult;
	
	}
	
	public function GetToysByArrayId($aArrayId){
		if (!is_array($aArrayId) or count($aArrayId) == 0) {
			return array();
		}
		
		$sql = 'SELECT *
			FROM 
				' . Config::Get('db.table.snow_toys') . '
			WHERE
				toy_id IN (?a)
		';		
		$aResult = array();
		
		if($aRows=$this->oDb->select($sql,$aArrayId)) {
			foreach($aRows as $aRow){
				$aResult[$aRow['toy_id']] = $aRow['toy_src'];
			}
		}
		return $aResult;
	}
	
	public function SubmitSnow($oSnow){
		
		$sql = "REPLACE
			" . Config::Get('db.table.snow_users') . "
			SET
				{ snow_id = ?d, }
				user_id = ?d,
				snow_extra = ?
		";
		if($this->oDb->query($sql,
				is_null($oSnow->getSnowId()) ? DBSIMPLE_SKIP : $oSnow->getSnowId(),
				$oSnow->getUserId(),
				$oSnow->getSnowExtra()
			)){
			return true;
		}
		return false;
	}

}


?>
