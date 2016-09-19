plugin.tx_jsbmicalculator{
	settings{
		uri{
			css{
			
				BMI{
					path = {$plugin.tx_jsbmicalculator.uri.css.BMI.path}
					includeInFooter = {$plugin.tx_jsbmicalculator.uri.css.BMI.includeInFooter}
				}
			}

			javascript{

				jQuery{
					path = {$plugin.tx_jsbmicalculator.uri.javascript.jQuery.path}
					include = {$plugin.tx_jsbmicalculator.uri.javascript.jQuery.include}
					includeInFooter = {$plugin.tx_jsbmicalculator.uri.javascript.jQuery.includeInFooter}
				}

				BMI{
					path = {$plugin.tx_jsbmicalculator.uri.javascript.BMI.path}
					includeInFooter = {$plugin.tx_jsbmicalculator.uri.javascript.BMI.includeInFooter}
				}
			}
		}
	}
}

config.tx_jsbmicalculator.features.skipDefaultArguments = 1
plugin.tx_jsbmicalculator.features.skipDefaultArguments = 1