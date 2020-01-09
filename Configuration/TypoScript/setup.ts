# Make the PAGE object
page = PAGE
page {
	shortcutIcon = {$custom.images}favicon.ico

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
	2 = TEXT
		2.value = <meta name="format-detection" content="telephone=no">
		5 = COA
		5 {
			// Apple touch icons
			5 = IMG_RESOURCE
			5 {
				file = {$custom.images}favicon_256.png
				file {
					width = 57c
					height = 57c
				}

				stdWrap.dataWrap = <link rel="apple-touch-icon" sizes="{TSFE:lastImgResourceInfo|0}x{TSFE:lastImgResourceInfo|1}" href="|">
			}

			10 < .5
			10.file {
				width = 76c
				height = 76c
			}

			15 < .5
			15.file {
				width = 114c
				height = 114c
			}

			20 < .5
			20.file {
				width = 152c
				height = 152c
			}

			25 < .5
			25.file {
				width = 180c
				height = 180c
			}

			// ...

			// Android icons
			30 < .5
			30 {
				file {
					width = 16c
					height = 16c
				}

				stdWrap.dataWrap = <link rel="icon" type="image/png" sizes="{TSFE:lastImgResourceInfo|0}x{TSFE:lastImgResourceInfo|1}" href="|">
			}

			35 < .5
			35.file {
				width = 32c
				height = 32c
			}

			40 < .5
			40.file {
				width = 96c
				height = 96c
			}

			45 < .5
			45.file {
				width = 160c
				height = 160c
			}

			50 < .5
			50.file {
				width = 196c
				height = 196c
			}

			// Microsoft Application icons
			55 < .5
			55 {
				file {
					width = 70c
					height = 70c
				}

				stdWrap.dataWrap = <meta name="msapplication-square{TSFE:lastImgResourceInfo|0}x{TSFE:lastImgResourceInfo|1}logo" content="|"/>
			}

		}
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
