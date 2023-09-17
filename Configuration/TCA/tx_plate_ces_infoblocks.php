<?php
return [
    'ctrl' => [
        'label' => 'text',
        'tstamp' => 'tstamp',
        'title' => 'Infoblock',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'sortby' => 'sorting',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'iconfile' => 'EXT:plate_ces/Resources/Public/CeIcons/InfoBlocks.svg',
    ],
    'interface' => [
        'showRecordFieldList' => 'title',
        'maxDBListItems' => 30,
        'maxSingleDBListItems' => 50,
    ],
    'columns' => [
        'hidden' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0,
            ],
        ],
        'header' => [
            'label' => 'Titel',
            'config' => [
                'type' => 'input',
            ],
        ],
        'layout' => [
            'label' => 'Aussehen',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Standard', 'default']
                ],
            ],
        ],
        'description' => [
            'label' => 'Text',
            'config' => [
                'type' => 'text',
                "enableRichtext" => true,
                "richtextConfiguration" => "default",
            ],
        ],

        'image' => [
            'label' => 'Bilder',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'Bild konfigurieren'
                ],
                'overrideChildTca' => [
                    'columns' => [
                        'crop' => [
                            'config' => [
                                'cropVariants' => [
                                    'default' => [
                                        'title' => 'Standard',
                                        'allowedAspectRatios' => [
                                            'default' => [
                                                'title' => 'Quadratisch',
                                                'value' => 1,
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],

                    'types' => [
                        '0' => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette'
                        ],
                    ],
                ],
            ], $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'])
        ],
        'tx_plate_ces_icon' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:bw_icons/Resources/Private/Language/locallang.xlf:icon',
            'config' => [
                'type' => 'input',
                'renderType' => 'iconSelection'
            ],
        ],
        'typolink' => [
            'label' => 'Link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    ]
                ]
            ]
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
            'l10n_mode' => 'exclude',
            'l10n_display' => 'defaultAsReadonly'
        ],
    ],

    'types' => [
        '0' => [
            'showitem' => '--palette--;;general,description,--palette--;;media,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
                --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --palette--;;hiddenLanguagePalette,',
        ],

    ],
    'palettes' => [
        'general' => [
            'label' => 'Text',
            'showitem' => 'header,hidden,layout,typolink',
        ],
        'media' => [
            'label' => 'Medien',
            'showitem' => 'image,tx_plate_ces_icon',
        ],
        'access' => [
            'showitem' => '
                starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel,
                endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel
            '
        ],
        'visibility' => [
            'showitem' => '
                hidden;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousel_item
            '
        ],
    ],
];
