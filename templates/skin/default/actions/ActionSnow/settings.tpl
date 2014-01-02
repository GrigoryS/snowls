{assign var="sidebarPosition" value='left'}
{assign var="sMenuItemSelect" value='profile'}
{include file="header.tpl"}

{include file='menu.settings.tpl'}
{assign var="sTemplatePath" value=$aTemplateWebPathPlugin.snow}

<style>
#toys_list {
	overflow: hidden;
}
#toys_list li {
	height: 100px;
	overflow: hidden;
	border-bottom: 1px solid #f1f3f5;
	padding: 5px;
}


#toys_list li:hover{
	background-color: #f8fbfe;
}

#toys_list li img{
	height: 100px;
}

#toys_list li div.actions {
	display: inline-block;
	*display: inline;
	*zoom:1;
	padding-top: 20px;
	margin-bottom:0;
	width: 200px;
	float: right;
}

p.show_snow {
	margin: 15px 0px;
	padding: 5px;
	background-color: #f8fbfe;
}
</style>

<form method="post">
	<input type="hidden" name="security_ls_key" value="{$LIVESTREET_SECURITY_KEY}" />

	<fieldset>
		<legend>Активные игрушки</legend>
	   
	   	{assign var=oUserToys value=$oUserCurrent->getToys()}
		{assign var="sTemplatePath" value=$aTemplateWebPathPlugin.snow}
			<ul id="toys_list">
		{if $oUserToys}		
			<input type="hidden" name="snow_id" value="{$oUserToys->getSnowId()}" />
			{if $oUserToys->getSnowToys()}
				{foreach from=$oUserToys->getSnowToys() key=sKey item=aToy}
					{assign var="sToyKey" value=key($aToy)}
					<li id="toy_{$sKey}">
						<img src="{$sTemplatePath}/images/toys/{$aToy.$sToyKey.src}" />
						<input type="hidden" name="toy[{$sKey}][{$sToyKey}][top]" value="{$aToy.$sToyKey.top}" id="toy_{$sKey}_top"/>
						<input type="hidden" name="toy[{$sKey}][{$sToyKey}][left]" value="{$aToy.$sToyKey.left}" id="toy_{$sKey}_left"/>
						<div class="actions">
							<a href="#" class="delete" onclick="deleteToy({$sKey}); return false;">{$aLang.delete}</a>
						</div>
					</li>
				{/foreach}
			{/if}
		{/if}
		</ul>
			
			
		<p class="show_snow">
			<label><input type="checkbox" name="show_snow" value="1" {if $_aRequest.show_snow or ($oUserToys and $oUserToys->getShowSnow())}checked{/if} class="input-checkbox"> Включить снежки</label>
		
		</p>
		<p>
			<input type="submit" value="Сохранить" class="button button-primary" name="submit_snow"/>
		</p>
		
		
	</fieldset>	
</form>

<fieldset>
	<legend>Доступные игрушки</legend>
	{if $aToys}
	{foreach from=$aToys item=oToy}
	
	<a href="#" onclick="addToy({$oToy->getToyId()},this); return false;"><img src="{$sTemplatePath}images/toys/{$oToy->getToySrc()}" /></a>
	
	{/foreach}
	<script>
		$(document).ready(function(){
			$('#toys_list li').hover(function(){
			
			},function(){
			
			});
		});
		
		function addToy(iToyId, obj){
			
			iLastId = 0;
			
			if($('#toys_list li:last').length > 0){
				aLastLiId = $('#toys_list li:last').attr('id').split('_');
				iLastId = parseInt(aLastLiId[1])+1;
			} 
			
			sImageSrc = $('img',obj).attr('src');
			
			
			$('#toys_list').append(
				$('<li/>',{
					'id': 'toy_'+iLastId,
					html: '<img src="'+ sImageSrc +'" />'+
						'<input type="hidden" name="toy['+ iLastId +']['+ iToyId +'][top]" value="100" id="toy_'+ iLastId +'_top"/>'+
						'<input type="hidden" name="toy['+ iLastId +']['+ iToyId +'][left]" value="100" id="toy_'+ iLastId +'_left"/>'+
						'<div class="actions"><a href="#" class="delete" onclick="deleteToy('+ iLastId +'); return false;">{$aLang.delete}</a></div>'
				})
			);
			
			$('body').prepend('<img src="'+ sImageSrc +'" style="position: absolute; z-index: 5; top:100px; left:100px;" class="isDraggable" id="toy_'+ iLastId +'">');
			
			$( ".isDraggable" ).draggable({
				drag: function( event, ui ) {
					sToyId = $(this).attr('id');
					$('input#'+sToyId+'_top').val(ui.position.top);
					$('input#'+sToyId+'_left').val(ui.position.left);
				}
			});
			return false;
		}
		
		function deleteToy(id){
			$('li#toy_'+id).remove();
			$('img#toy_'+id).remove();
			return false;
		}
	</script>
	
	{else}
	Coming soon
	{/if}
	
</fieldset>


{include file="footer.tpl"}
