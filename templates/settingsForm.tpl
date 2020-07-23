{**
 * plugins/generic/openImpact/templates/settingsForm.tpl
 *
 * Copyright (c) 2020 TIB Hannover
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * OpenImpact plugin settings
 *
 *}
<script>
	$(function() {ldelim}
		// Attach the form handler.
		$('#openImpactSettingsForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
	{rdelim});
</script>

<form class="pkp_form" id="openImpactSettingsForm" method="post" action="{url router=$smarty.const.ROUTE_COMPONENT op="manage" category="generic" plugin=$pluginName verb="settings" save=true}">

	{csrf}

	{include file="controllers/notification/inPlaceNotification.tpl" notificationId="openImpactSettingsFormNotification"}

	{fbvFormArea id="openImpactSettingsFormArea"}

		{* Choose social media indicators *}
		{fbvFormSection list="true" label="plugins.generic.openImpact.settings.indicator"}
			{foreach from=$indicators item=indicator name=indicators}
				{foreach from=$indicator key=id item=title}
					{assign var=checked value=false}
					{if $selectedIndicators && $id|in_array:$selectedIndicators}
						{assign var=checked value=true}
					{/if}
					{fbvElement type="checkbox" name="selectedIndicators[]" id=$id value=$id label=$title checked=$checked inline=true}
				{/foreach}
			{/foreach}
		{/fbvFormSection}

		{* Choose position *}
		{fbvFormSection label="plugins.generic.openImpact.settings.position"}
			{fbvElement type="select" id="selectedPosition" from=$positions  selected=$selectedPosition size=$fbvStyles.size.MEDIUM}
		{/fbvFormSection}

	{/fbvFormArea}

	{translate key="plugins.generic.openImpact.settings.note"}

	{fbvFormButtons}
	<p><span class="formRequired">{translate key="common.requiredField"}</span></p>
</form>
