<?php

if (version_compare(TYPO3_branch, '6.2.99', '>')) {
    call_user_func(
        function ($extKey, $table) {
            $extRelPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey);
            $customPageIcon = $extRelPath . 'Resources/Public/Icons/doktype_icon.svg';
            $archiveDoktype = \JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW;

            // Add new page type as possible select item:
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
                $table,
                'doktype',
                [
                    'LLL:EXT:js_bmi_calculator/Resources/Private/Language/locallang.xlf:pages.doktype',
                    $archiveDoktype,
                    $customPageIcon
                ],
                '254',
                'after'
            );

            // Add icon for new page type:
            \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
                $GLOBALS['TCA']['pages'],
                [
                    'ctrl' => [
                        'typeicon_classes' => [
                            $archiveDoktype => 'apps-pagetree-bmi',
                        ],
                    ],
                ]
            );
        },
        'js_bmi_calculator',
        'pages'
    );
}