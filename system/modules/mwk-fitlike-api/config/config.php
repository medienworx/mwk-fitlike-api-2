<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Agentur medienworx
 *
 * @package mwk-fitlike-api
 * @author Christian Kienzl <christian.kienzl@medienworx.eu>
 * @author Peter Ongyert <peter.ongyert@medienworx.eu>
 * @link    http://www.medienworx.eu
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


array_insert($GLOBALS['BE_MOD'], 1, array('mwk' => array()));

/**
 * define Backend Modules
 */
$GLOBALS['BE_MOD']['mwk']['mwk-fitlike'] = array
(
    'tables'       => array('tl_mwk_fitlike_config'),
    'icon'         => 'system/modules/mwk-fitlike-api/assets/images/icon.jpg'
);

/**
 * define Frontend Modules
 */
$GLOBALS['FE_MOD']['mwk']['mwk-fitlike'] = 'ModuleMwkFitlikeAPI';