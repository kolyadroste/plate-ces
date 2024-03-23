<?php
use AtomicPlan\PlateCes\Utility\TcaHelpers;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$plateCesIcons = (function ($defaultExtension = 'plate_ces', $cePath = 'Resources/Private/CEs/', $configPath = '/Config/') {
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
	$iconArray = [];

	foreach ($collectedCes as $ce) {
		$currPath = is_dir($absCustomPath . $ce) ? $absCustomPath . $ce : $extPath . $cePath . $ce;
		$extension = is_dir($absCustomPath . $ce) ? $overrideExt : $defaultExtension;
		$extCePath = 'EXT:' . $extension . '/' . $cePath . $ce;
		if (!TcaHelpers::checkFilesExist($currPath . $configPath, $requiredCeFiles)) {
			throw new \Exception('Plate Ces - Override Path is set but files are missing for: ' . $extCePath, 1623159831);
		}

		$iconident = $extension .'-' . strtolower($ce);
		if (!array_key_exists($iconident, $iconArray)) {
			$iconArray[$iconident] = [
				'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				'source' => 'EXT:' . $extension . '/Resources/Public/CeIcons/' . $ce . '.svg'
			];
		}
	}

	return $iconArray;
})();
return $plateCesIcons;