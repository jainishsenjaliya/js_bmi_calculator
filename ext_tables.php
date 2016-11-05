<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'JS.' . $_EXTKEY,
	'Bmi',
	'BMI'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'BMI Calculator');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jsbmicalculator_domain_model_bmi', 'EXT:js_bmi_calculator/Resources/Private/Language/locallang_csh_tx_jsbmicalculator_domain_model_bmi.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jsbmicalculator_domain_model_bmi');

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

require_once( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Classes/Utility/Hook/hook.php');

if (version_compare(TYPO3_branch, '6.2.99', '>')) {
	call_user_func(
		function ($_EXTKEY) {
			$archiveDoktype = \JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW;

			// Add new page type:
			$GLOBALS['PAGES_TYPES'][$archiveDoktype] = [
				'type' => 'web',
				'allowedTables' => '*',
			];

			// Provide icon for page tree, list view, ... :
			\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class)
				->registerIcon(
					'apps-pagetree-bmi',
					TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
					[
						'source' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/doktype_icon.svg',
					]
				);

			// Allow backend users to drag and drop the new page type:
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
				'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $archiveDoktype . ')'
			);
		},
		'js_bmi_calculator'
	);

}else{

	$doktypeIcon = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('js_bmi_calculator') . 'Resources/Public/Icons/doktype_icon.png';

	$GLOBALS['PAGES_TYPES'][\JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW] = array(
		'type' => 'web',
		'icon' => $doktypeIcon,
		'allowedTables' => '*'
	);

	$GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = array('LLL:EXT:js_bmi_calculator/Resources/Private/Language/locallang.xlf:pages.doktype',
		\JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW,
		$doktypeIcon
	);

	$GLOBALS['TCA']['pages_language_overlay']['columns']['doktype']['config']['items'][] = array('LLL:EXT:js_bmi_calculator/Resources/Private/Language/locallang.xlf:pages.doktype',
		\JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW,
		$doktypeIcon
	);


	\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon('pages', \JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW, $doktypeIcon);

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig(
		'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . \JS\JsBmiCalculator\Controller\PageControllerInterface::DOKTYPE_RAW . ')'
	);

	if (TYPO3_MODE == 'BE') {
		$icon = 'BMI';
		$label = 'LLL:EXT:js_bmi_calculator/Resources/Private/Language/locallang.xlf:pages.doktype';
		\TYPO3\CMS\Backend\Sprite\SpriteManager::addTcaTypeIcon('pages', 'contains-' . $icon, $doktypeIcon);
		$TCA['pages']['columns']['module']['config']['items'][] = array(ucfirst($label), $icon, $doktypeIcon);
	}
}