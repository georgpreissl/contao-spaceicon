<?php

/**
 * Space Icon
 * 
 * @copyright  Georg Preissl 2017
 * @package    spaceicon
 * @author     Georg Preissl <http://www.georg-preissl.at>
 * @license    LGPL
 */



/**
 * Backend Javascript
 */
if (TL_MODE == 'BE')
{
	$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/spaceicon/assets/js/main.js';
	$GLOBALS['TL_CSS'][] = 'system/modules/spaceicon/assets/css/style.css';
}


/**
 * Load Classes
 */
ClassLoader::addClasses(array
(
	'Contao\spaceIcon'            => 'system/modules/spaceicon/classes/spaceIcon.php'
));



$GLOBALS['TL_HOOKS']['executePreActions'][] = array('spaceIcon', 'executePreActions');
$GLOBALS['TL_HOOKS']['loadDataContainer'][] = array('spaceIcon', 'addSpaceIconDCA');




?>