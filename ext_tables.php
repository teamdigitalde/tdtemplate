<?php
defined('TYPO3_MODE') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:tdtemplate/Configuration/PageTS/page.ts">'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_sitepackage_domain_model_anchor');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'TeamDigital.tdtemplate',
    'Configuration/TypoScript',
    'tdtemplate'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'TeamDigital.tdtemplate',
    'Configuration/TypoScript',
    'tdtemplate'
);

$GLOBALS['TCA']['pages']['columns']['slug']['config']['generatorOptions']['fields'][0] = 'nav_title,title';
