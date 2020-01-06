# Make the PAGE object
page = PAGE
page {
	10 = FLUIDTEMPLATE
	10 {
		layoutRootPath = EXT:tdtemplate/Resources/Private/Layouts/
		templateRootPaths.10 = EXT:tdtemplate/Resources/Private/Templates/
		partialRootPaths.10 = EXT:tdtemplate/Resources/Private/Partials/
	}

	// FooterData
	footerData {
		// Werte ab 5000
	}

	// HeaderData
	headerData {
		// Werte ab 10.000
	}

	// includeCSS
	includeCSS {
		// Werte ab 1000
		1000 = {$custom.css}custom.css
	}

	includeJSFooter {
		// Werte ab 1000
		1000 = {$custom.scripts}custom.js
	}
}

// Config
config {
	# Display error messages instead of an unreadable errorcode
	#contentObjectExceptionHandler = 0
	// Administrator settings
	admPanel = {$config.adminPanel}
	debug = {$config.debug}

	linkVars = L(1-99)
}

## Sprachcondition
/*
[siteLanguage("languageId") == "1"]
	plugin.tx_indexedsearch {
		settings {
			blind {
				languageUid = 1
			}
			defaultOptions {
				languageUid = 1
			}
		}
	}
[global]
*/

@import 'EXT:tdtemplate/Configuration/TypoScript/plugins.ts'
