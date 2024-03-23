<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general,--palette--;;headers,
    --div--;Bild,image,imageorient,
    --div--;Text,bodytext,
    --div--;Einstellungen,pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
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
							'label' => 'Zentriert',
							'value' => 'text-center',
						],
						[
							'label' => 'Ausrichtung Inhalte',
							'value' => 'default',
						]
					],
				]
			],
			'image' => [
            'config' => [
                'maxitems' => 15,
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                                    --palette--;;modifiedImageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                    ],
                    'columns' => [
                        'crop' => [
                            'config' => [
                                'cropVariants' => [
                                    'default' => [
                                        'disabled' => true,
                                    ],
                                    'desktop' => [
                                        'title' => 'Desktop',
                                        'allowedAspectRatios' => [
                                            '2:1' => [
                                                'title' => '2 zu 1',
                                                'value' => 2 / 1
                                            ],
                                            '3:1' => [
                                                'title' => 'Wide-Panorama',
                                                'value' => 3.2 / 1
                                            ],
                                            '1,4:1' => [
                                                'title' => '1.4 zu 1',
                                                'value' => 1.4 / 1
                                            ],
                                            '1,2:1' => [
                                                'title' => '1.2 zu 1',
                                                'value' => 1.2 / 1
                                            ],
                                            '1:1' => [
                                                'title' => '1 zu 1',
                                                'value' => 1 / 1
                                            ],
                                            '1:1.2' => [
                                                'title' => '1 zu 1.2',
                                                'value' => 1 / 1.2
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
                                            '1.4:1' => [
                                                'title' => '1.4 zu 1',
                                                'value' => 1.4 / 1
                                            ],
                                            '1.2:1' => [
                                                'title' => '1.2 zu 1',
                                                'value' => 1.2 / 1
                                            ],
                                            '1:1' => [
                                                'title' => '1 zu 1',
                                                'value' => 1 / 1
                                            ],
                                            '1:1.2' => [
                                                'title' => '1 zu 1.2',
                                                'value' => 1 / 1.2
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
                                            '1.2:1' => [
                                                'title' => '1.2 zu 1',
                                                'value' => 1.2 / 1
                                            ],
                                            '1:1' => [
                                                'title' => '1 zu 1',
                                                'value' => 1 / 1
                                            ],
                                            '1:1.2' => [
                                                'title' => '1 zu 1.2',
                                                'value' => 1 / 1.2
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




