<?php

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use AtomicPlan\PlateCes\Utility\TcaHelpers;

defined('TYPO3') or die();

call_user_func(function ($defaultExtension = 'plate_ces', $cePath = '/Resources/Private/CEs/', $configPath = '/Config/') {

    $extPath =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('plate_ces');
    $cesPath = $extPath .'Resources/Private/CEs/';
    $ces = \AtomicPlan\PlateCes\Utility\TcaHelpers::getSubFolderNames($cesPath);

    // todo: put helpers into a class
    include($extPath . 'Configuration/TCA/Utilities/TcaFieldHelper.php');
    include($extPath . 'Configuration/TCA/Utilities/DefinePluginHelper.php');

    /* plugin Configuration */
    $layoutElementsPath = $extPath . $cePath;

    // Get the custom path from extension configuration
    $customPath = GeneralUtility::makeInstance(ExtensionConfiguration::class)
        ->get('plate_ces', 'plateCesCustomPath');
    $overrideExtIsSet = TcaHelpers::checkIfOverrideExtIsInstalled($customPath);
    $overrideExt = TcaHelpers::getOverrideExtName($customPath);
    $absCustomPath = $overrideExtIsSet ? GeneralUtility::getFileAbsFileName($customPath) : '';


    // Merge with default CES
    $collectedCes = $absCustomPath ? array_unique(array_merge($ces, \AtomicPlan\PlateCes\Utility\TcaHelpers::getSubFolderNames($absCustomPath))) : $ces;

    $requiredCeFiles = [
        'tt_content.php',
        'll.xlf',
        'setup.typoscript',
        'config.json',
    ];

    foreach ($collectedCes as $ce) {
        // check if override Path exists and if the required files are there
        if(is_dir($absCustomPath . $ce)){
            $currPath = $absCustomPath . $ce;
            $extension = $overrideExt;
            $extCePath = $absCustomPath . $ce;
        }else{
            $extension = $defaultExtension;
            $extCePath = 'EXT:' .$extension .$cePath .$ce;
            $currPath = $extPath . $cePath .$ce;
        }

        if(!TcaHelpers::checkFilesExist($currPath .$configPath , $requiredCeFiles)){
            throw new \Exception('Plate Ces - Override Path is set but files are missing for: ' .$ce, 1623159831);
        }

        $plugin = 'tx_plate_ces_' . strtolower($ce);
        include($currPath . $configPath . 'tt_content.php');
        if (file_exists($currPath. $configPath . 'flexform.xml')) {
            if($ce == "PageTeaser"){
                //debug($extCePath.$configPath);die;
            }
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
                '*',
                'FILE:' . $extCePath . $configPath . 'flexform.xml',
                'tx_plate_ces_' . strtolower($ce)
            );
        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
            array(
                'LLL:' .$extCePath. $configPath . 'll.xlf:title',
                $plugin,
                'EXT:' .$extension .'/Resources/Public/CeIcons/' .$ce .'.svg'
            ),
            'CType',
            $plugin
        );
    }
});
