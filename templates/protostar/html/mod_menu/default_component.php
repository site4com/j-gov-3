<?php
/**
* This file is part of
* Joomla! 2.5 FAP
* @package   JoomlaFAP
* @author    Alessandro Pasotti
* @copyright    Copyright (C) 2013 Alessandro Pasotti http://www.itopen.it
* @license      GNU/AGPL

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// No direct access.
defined('_JEXEC') or die;

// Access keys load

require_once dirname(__FILE__) . "/accesskey_helper.php";
$accesskeys = AccesskeyHelper::getAccessKeys();
$titles     = AccesskeyHelper::getTitles();

// Note. It is important to remove spaces between elements.
$accesskey_class    =   '';
if(@$accesskeys[$item->id]){
    $accesskey_class    .= ' c2gaccesskey ';
}

$class = $item->anchor_css ? 'class="'.$item->anchor_css . $accesskey_class.'" ' : 'class="' . $accesskey_class . '"';
$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
        $item->params->get('menu_text', 1 ) ?
        $linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
        $linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { $linktype = $item->title;
}



switch ($item->browserNav) :
    default:
    case 0:
?><a<?php if(@$titles[$item->id]){ echo ' title="' . htmlentities($titles[$item->id]) . '"'; } ?><?php if(@$accesskeys[$item->id]){ echo " accesskey=\"{$accesskeys[$item->id]}\""; } ?> <?php echo $class; ?> href="<?php echo $item->flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
        break;
    case 2:// window.open
    case 1:
        // _blank
?><a<?php if(@$titles[$item->id]){ echo ' title="' . htmlentities($titles[$item->id]) . '"';} ?><?php if(@$accesskeys[$item->id]){ echo " accesskey=\"{$accesskeys[$item->id]}\""; } ?> <?php echo $class; ?> href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
        break;
endswitch;
