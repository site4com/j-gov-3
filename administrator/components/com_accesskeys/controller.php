<?php
/**
* This file is part of Joomla! 2.5 FAP
* @package      JoomlaFAP
* @copyright    Copyright (C) 2008-2013 Alessandro Pasotti http://www.itopen.it
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

// Impedisce l'accesso diretto al file
defined( '_JEXEC' ) or die( 'Restricted access' );

class AccesskeysController extends JControllerLegacy 
{

     function display($cachable = false, $urlparams = false) {
            parent::display($cachable, $urlparams);
            return $this;
     }
}