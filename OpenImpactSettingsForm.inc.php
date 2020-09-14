<?php

/**
 * @file plugins/generic/openImpact/OpenImpactSettingsForm.inc.php
 *
 * Copyright (c) 2020 TIB Hannover
 * Distributed under the GNU GPL v3. For full terms see the file LICENSE.
 *
 * @class OpenImpactSettingsForm
 * @ingroup plugins_generic_openImpact
 *
 * @brief Form for managers to modify openImpact plugin settings
 */

import('lib.pkp.classes.form.Form');

class OpenImpactSettingsForm extends Form {

	/** @var int Associated context ID */
	private $_contextId;

	/** @var OpenImpactPlugin plugin */
	private $_plugin;

	/**
	 * Constructor
	 * @param $plugin OpenImpactPlugin plugin
	 * @param $contextId int Context ID
	 */
	function __construct($plugin, $contextId) {
		$this->_contextId = $contextId;
		$this->_plugin = $plugin;

		parent::__construct($plugin->getTemplatePath() . 'settingsForm.tpl');
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	/**
	 * Initialize form data.
	 * @see Form::initData()
	 */
	function initData() {
		$contextId = $this->_contextId;
		$plugin = $this->_plugin;
		// TODO: solve ojs version conflict
	//	$request = Application::get()->getRequest();
	//	$baseUrl = $request->getBaseUrl();
		$baseUrl = Request::getBaseUrl();

		// read array of indicators from file
		$file = $baseUrl .'/'. $plugin->getPluginPath().'/impactviz/schemas/indicators.json';

		// handle json to store in array
		$json = json_decode(file_get_contents($file));
		$indicators = array();

		// read all entries of the json
		foreach ($json as $value) {
			array_push($indicators, array($value->id => $value->name));
		}

		// hand data over to the template
		$this->setData('indicators', $indicators);
		$this->setData('selectedIndicators', $plugin->getSetting($contextId, 'selectedIndicators'));

		// array of possible positions at the website
		$positions = array(
			'sidebar' => 'plugins.generic.openImpact.settings.position.sidebar',
			'submission' => 'plugins.generic.openImpact.settings.position.submission'
		);
		$this->setData('positions', $positions);
		$this->setData('selectedPosition', $plugin->getSetting($contextId, 'selectedPosition'));

	}

	/**
	 * Assign form data to user-submitted data.
	 * @see Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array('selectedTheme', 'selectedPosition', 'selectedIndicators', 'selectedOrientation'));
	}

	/**
	 * Fetch the form.
	 * @see Form::fetch()
	 * @param $request PKPRequest
	 */
	function fetch($request) {
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('pluginName', $this->_plugin->getName());
		return parent::fetch($request);
	}

	/**
	 * Save settings.
	 * @see Form::execute()
	 */
	function execute() {
		$plugin = $this->_plugin;
		$contextId = $this->_contextId;

		$plugin->updateSetting($contextId, 'selectedPosition', $this->getData('selectedPosition'), 'string');
		$plugin->updateSetting($contextId, 'selectedIndicators', $this->getData('selectedIndicators'), 'object');
	}
}
?>
