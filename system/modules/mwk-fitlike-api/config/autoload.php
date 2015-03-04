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


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'medienworx',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(
    array(
        // Models
        'medienworx\MwkFitlikeConfigModel'       => 'system/modules/mwk-fitlike-api/src/medienworx/models/MwkFitlikeConfigModel.php',
        'medienworx\MwkCC'                       => 'system/modules/mwk-fitlike-api/src/medienworx/models/MwkCC.php',

        // Modules
        'medienworx\ModuleMwkFitlikeAPI'         => 'system/modules/mwk-fitlike-api/src/medienworx/modules/ModuleMwkFitlikeAPI.php'
    )
);

/**
 * Register the templates
 */
TemplateLoader::addFiles(
    array(
        'mod_mwk_fitlike_list'               => 'system/modules/mwk-fitlike-api/templates/'
    )
);

