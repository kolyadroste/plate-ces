<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general,inline_1,--palette--;;headers,
    --div--;Bloecke,tx_plate_ces_infoblocks,
    --div--;Einstellungen,pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
        --div--;Navigation,tx_pl_lces_contentlinks_add_to_nav,pl_lces_nav_title';

$pp_additional_columns = [
	'tx_plate_ces_infoblocks' => [
		'exclude' => 1,
		'label' => 'Info Blöcke',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_plate_ces_infoblocks',
			'foreign_field' => 'parentid',
			'foreign_table_field' => 'parenttable',
			'foreign_label' => 'header',
			'foreign_sortby' => 'sorting',
			'maxitems' => 30,
			'appearance' => [
				'collapseAll' => 1,
				'expandSingle' => 1,
			],
		],
	]
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
			'layout' => [
				'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
						[
							'label' => 'Standard',
							'value' => '',
						],
						[
							'label' => 'Mit Rahmen',
							'value' => 'bordered',
						]
					],
				]
			],
			'bodytext' => [
				'config' => [
					'enableRichtext' => true,
					'richtextConfiguration' => 'bootstrap'
				]
			],
			'tx_plate_ces_infoblocks' => [
				'config' => [
					'overrideChildTca' => [
						'types' => [
							'0' => [
								'showitem' => '--palette--;;general,description,tx_plate_ces_icon,
								--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.media,,--palette--;;media,
								--div--;Countup,countupval,countupunit,countupprecision,
								--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
								--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
								--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
								--palette--;;hiddenLanguagePalette,',
							],

						],
					]
				]
			],
		]
	]
);




