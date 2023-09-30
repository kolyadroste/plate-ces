<?php
defined('TYPO3') or die();

/*
 * plugin Field definitions
 * */

$plugin_showfields = '--palette--;;general,--palette--;;headers,
    --div--;Teaser,pi_flexform,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames';



// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types'][$plugin] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types'][$plugin],
    [
        'showitem' => $plugin_showfields,
        'columnsOverrides' => [
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
                        ]
                    ],
                ]
            ],
        ]
    ]);




