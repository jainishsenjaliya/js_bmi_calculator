<?php
namespace JS\JsBmiCalculator\Service;

/*
 *  (c) 2015 Jainish Senjaliya <jainishsenjaliya@gmail.com>
 *  Jainish Senjaliya <jainishsenjaliya@gmail.com>
*/

class BMIService implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * bMIRepository
	 *
	 * @var \JS\JsBmiCalculator\Domain\Repository\BMIRepository
	 * @inject
	 */
	protected $bMIRepository = NULL;
	
	/**
	 * missingConfiguration
	 *
	 * @param $settings
	 * @return
	 */
	function missingConfiguration($settings)
	{
		if($settings['configuration']!=1){
			return 'include_template';
		}
		
		return 1;
	}

	/**
	 * getBMICalculation
	 *
	 * @param $data
	 * @param $settings
	 * @return
	 */
	function getBMICalculation($data, $settings)
	{

		$underweight	= $this->getTrim($settings['flexform']['underweight']); 
		$normalweight	= $this->getTrim($settings['flexform']['normalweight']); 
		$overweight		= $this->getTrim($settings['flexform']['overweight']); 
		$obesity		= $this->getTrim($settings['flexform']['obesity']);

		$height = $this->getTrim($data['height']);
		$weight = $this->getTrim($data['weight']);

		$value = array("height" => $height, "weight" => $weight);

		$success = 0;

		$error = array();

		if($height!='' && $weight!=''){

			//BMI = ( Weight in Kilograms / ( Height in Meters x Height in Meters ) )
			$height	= $height/100;
			
			$BMI	= ($weight / ($height*$height));
			
			$BMI	=  number_format($BMI,2);

			if($BMI < $underweight){
				$result ='underweight';
			}
			else if($BMI > $underweight && $BMI < $normalweight){
				$result ='normalweight';
			}
			else if($BMI > $normalweight && $BMI < $overweight){
				$result ='overweight';
			}
			else if($BMI > $obesity){
				$result ='obesity';
			}

			$success = 1;
		
		}else{

			if($weight==""){
				$error["blank_weight"] = "weight";
			}

			if($height==""){
				$error["blank_height"] = "height";
			}
		}

		return array("success"=>$success, "value"=>$value, "error"=>$error, "BMI"=>array("value"=>$BMI, 'result' => $result));
	}

 	/**
	 * includeAdditionalData
	 *
	 * @param $settings
	 * @return
	 */
	function includeAdditionalData($settings)
	{
		$settings['javascript']['jQuery']['includeInFooter']= 1;
		$settings['javascript']['BMI']['includeInFooter']	= 1;
		$settings['css']['BMI']['includeInFooter']	= 1;

		$jQueryLib = '<script src="typo3conf/ext/js_bmi_calculator/Resources/Public/Script/jquery-1.11.3.min.js" type="text/javascript"></script>';

		if($settings['javascript']['jQuery']['includeInFooter']==1){
			$GLOBALS['TSFE']->additionalFooterData['BMI.jQueryLib'] = $jQueryLib;
		}else{
			$GLOBALS['TSFE']->additionalHeaderData['BMI.jQueryLib'] = $jQueryLib;	
		}

		$additionalDataJS = '<script src="typo3conf/ext/js_bmi_calculator/Resources/Public/Script/Bmi.js" type="text/javascript"></script>';

		if($settings['javascript']['BMI']['includeInFooter']==1){
			$GLOBALS['TSFE']->additionalFooterData['BMIJS'] = $additionalDataJS;
		}else{
			$GLOBALS['TSFE']->additionalHeaderData['BMIJS'] = $additionalDataJS;	
		}

			
		$additionalDataCSS = '<link rel="stylesheet" href="typo3conf/ext/js_bmi_calculator/Resources/Public/Css/Basic.css" type="text/css" media="all" />';

		if($settings['css']['BMI']['includeInFooter']==1){
			$GLOBALS['TSFE']->additionalFooterData['BMICSS'] = $additionalDataCSS;
		}else{
			$GLOBALS['TSFE']->additionalHeaderData['BMICSS'] = $additionalDataCSS;	
		}
	}
	
	/**
	 * getTrim
	 *
	 * @param $val
	 * @return
	 */
	
	public function getTrim($val){
		return trim($val);
	}
}