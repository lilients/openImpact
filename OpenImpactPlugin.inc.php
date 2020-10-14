<?php

/**
 * @file plugins/generic/openImpact/OpenImpactPlugin.inc.php
 *
 * Copyright (c) 2020 TIB Hannover
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class OpenImpactPlugin
 * @ingroup plugins_generic_openImpact
 *
 * @brief OpenImpact plugin class
 */

import('lib.pkp.classes.plugins.GenericPlugin');

class OpenImpactPlugin extends GenericPlugin {
	/**
	 * @copydoc Plugin::getDisplayName()
	 */
	function getDisplayName() {
		return __('plugins.generic.openImpact.displayName');
	}

	/**
	 * @copydoc Plugin::getDescription()
	 */
	function getDescription() {
		return __('plugins.generic.openImpact.description');
	}

	/**
	 * @copydoc Plugin::register()
	 */
	function register($category, $path, $mainContextId = null) {

		if (parent::register($category, $path)) {
			if ($this->getEnabled()) {

				$request = $this->getRequest();
				$context = $request->getContext();
				$contextId = $context->getId();

				// TODO: display the buttons depending on the selected position
				switch($this->getSetting($contextId, 'selectedPosition')){
					case 'sidebar':
						HookRegistry::register('Templates::Article::Details', array($this, 'addOverview'));
						HookRegistry::register('Templates::Catalog::Book::Details', array($this, 'addOverview'));
				}

				// calling hooks to display impactViz somewhere below the abstract
				HookRegistry::register('Templates::Article::Main', array($this, 'displayImpact'));
				HookRegistry::register('Templates::Catalog::Book::Main', array($this, 'displayImpact'));
			}
			return true;
		}
		return false;
	}

	/**
	 * Get the name of the settings file to be installed on new context
	 * creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}


	/**
	 * Hook callback: Handle requests.
	 * @param $hookName string The name of the hook being invoked
	 * @param $args array The parameters to the invoked hook
	 * @return bool
	 */
	function addOverview($hookName, $args) {
		$template =& $args[1];
		$output =& $args[2];

		// display overview of ImpactViz
		$output .= '

		<!-- overview -->
		<div id="impactviz-overview"></div>
		';

	}

	/**
	 * Hook callback: Handle requests.
	 * @param $hookName string The name of the hook being invoked
	 * @param $args array The parameters to the invoked hook
	 * @return bool
	 */
	function displayImpact($hookName, $args) {
		$template =& $args[1];
		$output =& $args[2];

		$request = $this->getRequest();
		$context = $request->getContext();
		$contextId = $context->getId();

		// indicators
		// create own customize list from plugin settings and hand it over to impactViz
		$selectedIndicators = $this->getSetting($contextId, 'selectedIndicators');
		$preparedServices = array_map(create_function('$arrayElement', 'return $arrayElement;'), $selectedIndicators);
		$selectedIndicators = implode(",", $preparedServices);

		// javascript, css and backend url
		$requestedUrl = $request->getCompleteUrl();
		$baseUrl = $request->getBaseUrl();
		$jsUrl = $baseUrl .'/'. $this->getPluginPath().'/impactviz/impact.js';
		$cssUrl = $baseUrl .'/' . $this->getPluginPath() . '/impactviz/style.css';

		// paths to the impactviz files
		$entitiesPath = $baseUrl .'/'. $this->getPluginPath().'/impactviz/schemas/';
		$customizePath = $baseUrl .'/'. $this->getPluginPath().'/impactviz/schemas/customize.json';
		$indicatorsPath = $baseUrl .'/'. $this->getPluginPath().'/impactviz/schemas/indicators.json';
		$imgPath = $baseUrl .'/'. $this->getPluginPath().'/impactviz/img/';
		$libPath = $baseUrl .'/'. $this->getPluginPath().'/impactviz/lib/';

		// TODO: include libraries and address them using the $libPath

		// display impactviz
		$output .= '

			<!-- dependencies (jquery, handlebars and bootstrap) -->
			<script type="text/javascript" src="//code.jquery.com/jquery-3.5.1.min.js"></script>
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>
			<link type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet"/>
			<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

			<!-- alpaca -->
			<link type="text/css" href="//cdn.jsdelivr.net/npm/alpaca@1.5.27/dist/alpaca/bootstrap/alpaca.min.css" rel="stylesheet"/>
			<script type="text/javascript" src="//cdn.jsdelivr.net/npm/alpaca@1.5.27/dist/alpaca/bootstrap/alpaca.min.js"></script>

			<!-- google icons -->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

			<!-- paperbuzzviz and d3js-->
			<script type="text/javascript" src="https://d3js.org/d3.v4.min.js"></script> <!-- TODO get via npm or git submodule -->
			<script type="text/javascript" src="'.$libPath.'paperbuzzviz/example/d3-tip.js"></script>
			<script type="text/javascript" src="'.$libPath.'paperbuzzviz/paperbuzzviz.js"></script>
			<link rel="stylesheet" type="text/css" href="'.$libPath.'paperbuzzviz/assets/css/paperbuzzviz.css" />


			<div class="item">
				<h3>Impact</h3>
				<!-- overview -->
				<div id="impactviz-overview"></div>
				<!-- details -->
				<div id="impactviz-details"></div>
				<!-- customize -->
				<div id="impactviz-customize"></div>
			</div>

			<!-- impactviz scripts -->
			<link type="text/css" rel="stylesheet" href="'.$cssUrl.'">
			<script src="'.$jsUrl.'"></script>

			<script>

				var identifier = "10.1038/520429a";
				var options = {
					entities: "'.$entitiesPath.'",
					indicators: "'.$indicatorsPath.'",
					selectedIndicators: "'.$selectedIndicators.'",
					img: "'.$imgPath.'"
				}

				impact = new ImpactViz(identifier, options);
				impact.initViz();

			</script>
			';

		return false;
	}

	/**
	 * @copydoc Plugin::getActions()
	 */
	function getActions($request, $verb) {
		$router = $request->getRouter();
		import('lib.pkp.classes.linkAction.request.AjaxModal');
		return array_merge(
			$this->getEnabled()?array(
				new LinkAction(
					'settings',
					new AjaxModal(
						$router->url($request, null, null, 'manage', null, array('verb' => 'settings', 'plugin' => $this->getName(), 'category' => 'generic')),
						$this->getDisplayName()
					),
					__('manager.plugins.settings'),
					null
				),
			):array(),
			parent::getActions($request, $verb)
		);
	}

	/**
	 * @copydoc Plugin::manage()
	 */
	function manage($args, $request) {
		switch ($request->getUserVar('verb')) {
			case 'settings':
				AppLocale::requireComponents(LOCALE_COMPONENT_APP_COMMON,  LOCALE_COMPONENT_PKP_MANAGER);
				$this->import('OpenImpactSettingsForm');
				$form = new OpenImpactSettingsForm($this, $request->getContext()->getId());

				if ($request->getUserVar('save')) {
					$form->readInputData();
					if ($form->validate()) {
						$form->execute();
						$notificationManager = new NotificationManager();
						$notificationManager->createTrivialNotification($request->getUser()->getId());
						return new JSONMessage(true);
					}
				} else {
					$form->initData();
				}
				return new JSONMessage(true, $form->fetch($request));
		}
		return parent::manage($args, $request);
	}
}

?>
