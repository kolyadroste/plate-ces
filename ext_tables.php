<?php

defined('TYPO3') or die();
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('@import "EXT:plate_ces/Configuration/TsConfig/page.tsconfig"');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig("@import 'EXT:plate_ces/Configuration/TsConfig/user.tsconfig'");

ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_plate_ces_infoblocks'
);

ExtensionManagementUtility::allowTableOnStandardPages(
    'tx_dpces_domain_model_carouselitem'
);

$GLOBALS['TCA']['tt_content']['types']['div']['columnsOverrides']['layout']['config']['default'] = 'vars-iverted';