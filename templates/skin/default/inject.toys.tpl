{if $oUserCurrent}
	{assign var=oUserToys value=$oUserCurrent->getToys()}
	{assign var="sTemplatePath" value=$aTemplateWebPathPlugin.snow}
	
		{if Router::GetAction()=="snow"}
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$( ".isDraggable" ).draggable({
				drag: function( event, ui ) {
					sToyId = $(this).attr('id');
					$('input#'+sToyId+'_top').val(ui.position.top);
					$('input#'+sToyId+'_left').val(ui.position.left);
				}
			});
		});
		</script>
		<style>
			.isDraggable:hover { cursor: move;}
		</style>
		{/if}
		{if $oUserToys and $oUserToys->getSnowToys()}
			{foreach from=$oUserToys->getSnowToys() key=sKey item=aToy}
				{assign var="sToyKey" value=key($aToy)}
				<img src="{$sTemplatePath}/images/toys/{$aToy.$sToyKey.src}" style="position: absolute; z-index: 5; top:{$aToy.$sToyKey.top}px; left:{$aToy.$sToyKey.left}px;" 
					{if Router::GetAction()=="snow"}class="isDraggable" id="toy_{$sKey}"{/if}/>
			{/foreach}
		{/if}

{/if}
