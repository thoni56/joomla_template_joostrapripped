<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Base
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Uri\Uri;

// Template folders for easy management
$tplUrl  = rtrim(Uri::root(), '/') . '/templates/' . $this->template;
$tplPath = JPATH_SITE . '/templates/' . $this->template;

// Defaults
$app                = Factory::getApplication();
$doc                = $app->getDocument();
$wa                 = $doc->getWebAssetManager();
$lang               = $app->getLanguage();
$langTag            = $lang->getTag();
$user               = $app->getIdentity();
$this->language     = $doc->language;
$langParts          = explode('-', $this->language);
$htmlLang           = reset($langParts);
$this->direction    = $doc->direction;
$option             = $app->input->getCmd('option', '');
$view               = $app->input->getCmd('view', '');
$layout             = $app->input->getCmd('layout', '');
$task               = $app->input->getCmd('task', '');
$itemid             = $app->input->getCmd('Itemid', '');
$sitename           = $app->get('sitename');
$logo_image         = $this->params->get('logoFile');
$site_title         = $this->params->get('sitetitle');
$site_desc          = $this->params->get('sitedescription');
$logo_margin_top    = $this->params->get('logoMarginTop', 50);
$logo_margin_bottom = $this->params->get('logoMarginBottom', 40);
$color_style        = $this->params->get('templateStyle', '');
$login_button       = $this->params->get('userLogin');
$register_button    = $this->params->get('userRegistration');
$copyrights         = $this->params->get('copyrights');
$copytext           = $this->params->get('copyrightsText');
$ga_id              = $this->params->get('googleAnalitycsCode');
$totop              = $this->params->get('toTop');
$social_icons       = $this->params->get('socialIcons');
$frontpageshow      = $this->params->get('frontpageshow', 0);
$left               = $this->params->get('sidebarLeftWidth', '');
$right              = $this->params->get('sidebarRightWidth', '');
$icon1              = $this->params->get('icon1', '');
$icon6              = $this->params->get('icon6', '');
$menuslide          = $this->params->get('menuslide', 'start');

// Set the generator metadata
$doc->setGenerator($this->params->get('setGeneratorTag', ''));

/**
 * ==================================================
 * Frontpage check
 * ==================================================
 */
$isFrontpage = false;
$menu = $app->getMenu();
$active = $menu->getActive();

if (!Multilanguage::isEnabled())
{
	if ($active !== null && $active == $menu->getDefault())
	{
		$isFrontpage = true;
	}
}
elseif ($active !== null && $active == $menu->getDefault($langTag))
{
	$isFrontpage = true;
}

$frontpage = $isFrontpage ? 'frontpage' : '';

$fullWidth = ($task == "edit" || $layout == "form" ) ? 1 : 0;

// Width calculations
$span = '';
$grid = 12;

if ($this->countModules('left') && $this->countModules('right'))
{
	$span = ($grid - ( $left + $right ));
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
	$span = ($grid - $left);
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
	$span = ($grid - $right);
}
else
{
	$span = 12;
}

// RTL
$rtl_detection = $lang->isRtl() ? ' rtl' : ' no-rtl';

// Extra body classes
$bodyclass      = $this->params->get('bodyclass', '');
$parentName     = '';
$activeAlias    = '';

if ($active !== null)
{
	$activeAlias = $active->alias;
	$parentId    = $active->tree[0];
	$parentItem  = $menu->getItem($parentId);
	$parentName  = $parentItem ? $parentItem->alias : '';
}

$loggedin = ($user === null || $user->guest) ? 'loggedout' : 'loggedin';

// Favicon
if ($this->params->get('templateFavicon'))
{
	$this->addFavicon(Uri::root() . $this->params->get('templateFavicon'));
}

// Logo
if ($logo_image)
{
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand"><img src="' . Uri::root() . $logo_image . '" alt="' . $sitename . '" /></a>';
}
elseif (($site_title) && ($site_desc))
{
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand">' . htmlspecialchars($site_title) . '<span class="site-description">'
	. htmlspecialchars($site_desc) . '</span></a>';
}
elseif (($site_title) && (!$site_desc))
{
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand">' . htmlspecialchars($site_title) . '</a>';
}
else
{
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand"><img src="' . Uri::root() . 'templates/' . $this->template
	. '/images/logo.png" alt="' . $sitename . '" /></a>';
}

// Logo details from template params
$logoStyle = '
	.logo { margin-top:' . (int) $logo_margin_top . 'px; margin-bottom:' . (int) $logo_margin_bottom . 'px; }
