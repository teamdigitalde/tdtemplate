<?php
defined('TYPO3_MODE') || die();

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['sitepackage'] = 'EXT:tdtemplate/Configuration/RTE/Default.yaml';

// Import Tasks
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'TeamDigital\\Tdtemplate\\Command\\UpdateCommandController';
