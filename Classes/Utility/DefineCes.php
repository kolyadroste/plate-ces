<?php

namespace AtomicPlan\PlateCes\Utility;

use AtomicPlan\PlateCes\Utility\TcaHelpers;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class DefineCes {
	private $defaultExtension;
	private $configPath;
	private $cesPaths = [];

	public function __construct($defaultExtension = 'plate_ces', $configPath = '/Config/') {
		$this->defaultExtension = $defaultExtension;
		$this->configPath = $configPath;
		$this->initializePaths();
	}

	private function initializePaths() {
		// Adding the default path
		$extPath = ExtensionManagementUtility::extPath($this->defaultExtension);
		$this->cesPaths[] = $extPath . 'Resources/Private/CEs/';

		// add default typoscript
		ExtensionManagementUtility::addTypoScript(
			'tx_plate_ces',
			"setup",
			"@import 'EXT:plate_ces/Configuration/TypoScript/setup.typoscript'"
		);

		// Adding custom paths
		for ($i = 1; $i <= 6; $i++) {
			$this->addCustomPath($i);
		}
	}

	public function initialize() {
		$this->initializePaths();
		$this->processCES();
	}

	private function addCustomPath($index) {
		$customPathConfigKey = 'plateCesCustomPath' . ($index > 1 ? $index : '');
		$customPath = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get($this->defaultExtension, $customPathConfigKey);

		if ($customPath && GeneralUtility::getFileAbsFileName($customPath)) {
			$this->cesPaths[] = GeneralUtility::getFileAbsFileName($customPath);
		}
	}

	private function processCES() {
		foreach ($this->cesPaths as $path) {
			$ces = TcaHelpers::getSubFolderNames($path);
			foreach ($ces as $ce) {
				$this->processFolder($ce, $path);
			}
		}
	}

	private function processFolder($folderName, $path) {
		$absPath = $path . $folderName;
		$filePath = $absPath . '/Config/config.json';

		if (file_exists($filePath)) {
			$jsonData = file_get_contents($filePath);
			$arrayData = json_decode($jsonData, true);
			$this->defineWizard($folderName, $arrayData ?? ["wizardCategory" => "common"], $path);

			// Typoscript from CE folders
			$this->addCeTs( $path, $folderName);
		} else {
			debug("Datei nicht gefunden: " . $filePath);
		}
	}
	private function addCeTs($extCePath, $folderName) {
		ExtensionManagementUtility::addTypoScript(
			'tx_plate_ces',
			"setup",
			"@import '" .$extCePath . $folderName .$this->configPath ."setup.typoscript'"
		);
	}
	private function defineWizard(string $name, array $wizardConf, string $path) {
		$lowercaseFoldername = strtolower($name);
		$plugin = 'tx_plate_ces_' . $lowercaseFoldername;
		$plugin_incon_ident = $plugin . 'icon';
		$wizardCategory = $wizardConf['wizardCategory'] ?? '';
		$wizardHeader = array_key_exists('header', $wizardConf) ? 'header = ' .$wizardConf['header'] : '';
		ExtensionManagementUtility::addPageTSConfig(
			"mod {
                wizards.newContentElement.wizardItems.{$wizardCategory} {
                    {$wizardHeader}
                    elements {
                        {$plugin} {
                            iconIdentifier = {$plugin_incon_ident}
                            title = LLL:{$path}{$name}/Config/ll.xlf:wizard.title
                            description = LLL:{$path}{$name}/Config/ll.xlf:wizard.description
                            tt_content_defValues {
                                CType = {$plugin}
                            }
                        }
                    }
                    show = *
                }
            }"
		);

		$iconRegistry = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		$iconRegistry->registerIcon(
			$plugin_incon_ident,
			\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
			['source' => "EXT:{$this->defaultExtension}/Resources/Public/CeIcons/{$name}.svg"]
		);
	}
}