';
$wa->addInlineStyle($logoStyle);

// Login & Registration
if ($user === null || $user->guest)
{
	$logintext = "Login";
	$registertext = "Registration";
}
else
{
	$logintext = "Log Out";
	$registertext = "My Profile";
}

// Social Icons
$facebook      = $this->params->get('linkFacebook', '');
$twitter       = $this->params->get('linkTwitter', '');
$pinterest     = $this->params->get('linkPinterest', '');
$dribbble      = $this->params->get('linkDribbble', '');
$linkedin      = $this->params->get('linkLinkedIn', '');
$flickr        = $this->params->get('linkFlickr', '');
$youtube       = $this->params->get('linkYoutube', '');
$vimeo         = $this->params->get('linkVimeo', '');
$google_plus   = $this->params->get('linkGooglePlus', '');

// Custom CSS from template params
if (($this->params->get('customCSS')) && ($this->params->get('customCSScode') != ''))
{
	$wa->addInlineStyle($this->params->get('customCSScode'));
}

// Google Analytics Embed JS Code
if ($this->params->get('googleAnalitycs'))
{
	$wa->addInlineScript('
		var
		_gaq = _gaq || [];
		_gaq.push([\'_setAccount\', \'' . $ga_id . '\']);
		_gaq.push([\'_trackPageview\']);

		(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		})();

	');
}

// Google Fonts 1 - chosen from template params
if ($this->params->get('googleFonts'))
{
	$font_family            = $this->params->get('googleFontName');
	$css_selectors          = $this->params->get('googleFontSelectors', '');
	$g1_font_family         = '';

	if ($font_family)
	{
		$wa->registerAndUseStyle('google.font1', 'https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $font_family), [], ['rel' => 'lazy-stylesheet']);

		if ($css_selectors)
		{
			if ((strpos($font_family, ":")) && (strpos($font_family, "&")))
			{
				$g1_font_family = strstr($font_family, ':', true);
			}
			elseif ((strpos($font_family, ":")) && (!strpos($font_family, "&")))
			{
				$g1_font_family = strstr($font_family, ':', true);
			}
			elseif ((!strpos($font_family, ":")) && (strpos($font_family, "&")))
			{
				$g1_font_family = strstr($font_family, '&', true);
			}
			else
			{
				$g1_font_family = $font_family;
			}

			$wa->addInlineStyle($css_selectors . ' { font-family: ' . $g1_font_family . ', sans-serif; }');
		}
	}
}

// Google Fonts 2 - chosen from template params
if ($this->params->get('googleFontsSecond'))
{
	$second_font_family     = $this->params->get('googleFontNameSecond');
	$second_css_selectors   = $this->params->get('googleFontSelectorsSecond', '');
	$g2_font_family         = '';

	if ($second_font_family)
	{
		$wa->registerAndUseStyle('google.font2', 'https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $second_font_family), [], ['rel' => 'lazy-stylesheet']);

		if ($second_css_selectors)
		{
			if ((strpos($second_font_family, ":")) && (strpos($second_font_family, "&")))
			{
				$g2_font_family = strstr($second_font_family, ':', true);
			}
			elseif ((strpos($second_font_family, ":")) && (!strpos($second_font_family, "&")))
			{
				$g2_font_family = strstr($second_font_family, ':', true);
			}
			elseif ((!strpos($second_font_family, ":")) && (strpos($second_font_family, "&")))
			{
				$g2_font_family = strstr($second_font_family, '&', true);
			}
			else
			{
				$g2_font_family = $second_font_family;
			}

			$wa->addInlineStyle($second_css_selectors . ' { font-family: ' . $g2_font_family . ', sans-serif; }');
		}
	}
}

/**
 * ==================================================
 * Custom colors CSS
 * ==================================================
 */
$customColorsCss = null;

for ($i = 1; $i <= 5; $i++)
{
	if ($colorEnabled = $this->params->get('color' . $i . '_enabled', 0))
	{
		$colorCode     = $this->params->get('color' . $i . '_code', null);
		$colorSelector = $this->params->get('color' . $i . '_selector', null);
		$colorProperty = str_replace('{color}', $colorCode, $this->params->get('color' . $i . '_property', null));

		if ($colorCode && $colorSelector && $colorProperty)
		{
			$customColorsCss .= $colorSelector . " {" . $colorProperty . "}\n";
		}
	}
}

if ($customColorsCss !== null)
{
	$wa->addInlineStyle($customColorsCss);
}
