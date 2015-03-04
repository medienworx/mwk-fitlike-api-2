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
 * Run in a custom namespace, so the class can be replaced
 */
namespace medienworx;

/**
 * Class MwkBxSliderModel
 * @package Mwk
 */
class MwkFitlikeConfigModel extends \Model
{

    /**
     * @var string
     */
    protected static $strTable = 'tl_mwk_fitlike_config';

    /**
     * @param $id
     * @return mixed
     */
    public static function findFitlikeAPIConfig ($id)
    {
        $table = static::$strTable;
        $arrColumns = array("($table.id=?)");
        return static::findBy($arrColumns, array($id));
    }

}