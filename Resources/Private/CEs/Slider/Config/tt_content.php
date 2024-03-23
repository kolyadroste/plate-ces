<?php
defined('TYPO3') or die('Access denied.');

/*
 * plugin Field definitions
 * */
$plugin_showfields = '--palette--;;general, --palette--;;headers,
    --div--;Slides,layout,image,
    --div--;Einstellungen,pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
        --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
    	--palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
        --div--;Navigation,tx_pl_lces_contentlinks_add_to_nav,pl_lces_nav_title,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended';

$newSysFileReferenceColumns = [
    'tx_plate_ces_check1' => [
        'exclude' => true,
        'label' => 'Text anzeigen',
        'config' => [
            'type' => 'check',
            'default' => 1,
        ]
    ],
    'tx_plate_ces_check2' => [
        'exclude' => true,
        'label' => 'Titel anzeigen',
        'config' => [
            'type' => 'check',
            'default' => 1,
        ]
    ],
    'tx_plate_ces_select2' => [
        'exclude' => true,
        'label' => 'Filter',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Globale Auswahl', ''],
                ['Dunkler', 'darken'],
            ],
        ]
    ],
    'tx_plate_ces_select3' => [
        'exclude' => true,
        'label' => 'Überschrift Typ',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Standard', ''],
                ['H1', 'h1'],
                ['H2', 'h2'],
                ['H3', 'h3'],
                ['H4', 'h4'],
                ['H5', 'h5'],
            ],
        ]
    ],
    'tx_plate_ces_select4' => [
        'exclude' => true,
        'label' => 'Überschrift Layout',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Globale Einstellung', ''],
                ['H1', '.h1'],
                ['H2', '.h2'],
                ['H3', '.h3'],
                ['H4', '.h4'],
                ['H5', '.h5'],
            ],
        ]
    ],
    'tx_plate_ces_blur' => [
        'exclude' => true,
        'label' => 'Bild unscharf',
        'config' => [
            'type' => 'check',
            'default' => 0,
        ]
    ],
    'tx_plate_ces_select1' => [
        'exclude' => true,
        'label' => 'Text Layout',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['Globale Auswahl', ''],
                ['Zentriert mitte', 'as-center-center'],
                ['Zentriert oben', 'as-center-top'],
                ['Zentriert unten', 'as-center-bottom'],
                ['Links', 'as-left.bottom'],
                ['Links mitte', 'as-left-center'],
                ['Links oben', 'as-left-top'],
                ['Rechts unten', 'as-right-bottom'],
                ['Rechts mitte', 'as-right-center'],
                ['Rechts oben', 'as-right-top'],
                ['Links mitte auf Hintergrund', 'as-bg as-left-center'],
            ],
        ]
    ],
    'bodytext' => [
        'exclude' => true,
        'label' => 'Beschreibung',
        'config' => [
            'type' => 'text',
            'enableRichtext' => true,
            'richtextConfiguration' => 'bootstrap',
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $newSysFileReferenceColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference',
    'slidePalette', 'tx_plate_ces_check1,tx_plate_ces_check2,tx_plate_ces_select2,--linebreak--, tx_plate_ces_select3, tx_plate_ces_select4, tx_plate_ces_blur,--linebreak--,tx_plate_ces_select1');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference',
    'modifiedImageoverlayPalette', 'alternative,title,link,--linebreak--,crop');


// Add Content Element
if (!is_array($GLOBALS['TCA']['tt_content']['types'][$plugin] ?? false)) {
    $GLOBALS['TCA']['tt_content']['types'][$plugin] = [];
}
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
			'layout' => [
				'exclude' => true,
				'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.layout',
				'config' => [
					'type' => 'select',
					'renderType' => 'selectSingle',
					'items' => [
						[
							'label' => 'Standard',
							'value' => '',
						],
						[
							'label' => 'Zentriert',
							'value' => 'as-center-center',
						],
						[
							'label' => 'Zentriert oben',
							'value' => 'as-center-top',
						],
						[
							'label' => 'Zentriert unten',
							'value' => 'as-center-bottom',
						],
						[
							'label' => 'Links unten',
							'value' => 'as-left-bottom',
						],
						[
							'label' => 'Links mitte',
							'value' => 'as-left-center',
						],
						[
							'label' => 'Links oben',
							'value' => 'as-left-top',
						],
						[
							'label' => 'Rechts unten',
							'value' => 'as-right-bottom',
						],
						[
							'label' => 'Rechts mitte',
							'value' => 'as-right-center',
						],
						[
							'label' => 'Rechts oben',
							'value' => 'as-right-top',
						],
					],
				]
			],
			'image' => [
				'label' => 'Bild',
				'config' => [
					'maxitems' => 15,
					'overrideChildTca' => [
						'types' => [
							\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
								'showitem' => '
									--palette--;;modifiedImageoverlayPalette,
									--div--;Text,bodytext,
									--div--;Einstellungen,--palette--;;slidePalette,
									--palette--;;filePalette'
							],
						],
						'columns' => [
							'crop' => [
								'config' =>[
									'cropVariants' => [
										'default' => [
											'title' => 'Desktop',
											'allowedAspectRatios' => [
												'3:1' => [
													'title' => 'Wide-Panorama',
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
										'specialMobile' => [
											'disabled' => true,
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
												'default' => [
													'title' => 'Mobile',
													'value' => 1 / 1.3
												],
												'1:1' => [
													'title' => 'Quadratisch',
													'value' => 1 / 1
												],
												'frei' => [
													'title' => 'Frei',
													'value' => 0
												]
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
	]
);

