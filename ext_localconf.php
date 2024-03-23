<?php

use AtomicPlan\PlateCes\Utility\DefineCes;

defined('TYPO3') or die();

call_user_func(function ($defaultExtension = 'plate_ces', $configPath = '/Config/') {
	$cesLoader = new DefineCes($defaultExtension, $configPath);
	$cesLoader->initialize();
});
