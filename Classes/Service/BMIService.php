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
		if(!empty($settings['uri']['javascript']['jQuery']['path']) && $settings['uri']['javascript']['jQuery']['include']==1){
			
			$jQueryLib = '<script src="'.$settings['uri']['javascript']['jQuery']['path'].'" type="text/javascript"></script>';

			if($settings['uri']['javascript']['jQuery']['includeInFooter']==1){
				$GLOBALS['TSFE']->additionalFooterData['BMI.jQueryLib'] = $jQueryLib;
			}else{
				$GLOBALS['TSFE']->additionalHeaderData['BMI.jQueryLib'] = $jQueryLib;	
			}
		}

		if(!empty($settings['uri']['javascript']['BMI']['path'])){
			
			$additionalDataJS = '<script src="'.$settings['uri']['javascript']['BMI']['path'].'" type="text/javascript"></script>';

			if($settings['uri']['javascript']['BMI']['includeInFooter']==1){
				$GLOBALS['TSFE']->additionalFooterData['BMIJS'] = $additionalDataJS;
			}else{
				$GLOBALS['TSFE']->additionalHeaderData['BMIJS'] = $additionalDataJS;	
			}
		}

		if(!empty($settings['uri']['css']['BMI']['path'])){
			
			$additionalDataCSS = '<link rel="stylesheet" href="'.$settings['uri']['css']['BMI']['path'].'" type="text/css" media="all" />';

			if($settings['uri']['css']['BMI']['includeInFooter']==1){
				$GLOBALS['TSFE']->additionalFooterData['BMICSS'] = $additionalDataCSS;
			}else{
				$GLOBALS['TSFE']->additionalHeaderData['BMICSS'] = $additionalDataCSS;	
			}
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