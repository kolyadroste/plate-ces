<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general,--palette--;;headers,
    --div--;Karte,pi_flexform,
    --div--;Text,bodytext,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
        --div--;Navigation,tx_pl_lces_contentlinks_add_to_nav,pl_lces_nav_title';

$pp_additional_columns = [
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $pp_additional_columns);


// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types'][$plugin] = array_replace_recursive(
	$GLOBALS['TCA']['tt_content']['types'][$plugin],
	[
		'showitem' => $plugin_showfields,
		'columnsOverrides' => [
			'header' => [
				'label' => 'Bezeichner (Nur für das Typo3 Backend)'
			],
			'bodytext' => [
				'config' => [
					'enableRichtext' => true,
					'richtextConfiguration' => 'bootstrap'
				]
			],
		]
	]
);




