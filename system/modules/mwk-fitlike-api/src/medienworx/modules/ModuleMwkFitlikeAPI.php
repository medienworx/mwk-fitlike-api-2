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
 * Class ModuleMwkFitlikeAPI
 * @package Contao
 */
class ModuleMwkFitlikeAPI extends \Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_mwk_fitlike_list';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        $this->import('String');
        $fitlikeConfigObj = \MwkFitlikeConfigModel::findFitlikeAPIConfig($this->FitlikeConfig);

        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['FitlikeConfig']);
            $objTemplate->title = $fitlikeConfigObj->fl_name;
            $objTemplate->id = $this->FitlikeConfig;
            $objTemplate->link = $fitlikeConfigObj->fl_name;
            $objTemplate->href = 'contao/main.php?do=mwk-fitlike&amp;table=tl_mwk_fitlike_config&amp;act=edit&amp;id=' . $this->FitlikeConfig;

            return $objTemplate->parse();
        }
        return parent::generate();
    }

    /**
     * start function
     */
    protected function compile()
    {
        $this->import('String');
        $fitlikeConfigObj = \MwkFitlikeConfigModel::findFitlikeAPIConfig($this->FitlikeConfig);

        $apiData = $this->getAPIData($fitlikeConfigObj);

        if(is_array($apiData->ERROR)){
            $this->log(json_encode($apiData->ERROR), 'ModuleMwkFitlikeAPI->compile()', 'ERROR');
            die();
        }

        // generate the starter list
        $starterList = array();
        if($apiData->ANZAHL > 0) {
            foreach ($apiData->STARTERLISTE as $starter) {
                $starterList[] = array(
                    'startnr' => ($fitlikeConfigObj->fl_show_startnr == 1) ? $starter->StartNr : '',
                    'firstname' => ($fitlikeConfigObj->fl_show_firstname == 1) ? $starter->Vorname : '',
                    'lastname' => ($fitlikeConfigObj->fl_show_lastname == 1) ? $starter->Nachname : '',
                    'nation' => ($fitlikeConfigObj->fl_show_nation == 1) ? $starter->Nation : '',
                    'gender' => ($fitlikeConfigObj->fl_show_gender == 1) ? $starter->Geschlecht : '',
                    'year' => ($fitlikeConfigObj->fl_show_year == 1) ? $starter->Jahrgang : '',
                    'club' => ($fitlikeConfigObj->fl_show_club == 1) ? $starter->Verein : '',
                    'team' => ($fitlikeConfigObj->fl_show_team == 1) ? $starter->Teamname : ''
                );
            }
        }

        // generate the competition list
        $bewerbList = array();
        if($apiData->BEWERBANZAHL > 0) {
            foreach ($apiData->BEWERBSLISTE as $bewerb) {
                $bewerbList[$bewerb->Bewerbnummer] = array(
                    'nr' => $bewerb->Bewerbnummer,
                    'competitionname' => $bewerb->Bewerbname,
                    'distance' => $bewerb->Distanz
                );
            }
            // add competition data
            $this->Template->competitionName = $bewerbList[$fitlikeConfigObj->fl_competition]['competitionname'];
            $this->Template->competitionNr = $bewerbList[$fitlikeConfigObj->fl_competition]['nr'];
            $this->Template->competitionDistance = $bewerbList[$fitlikeConfigObj->fl_competition]['distance'];
        }

        $this->Template->starterCnt = $apiData->ANZAHL;
        $this->Template->starterData = $starterList;
    }

    /**
     * get Data from fitlike API
     * @param $configData
     * @return mixed
     */
    private function getAPIData($configData)
    {
        $requestUrl = $configData->fl_url.'?key='.$configData->fl_api_key.'&bewerb='.$configData->fl_competition.'&sort='.$configData->fl_sorting;
        $responseData = @file_get_contents($requestUrl);
        return json_decode($responseData);
    }
}
