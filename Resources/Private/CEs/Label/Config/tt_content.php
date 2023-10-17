<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('tt_content',
	'modifiedHeaders', 'header,--linebreak--,subheader,--linebreak--, tx_plate_ce_layout, header_position, date');

$plugin_showfields = '--palette--;;general,--palette--;;modifiedHeaders,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames';

$pp_additional_columns = [

];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $pp_additional_columns);


// Configure the default backend fields for the content element

// Add Content Element
$GLOBALS['TCA']['tt_content']['types'][$plugin] = [
	'showitem' => $plugin_showfields,
	'columnsOverrides' => [
		'header' => [
			'label' => 'Label header',
			'config' => [
				'type' => 'input',
			]
		],
		'tx_plate_ce_layout' => [
			'label' => 'Layout',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					[
						'label' => 'Standard',
						'value' => '',
					]
				],
			]
		],
		'header_position' => [
			'label' => 'Position',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					[
						'label' => 'Standard',
						'value' => '',
					],
					[
						'label' => 'Mittig',
						'value' => 'center',
					],
					[
						'label' => 'Rechts',
						'value' => 'end',
					],
					[
						'label' => 'Links',
						'value' => 'start',
					]
				],
			]
		],
	]
];








