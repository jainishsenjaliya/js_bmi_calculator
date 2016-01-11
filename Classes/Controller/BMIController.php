<?php
namespace JS\JsBmiCalculator\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Jainish Senjaliya <jainishsenjaliya@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * BMIController
 */
class BMIController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * bMIRepository
	 *
	 * @var \JS\JsBmiCalculator\Domain\Repository\BMIRepository
	 * @inject
	 */
	protected $bMIRepository = NULL;

	/**
	 * bMIService
	 *
	 * @var \JS\JsBmiCalculator\Service\BMIService
	 * @inject
	 */
	protected $bMIService = NULL;

	/**
	 * action bmi
	 *
	 * @return void
	 */
	public function bmiAction() {

		$GLOBALS['TSFE']->set_no_cache();

		$template = 1;

		$result = array('value' => array('height' => '', 'weight' => ''));

		$this->settings['fullURL'] = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL');
		$this->settings['cObject'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('tslib_cObj');
		
		// Configuration
		$template = $this->bMIService->missingConfiguration($this->settings);
		
		if ($this->request->hasArgument('calculate')) {
			$post = $this->request->getArguments();
			$result = $this->bMIService->getBMICalculation($post, $this->settings);
		}
		
		$this->view->assign('template', $template);
		$this->view->assign('result', $result);
		$this->view->assign('settings', $this->settings);
		
		// Include Additional Data
		$this->bMIService->includeAdditionalData($this->settings);
	}

}