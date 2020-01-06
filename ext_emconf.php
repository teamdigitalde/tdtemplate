<?php

/**
 * Extension Manager/Repository config file for ext "sitepackage".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'TDTemplate - Individuell',
    'description' => 'team digital Kickstart Sitepackage',
    'category' => 'templates',
    'constraints' => [
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'TeamDigital\\Tdtemplate\\' => 'Classes',
        ],
    ],
    'state' => 'experimental',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'team digital',
    'author_email' => 'info@team-digital.de',
    'author_company' => 'team digital GmbH',
    'version' => '1.0.0',
];
