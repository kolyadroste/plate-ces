<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$pl_ces_additional_columns = [
	'tx_plate_ces_input1' => [
		'exclude' => true,
		'label' => 'Header',
		'config' => [
			'type' => 'input',
		]
	],
	'tx_plate_ces_check1' => [
		'exclude' => true,
		'label' => 'Seitentitel anzeigen?',
		'config' => [
			'type' => 'check',
		]
	],
	'tx_plate_ces_check2' => [
		'exclude' => true,
		'label' => 'Seitenbeschreibung anzeigen?',
		'config' => [
			'type' => 'check',
		]
	],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $pl_ces_additional_columns);

$plugin_showfields = '--palette--;;general,--palette--;;headers,
    --div--;Bild,image,imagewidth,imageorient,
    --div--;Text, tx_plate_ces_input1, bodytext,
    --div--;Einstellungen,tx_plate_ces_check1,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
    --div--;Navigation,tx_pl_lces_contentlinks_add_to_nav,pl_lces_nav_title';


$newSysFileReferenceColumns = [
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $newSysFileReferenceColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference',
	'imageSlidePalette', 'alternative, title');

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types'][$plugin] = array_replace_recursive(
	$GLOBALS['TCA']['tt_content']['types'][$plugin],
	[
		'showitem' => $plugin_showfields,
		'columnsOverrides' => [
			'header' => [
				'label' => 'Bezeichner (Nur für das Typo3 Backend)'
			],
			'imagewidth' => [
				'description' => 'Um die Responsivität zu gewährleisten, werden Bilder bei kleineren Bildschirmen automatisch skaliert.'
			],
			'bodytext' => [
				'config' => [
					'enableRichtext' => true,
					'richtextConfiguration' => 'bootstrap'
				]
			],
			'image' => [
				'config' => [
					'maxitems' => 15,
					'overrideChildTca' => [
						'types' => [
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;Optionen;imageSlidePalette,
									crop,
									--palette--;;filePalette'
							],
						],
						'columns' => [
							'crop' => [
								'config' => [
									'cropVariants' => [
										'specialMobile' => [
											'disabled' => true,
										],

										'default' => [
											'title' => 'Desktop',
											'allowedAspectRatios' => [
												'' => [
													'title' => 'Wide-Panorama',
													'value' => 4 / 1
												],
												'3:1' => [
													'title' => '3 zu 1',
													'value' => 3.2 / 1
												],
												'2:1' => [
													'title' => '2 zu 1',
													'value' => 2 / 1
												],
												'default' => [
													'title' => 'Frei',
													'value' => 0
												]
											],
										],
										'tablet' => [
											'title' => 'Tablet',
											'allowedAspectRatios' => [
												'3:1' => [
													'title' => 'Panorama',
													'value' => 2.8 / 1
												],
												'2:1' => [
													'title' => '3 zu 2',
													'value' => 3 / 2
												],
												'default' => [
													'title' => 'Frei',
													'value' => 0
												]
											],
										],
										'mobile' => [
											'title' => 'Mobile Geräte',
											'allowedAspectRatios' => [
												'2:1' => [
													'title' => 'Mobile',
													'value' => 2 / 1
												],
												'1:1' => [
													'title' => 'Quadratisch',
													'value' => 0
												],
												'default' => [
													'title' => 'Frei',
													'value' => 0
												]
											],
										],
									],
								],
							],
						]
					]
				]
			]
		]
	]
);

