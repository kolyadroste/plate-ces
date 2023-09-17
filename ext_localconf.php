<?php

use AtomicPlan\PlateCes\Utility\TcaHelpers;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

call_user_func(function($defaultExtension = 'plate_ces', $configPath = '/Config/') {
    //define('ATOMIC_PLATECES_PATH_PUBLIC', \TYPO3\CMS\Core\Core\Environment::getPublicPath());
    //define('ATOMIC_PLATECES_PATH_ROOT', \TYPO3\CMS\Core\Core\Environment::getProjectPath());
    //define('ATOMIC_PLATECES_PATH', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('plate_ces'));
    $extPath =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('plate_ces');
    //define('ATOMIC_PLATECES_CES_PATH', 'Resources/Private/CEs/');
    $cesPath = $extPath .'Resources/Private/CEs/';
    // locate all plate LayoutElementFolders (contentElements)
    $ces = \AtomicPlan\PlateCes\Utility\TcaHelpers::getSubFolderNames($cesPath);
    //define('ATOMIC_PLATECES_CES', $layoutElements);
    // include content elements localconf
    include($extPath . 'Configuration/TCA/Utilities/DefinePluginHelper.php');

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

    // Merge with defaultCES
    $collectedtCes = $absCustomPath ? array_unique(array_merge($ces, \AtomicPlan\PlateCes\Utility\TcaHelpers::getSubFolderNames($absCustomPath))) : $ces;
    // based on scanned Folders in LayoutElements add Plugin and Typoscript
    foreach($collectedtCes as $folderName){
        $lowercaseFoldername = strtolower($folderName);
        if(is_dir($absCustomPath . '/' . $folderName)){
            $extension = $overrideExt;
            $extCePath = $customPath;
            $absPath = $absCustomPath . $folderName;
        }else{
            $extension = $defaultExtension;
            $extCePath = 'EXT:plate_ces/Resources/Private/CEs/';
            $absPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('plate_ces') . 'Resources/Private/CEs/' . $folderName;
        }
        //debug($absPath);
        $filePath = $absPath .'/Config/config.json';
        if (file_exists($filePath)) {
            //debug($filePath);
            $jsonData = file_get_contents($filePath);
        } else {
            debug("Datei nicht gefunden: " . $filePath);
        }
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