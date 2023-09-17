<?php

namespace AtomicPlan\FlexiblePagesExtended\Hooks;

use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FlexFormHook
{
    /**
     * @param array $dataStructure
     * @param array $identifier
     * @return array
     */
    public function parseDataStructureByIdentifierPostProcess(array $dataStructure, array $identifier): array
    {
        if ($identifier['type'] === 'tca' && $identifier['tableName'] === 'tt_content' && $identifier['dataStructureKey'] === '*,tx_flexiblepages_pagelist') {
            $file = Environment::getPublicPath() . '/typo3conf/ext/flexible_pages_extended/Configuration/FlexForms/Extended.xml';
            $content = file_get_contents($file);
            if ($content) {
                $dataStructure['sheets']['additional2'] = GeneralUtility::xml2array($content);
            }
        }
        return $dataStructure;
    }
}