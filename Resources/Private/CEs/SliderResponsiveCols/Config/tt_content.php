<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general, --palette--;;headers,
    --div--;Slides,image,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames';
$pp_additional_columns = [

];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $pp_additional_columns);

$newSysFileReferenceColumns = [
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
    'slidePalette', '');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference',
    'modifiedImageoverlayPalette', 'alternative,title,link,--linebreak--,crop');



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
                'richtextConfiguration' => 'bootstrap'
            ]
        ],
        'layout' => [
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Standard', ''],
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
                                    --div--;Text,bodytext,
                                    --palette--;;filePalette'
                        ],
                    ],
                    'columns' => [

                        'crop' => [
                            'config' => [
                                'cropVariants' => [
                                    'default' => [
                                        'title' => 'Desktop',
                                        'allowedAspectRatios' => [
                                            'default' => [
                                                'title' => 'Frei',
                                                'value' => 0
                                            ],
                                            'Quadratisch' => [
                                                'title' => 'Quadratisch',
                                                'value' => 1 / 1
                                            ],
                                        ],
                                    ],
                                    'specialMobile' => [
                                        'disabled' => true,
                                    ],

                                    'tablet' => [
                                        'title' => 'Tablet',
                                        'allowedAspectRatios' => [
                                            'default' => [
                                                'title' => 'Frei',
                                                'value' => 0
                                            ],
                                            'Quadratisch' => [
                                                'title' => 'Quadratisch',
                                                'value' => 1 / 1
                                            ],
                                        ],
                                    ],
                                    'mobile' => [
                                        'title' => 'Mobile Geräte',
                                        'allowedAspectRatios' => [
                                            'default' => [
                                                'title' => 'Frei',
                                                'value' => 0
                                            ],
                                            'Quadratisch' => [
                                                'title' => 'Quadratisch',
                                                'value' => 1 / 1
                                            ],
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




