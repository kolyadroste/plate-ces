<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general,--palette--;;headers,
    --div--;Bild,image,
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
			'image' => [
            'config' => [
                'maxitems' => 15,
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                                    title,
                                    --palette--;;filePalette'
                        ]
                    ],
                    'columns' => [
                        'crop' => [
                            'config' => [
                                'cropVariants' => [
                                    'default' => [
                                        'disabled' => true,
                                    ],
                                    'specialMobile' => [
                                        'disabled' => true,
                                    ],

                                    'desktop' => [
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
                                    'Mobile' => [
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




