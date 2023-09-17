<?php
$defineWizard = function(string $extension,string $name, string $wizardCategory,string $icon, string $extCePath = 'EXT:plate_ces/Resources/Private/CEs/') {
    $lowercaseFoldername = strtolower($name);
    $plugin = 'tx_'.$extension.'_' .$lowercaseFoldername;
    $plugin_locallang_file='ll_'.$lowercaseFoldername.'.xlf';
    $plugin_incon_ident = $plugin .'icon';
    $plugin_icon_file=$icon;
//    if(str_contains($extension,'customer_theme')){
//        debug($extCePath);die;
//    }
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
                wizards.newContentElement.wizardItems.' .$wizardCategory .' {
                    elements {
                        ' .$plugin .' {
                            iconIdentifier = ' .$plugin_incon_ident .'
                            title = LLL:' .$extCePath .$name .'/Config/ll.xlf:wizard.title
                            description = LLL:' .$extCePath .$name .'/Config/ll.xlf:wizard.description
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
        ['source' => 'EXT:' .$extension .'/Resources/Public/CeIcons/' .$name .'.svg']
    );
};