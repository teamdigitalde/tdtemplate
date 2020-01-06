config {
  # cat=config; type=boolean; label=Admin Panel: Turn on admin panel (mainly for testing purposes only)
  adminPanel = 0

  # cat=config; type=boolean; label=Debugging: Turn on debugging (testing purposes only)
  debug = 0

  #cat=config; type=string; label=Domain name for Base URL: (excluding slashes and protocol like http://)
  domain = installscript.tim-bueschken.de
}
#[globalString = IENV:HTTP_HOST=baseurl2-anpassen.de]
#  config.domain = baseurl2-anpassen.de
#[global]

custom {
  # cat=filepaths; type=string; label=HTML Templates: Location of the (X)HTML templates relative to site
  templates = EXT:tdtemplate/Resources/Private/Templates/Page/

  # cat=filepaths; type=string; label=Partials Templates: Location of the (X)HTML templates relative to site
  partials = EXT:tdtemplate/Resources/Private/Partials/Page/

  # cat=filepaths; type=string; label=Layouts Templates: Location of the (X)HTML templates relative to site
  layouts = EXT:tdtemplate/Resources/Private/Layouts/Page/

  # cat=filepaths; type=string; label=CSS: Location of the Cascading Style Sheets relative to site
  css = EXT:tdtemplate/Resources/Public/Css/

  # cat=filepaths; type=string; label=Images: Location of the images relative to site
  images = EXT:tdtemplate/Resources/Public/Images/

  # cat=filepaths; type=string; label=Scripts: Location of the Javascript files relative to site
  scripts = EXT:tdtemplate/Resources/Public/JavaScript/
}

# some domainspecific values
meta {
	google-site-verification {
  	active = 0
  	value =
	}
	geo {
		active = 0
		region = DE-HE
		placename = Lauterbach
		position = 50.63;9.39
	}
}
headerData {
  hreflang.active = 0
  googleAnalytics {
    active = 0
    id = UA-123456789-1
  }
  matomo {
    active = 0
    site_id = 1
    # be aware of leading and trailing slashes!
    tracker_url = //piwik.example.com/
  }
}
