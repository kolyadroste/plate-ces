<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general,--palette--;;headers,
    --div--;Teaser,pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames';

$pp_additional_columns = [

];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $pp_additional_columns);


// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types'][$plugin] = [
    'showitem' => $plugin_showfields,
    'columnsOverrides' => [
        'header' => [
            'label' => 'Bezeichner (Nur für das Typo3 Backend)'
        ],
        'bodytext' => [
            'config' => [
                'enableRichtext' => true,
                'richtextConfiguration' => 'default'
            ]
        ],
        'tx_plate_ce_layout' => [
            'exclude' => true,
            'label' => 'Modus',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Automatische Hoehe', 0],
                    ['Volle Höhe', 1],
                ],
                'default' => 0
            ]
        ],
        'tx_plate_ce_check1' => [
            'exclude' => true,
            'label' => 'Punktnavigation deaktivieren',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'image' => [
            'config' => [
                'maxitems' => 15,
                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => [
                            'showitem' => '
                                    --palette--;Optionen;slidePalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                                    --palette--;Optionen;slidePalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                                    --palette--;Optionen;slidePalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                                    --palette--;Optionen;slidePalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                                    --palette--;Optionen;slidePalette,
                                    --palette--;;imageoverlayPalette,
                                    --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                                    --palette--;Optionen;slidePalette,
                                    --palette--;;imageoverlayPalette,
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
];




