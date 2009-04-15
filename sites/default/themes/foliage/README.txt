README.TXT // Foliage theme for Drupal 6 //

Thank you for downloading this theme :-)

Upload the theme as usual to your sites/all/themes directory
and enable it on admin/build/themes

ABOUT THE FOLIAGE THEME:
-------------------------------------------------------------------------+
The theme is coded table-less and source ordered - the content comes before the left
and right columns in the XHTML source.

Foliage validates XHTML 1.0 Strict and validates CSS and is tested in:
	- Firefox for Windows, Mac and Linux
	- Internet Explorer 6 and Internet Explorer 7 for Windows
	- Safari for Mac and Windows
	- Opera for Windows, Mac and Linux
	- Konquerer for Linux


MODULE, DISPLAY AND BLOCK POSITION SUPPORT
-------------------------------------------------------------------------+
The theme has been tested with all Drupal core modules.

It supports Logo, Site name, Site slogan, Mission statement, User pictures,
Search box, Shortcut icon, Primary and Secondary links.

Foliage also supports all default block positions.
The header is positioned on top of the middle column directly below the
mission statement.


THEME MODIFICATION
-------------------------------------------------------------------------+
If you feel like giving the theme a look of your own, I recommend:
	- replace the two graphic files header.jpg and footer.jpg and also logo.png, keeping dimensions.
	- and/or change the text colours in the stylesheet style.css.
	- another possibility is to modify the column widths and background colours.
	
	
CHANGELOG (compared to the 6.x-1.3 version)
-------------------------------------------------------------------------+
  - Bug fix: Display error for the OpenId login link
	- Bug fix: Images disappear in IE 6 when using "Sticky at Top of Lists"
	- Bug fix: Links in the left column not clickable in Safari 2.x
	- Footer block region added
	
	- Some users have reported that the content column overlaps the right column on pages with tables (like admin/build/themes, tracking pages or certain forum pages).
	  This can not really be fixed on all pages because the table widths are calculated dynamically by scripts inside the Drupal core. Even Garland and Bluemarine are affected by this - so this is rather something that should be fixed inside Drupal than in the themes.
		I managed to fix it on the forum pages but for admin/build/themes and for the tracking pages only a workaround helped: the right column is now hidden on those pages.
		If you do not want this you can simply remove this part from the beginning of page.tpl.php:
		<?php if ((arg(2) == 'themes') || (arg(2) == 'track')) { ?>
		<style type="text/css">
		#outerColumn {border-right: none !important;}
		#rightCol {display: none;}
		</style>
		<?php } ?>


ABOUT
-------------------------------------------------------------------------+
Foliage was initially designed and maintained by:
	- Bjarne (Drupal nick netbjarne) - netbjarne [at] gmail.com
and is now and maintained by:
	- Johann from FreeCmsDesigns.com (Drupal nick JohannK) - who developed the XHTML and CSS: info [at] freecmsdesigns.com
