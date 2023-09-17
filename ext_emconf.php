<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Plate Ces',
    'description' => 'Plate Ces - Provide a set of contentelements',
    'category' => 'fe',
    'version' => '1.0.0',
    'state' => 'stable',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearcacheonload' => true,
    'author' => 'Kolya von Droste zu Vischering',
    'author_email' => 'jasker@dipool-web.de',
    'author_company' => 'AtomicPlan',
    'constraints' => [
        'depends' => [
            'typo3' => '11.0.0-11.5.99',
            'plate_cedefaults' => '1.0.0-1.99',
            'menus' => '0.3.0-0.3.99',
        ]
    ]
];
