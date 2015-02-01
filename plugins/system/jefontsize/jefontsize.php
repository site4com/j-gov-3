<?php
/**
* @package   JE Font Size
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : emailtohardik@gmail.com, joomextensions@gmail.com
**/
defined ( '_JEXEC' ) or die ( 'Restricted access' );
jimport ( 'joomla.plugin.plugin' );
jimport ( 'joomla.filesystem.file');

class plgSystemJefontsize extends JPlugin {
		function plgSystemJFBChat(& $subject, $config) {
		parent::__construct ( $subject, $config );
		} 
		function onAfterDispatch() {
		$app = JFactory::getApplication(); 
		// Execute solo nel frontend
		if(!$app->getClientId()) {
			//load the translation
			$language = JFactory::getLanguage();
			$langTag = $language->getTag();
			// Security safe
			if(!JFile::exists(JPATH_SITE . DS .'plugins/system/jefontsize/jefontsize/languages/' . $langTag . '.js')) {
				$langTag = 'en-GB';
			}
			// Ottenimento document
			$doc = JFactory::getDocument (); 
			if($doc->getType() !== 'html' || JRequest::getCmd('tmpl') === 'component') {
				return false;
			}
			JHTML::_('behavior.framework'); 
			// Gestione params plugin php / options plugin js
			$pparmas = new stdClass();
			$pparams->max_font = $this->params->get('max_font', 150);
			$pparams->min_font = $this->params->get('min_font', 50);
			$pparams->default_fontsize = $this->params->get('default_fontsize', 76);
			$pparams->contrast = $this->params->get('contrast', 2);
			$pparams->contrast_classname = $this->params->get('contrast_classname', 'blackred');
			$pparams->decrease_key = $this->params->get('decrease_key', 'D');
			$pparams->increase_key = $this->params->get('increase_key', 'I');
			$pparams->contrast_key = $this->params->get('contrast_key', 'C');
			$pparams->reset_key = $this->params->get('reset_key', 'R');
			
			// Output JS APP nel Document
			$doc->addStyleSheet(JURI::root(true) . '/plugins/system/jefontsize/jefontsize/fontcontrols.css');
			$doc->addStyleSheet(JURI::root(true) . '/plugins/system/jefontsize/jefontsize/contrast.css');
			$doc->addScript(JURI::root(true) . '/plugins/system/jefontsize/jefontsize/languages/' . $langTag . '.js');
			$doc->addScript(JURI::root(true) . '/plugins/system/jefontsize/jefontsize/fontcontrols.js');
			 
			$doc->addScriptDeclaration(	"window.addEvent('domready', function(){ 
											new frControls({maxfont:$pparams->max_font, 
															minfont:$pparams->min_font,
															default_font:$pparams->default_fontsize,
															contrast_enabled:'$pparams->contrast',
															skin_contrast:'$pparams->contrast_classname',
															decrease_key:'$pparams->decrease_key',
															increase_key:'$pparams->increase_key',
															contrast_key:'$pparams->contrast_key',
															reset_key:'$pparams->reset_key'});
															});"); 
		}
	} 
}
