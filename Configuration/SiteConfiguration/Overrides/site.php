<?php

call_user_func(function(){
    // extend site config
    $GLOBALS['SiteConfiguration']['site']['columns']['overridePlateCesPath'] = [
        'label' => 'Override PlateCesPath (default is configured in tsconfig)',
        'config' => [
            'type' => 'input',
            'default' => '',
        ],
    ];

    // Config
    $GLOBALS['SiteConfiguration']['site']['types']['0']['showitem'] .= ",--div--;PlateCes,overridePlateCesPath";

});
