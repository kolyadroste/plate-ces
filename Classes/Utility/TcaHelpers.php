<?php
declare(strict_types=1);
namespace AtomicPlan\PlateCes\Utility;

/**
 * @package Plate
 * @subpackage Utility
 */
class TcaHelpers{

    /**
     * @param $path
     * @return array
     */
    public static function getSubFolderNames($path): array{
        $folders = [];
        $directories = glob($path . '/*', GLOB_ONLYDIR);
        foreach($directories as $dir){
            $parts = explode('/', $dir);
            $name = end($parts);
            array_push($folders, $name );
        }
        return $folders;
    }

    /**
     * @param string $extension
     * @param string $name
     * @param string $wizardCategory
     * @param string $icon
     */
    public static function definePlugin(string $extension,string $name, string $wizardCategory,string $icon): array{
        $lowercaseFoldername = strtolower($name);
        $plugin = 'tx_'.$extension.'_' .$lowercaseFoldername;
        $plugin_locallang_file='ll_'.$lowercaseFoldername.'.xlf';
        $plugin_incon_ident = $plugin .'icon';
        $plugin_icon_file=$icon;

        $php = <<<PHP
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.' .$wizardCategory .' {
                    elements {
                        ' .$plugin .' {
                            iconIdentifier = ' .$plugin_incon_ident .'
                            title = LLL:EXT:'.$extension.'/Resources/Private/Language/'.$plugin_locallang_file .':wizard.title
                            description = LLL:EXT:'.$extension.'/Resources/Private/Language/'.$plugin_locallang_file .':wizard.description
                            tt_content_defValues {
                                CType = '.$plugin .'
                            }
                        }
                    }
                    show = *
                }
            }'
        );
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
        $iconRegistry->registerIcon(
            $plugin_incon_ident,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:'.$extension.'/Resources/Public/Icons/'.$name .'.svg']
        );
        PHP;
        return $php;
    }



    /**
     * @param $customPath
     * @return bool
     * Check if the CE Override Extension is loaded
     */
    public static function checkIfOverrideExtIsInstalled($customPath = ''): bool
    {
        if($customPath === ''){
            return false;
        }
        $parts = explode('/', $customPath);
        $extensionNameWithPrefix = $parts[0];
        $extensionName = str_replace('EXT:', '', $extensionNameWithPrefix);

        return \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded($extensionName);
    }


    /**
     * @param $customPath
     * @return bool
     * Check if the CE Override Extension is loaded
     */
    public static function getOverrideExtName($customPath = ''): string
    {
        if($customPath === ''){
            return '';
        }
        $parts = explode('/', $customPath);
        $extensionNameWithPrefix = $parts[0];
        $extensionName = str_replace('EXT:', '', $extensionNameWithPrefix);

        return $extensionName;
    }


    /**
     * @param $name
     * @param $path
     * @param $overridePath
     * @return string
     * returns the path to the CE
     */

    public static function getCePath($name, $path = '', $overridePath = ''): string
    {
        // throw exception if values missing
        if($name === '' || $path === ''){
            throw new \Exception('Plate CEs - Missing params for getCePath', 1622625721);
        }
        return 'EXT:plate_ces/Resources/Private/CEs/' . $name . '/Config/';
    }

    public static function checkFilesExist($path, $files): bool
    {
        foreach($files as $file){
            if(!file_exists($path . $file)){
                return false;
            }
        }
        return true;
    }

}