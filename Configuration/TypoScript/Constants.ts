plugin.tx_jsbmicalculator {

	uri {
		css {
			
			BMI{
				# cat=BMI Calculator/file; type=string; label= CSS Path
				path = typo3conf/ext/js_bmi_calculator/Resources/Public/Css/Basic.css

				# cat=BMI Calculator/enable; type=boolean; label= Include CSS file in footer section: If disable then CSS file will include in header section
				includeInFooter = 1
			}
		}
		
		javascript{

			jQuery{
				# cat=BMI Calculator/file; type=string; label= jQuery Library
				path = typo3conf/ext/js_bmi_calculator/Resources/Public/Script/jquery-1.11.3.min.js

				# cat=BMI Calculator/enable; type=boolean; label= Include jQuery Library
				include = 0

				# cat=BMI Calculator/enable; type=boolean; label= Include jQuery Library in footer section: If disable then Javascript file will include in header section
				includeInFooter = 1
			}

			BMI{
				# cat=BMI Calculator/file; type=string; label= Javascript Path
				path = typo3conf/ext/js_bmi_calculator/Resources/Public/Script/Bmi.js

				# cat=BMI Calculator/enable; type=boolean; label= Include JS file in footer section: If disable then Javascript file will include in header section
				includeInFooter = 1
			}
		}
	}
}