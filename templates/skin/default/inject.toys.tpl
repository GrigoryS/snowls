{if $oUserCurrent}
	{assign var=oUserToys value=$oUserCurrent->getToys()}
	{assign var="sTemplatePath" value=$aTemplateWebPathPlugin.snow}

	{foreach from=$oUserToys key=sKey item=aToy}
		<img src="{$sTemplatePath}/images/{$aToy.toy_src}" style="position: absolute; z-index: 5; top:{$aToy.top}px; left:{$aToy.left}px;" />
		
	{/foreach}
	
{/if}
