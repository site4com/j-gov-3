<?php
/**
* This is the plugin file 
* @package      C2GAccesskey
* @copyright    Copyright (C) 2013 Nguyen Van Hiep http://www.site4com.net
* @license      GNU/AGPL
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Joomla! jFap plugin
 *
 * @package     jFap
 * @subpackage  System
 */
class  plgSystemC2gaccesskey extends JPlugin
{
    function onBeforeRender(){ 
        $mainframe = JFactory::getApplication();
        if ($mainframe->isAdmin()){
            return true;
        }
        $document = JFactory::getDocument();
        $document->addScript(JURI::base(true) . '/media/jui/js/jquery.min.js');
        $document->addScript(JURI::base(true) . '/media/jui/js/jquery-noconflict.js');
        $document->addScript(JURI::base(true) . '/plugins/system/c2gaccesskey/assets/jquery.hotkeys.js');
        $document->addScript(JURI::base(true) . '/plugins/system/c2gaccesskey/assets/c2gaccesskey.js');
    }

}
