<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use AtomicPlan\PlateCes\Utility\TcaHelpers;
use TYPO3\CMS\Core\Utility\RootlineUtility;
$GLOBALS['TCA']['tt_content']['types']['tx_plate_ces_imageslide']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['default']['title'] = 'asdasdasd';
(function ($defaultExtension = 'plate_ces', $cePath = 'Resources/Private/CEs/', $configPath = '/Config/') {

    $extPath = ExtensionManagementUtility::extPath('plate_ces');
    $cesPath = $extPath . $cePath;
    $ces = TcaHelpers::getSubFolderNames($cesPath);

    include_once($extPath . 'Configuration/TCA/Utilities/TcaFieldHelper.php');
    include_once($extPath . 'Configuration/TCA/Utilities/DefinePluginHelper.php');

    $customPath = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('plate_ces', 'plateCesCustomPath');
    $overrideExtIsSet = TcaHelpers::checkIfOverrideExtIsInstalled($customPath);
    $overrideExt = $overrideExtIsSet ? TcaHelpers::getOverrideExtName($customPath) : '';
    $absCustomPath = $overrideExtIsSet ? GeneralUtility::getFileAbsFileName($customPath) : '';

    $collectedCes = $absCustomPath ? array_unique(array_merge($ces, TcaHelpers::getSubFolderNames($absCustomPath))) : $ces;

    $requiredCeFiles = ['tt_content.php', 'll.xlf', 'setup.typoscript', 'config.json'];
    foreach ($collectedCes as $ce) {
        $currPath = is_dir($absCustomPath . $ce) ? $absCustomPath . $ce : $extPath . $cePath . $ce;
        $extension = is_dir($absCustomPath . $ce) ? $overrideExt : $defaultExtension;
        $extCePath = 'EXT:' . $extension .'/'. $cePath . $ce;
        if (!TcaHelpers::checkFilesExist($currPath . $configPath, $requiredCeFiles)) {
            throw new \Exception('Plate Ces - Override Path is set but files are missing for: ' . $extCePath, 1623159831);
        }

		$plugin = 'tx_plate_ces_' . strtolower($ce);
		$iconident = $extension .'-' . strtolower($ce);
		if (!is_array($GLOBALS['TCA']['tt_content']['types'][$plugin] ?? false)) {
			$GLOBALS['TCA']['tt_content']['types'][$plugin] = [];
		}

		try {
			include_once($currPath . $configPath . 'tt_content.php');

			$config = json_decode(file_get_contents($currPath . $configPath . 'config.json'), true);
		} catch (\Exception $e) {
			throw new \Exception('PlateCes - Error while including files for: ' . $extCePath . $configPath . ' ->' . $e, 1623159831);
		}


		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
			'tt_content',
			'CType',
			[
				// title
				'label' => 'LLL:' . $extCePath . $configPath . 'll.xlf:title',
				// plugin signature: extkey_identifier
				'value' => $plugin,
				// icon identifier
				'icon' => $iconident,
				// group
				'group' => $config['typeCategory'] ?? 'default',
			],
		);
		// Adds the content element icon to TCA typeicon_classes
		$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$plugin] = 'content-text2';


        if (file_exists($currPath . $configPath . 'flexform.xml')) {
            ExtensionManagementUtility::addPiFlexFormValue('*', 'FILE:' . $currPath .$configPath . 'flexform.xml', $plugin);
        }
    }
})();
