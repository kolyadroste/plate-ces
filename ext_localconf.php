<?php

use AtomicPlan\PlateCes\Utility\TcaHelpers;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

call_user_func(function($defaultExtension = 'plate_ces', $configPath = '/Config/') {
    define('ATOMIC_PLATECES_PATH_PUBLIC', \TYPO3\CMS\Core\Core\Environment::getPublicPath());
    define('ATOMIC_PLATECES_PATH_ROOT', \TYPO3\CMS\Core\Core\Environment::getProjectPath());
    define('ATOMIC_PLATECES_PATH', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('plate_ces'));
    define('ATOMIC_PLATECES_EXTNAME', 'plate');
    define('ATOMIC_PLATECES_CES_PATH', 'Resources/Private/CEs/');
    // scan LayoutElement Folders


    // scan LayoutElement Folders
    $layoutElementsPath = ATOMIC_PLATECES_PATH .ATOMIC_PLATECES_CES_PATH;

    // locate all plate LayoutElementFolders (contentElements)
    $layoutElements = \AtomicPlan\PlateCes\Utility\TcaHelpers::getSubFolderNames($layoutElementsPath);
    define('ATOMIC_PLATECES_CES', $layoutElements);

    // add as typoscript constants as well
    $constants = [
        "PLATECES_CES_PATH_PUBLIC" => ATOMIC_PLATECES_PATH_PUBLIC,
        "PLATECES_CES_PATH_ROOT" => ATOMIC_PLATECES_PATH_ROOT,
        "PLATECES_CES_PATH" => ATOMIC_PLATECES_CES_PATH,
    ];

    $lines = [];
    foreach ($constants as $name => $value) {
        $lines[] = "$name=$value";
    }

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(implode(PHP_EOL, $lines));

    // include content elements localconf
    include(ATOMIC_PLATECES_PATH . 'Configuration/TCA/Utilities/DefinePluginHelper.php');

    // add typoscript
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
        "plate_ces",
        "setup",
        "@import 'EXT:plate_ces/Configuration/TypoScript/setup.typoscript'"
    );

    $customPath = GeneralUtility::makeInstance(ExtensionConfiguration::class)
        ->get('plate_ces', 'plateCesCustomPath');
    $overrideExtIsSet = TcaHelpers::checkIfOverrideExtIsInstalled($customPath);
    $overrideExt = TcaHelpers::getOverrideExtName($customPath);
    $absCustomPath = $overrideExtIsSet ? GeneralUtility::getFileAbsFileName($customPath) : '';
    // Merge with default CES
    $ces = array_unique(array_merge(ATOMIC_PLATECES_CES, \AtomicPlan\PlateCes\Utility\TcaHelpers::getSubFolderNames($absCustomPath)));
    // based on scanned Folders in LayoutElements add Plugin and Typoscript

    foreach($ces as $folderName){
        $lowercaseFoldername = strtolower($folderName);
        if(is_dir($absCustomPath . '/' . $folderName)){
            $extension = $overrideExt;
            $extCePath = $customPath;
            $absPath = $absCustomPath . $folderName;
        }else{
            $extension = $defaultExtension;
            $extCePath = 'EXT:plate_ces/Resources/Private/CEs/';
            $absPath = $extPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('plate_ces') . 'Resources/Private/CEs/' . $folderName;
        }

        $jsonData = file_get_contents($absPath .'/Config/config.json');
        $arrayData = json_decode($jsonData, true);  // `true` konvertiert es zu einem assoziativen Array
        $defineWizard($extension, $folderName, $arrayData['wizardCategory'] ? $arrayData['wizardCategory'] : 'common' , '', $extCePath);

        // add typoscript
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
            'tx_' .$extension .'_' .$lowercaseFoldername,
            "setup",
            "@import '" .$extCePath . $folderName .$configPath ."setup.typoscript'"
        );


    }

});