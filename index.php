<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Joostrap Ripped v2.0
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

require_once __DIR__ . '/functions/tpl-init.php';

// Load Bootstrap 5 components via WebAssetManager
$wa->useScript('bootstrap.carousel');
$wa->useScript('bootstrap.offcanvas');
$wa->useScript('bootstrap.collapse');
$wa->useScript('bootstrap.dropdown');
$wa->useScript('bootstrap.popover');

// Load Bootstrap 5 CSS + Font Awesome (Joomla's built-in)
$wa->useStyle('bootstrap.css');
$wa->useStyle('fontawesome');
$wa->registerAndUseStyle('joomla.fontawesome', 'system/joomla-fontawesome.css');

// Load template CSS assets (versioned for cache busting)
// registerAndUseStyle signature: (name, uri, options[], attributes[], dependencies[])
$assetVersion = ['version' => '2.0.7'];
$wa->registerAndUseStyle('tpl.animate', $tplUrl . '/css/animate.css', $assetVersion);
$wa->registerAndUseStyle('tpl.template', $tplUrl . '/css/template.css', $assetVersion);
$wa->registerAndUseStyle('tpl.backbone', $tplUrl . '/css/j-backbone.css', $assetVersion);

if (@filesize(JPATH_ROOT . '/templates/' . $this->template . '/css/custom.css') > 5)
{
    $wa->registerAndUseStyle('tpl.custom', $tplUrl . '/css/custom.css', $assetVersion);
}

// Load template JS
// registerAndUseScript signature: (name, uri, options[], attributes[], dependencies[])
$wa->registerAndUseScript('tpl.backbone', $tplUrl . '/js/j-backbone.js', $assetVersion, ['defer' => true]);

// Load Raleway font
$wa->registerAndUseStyle('google.raleway', 'https://fonts.googleapis.com/css?family=Raleway:400,300,200,500');

// Critical inline CSS overrides
$wa->addInlineStyle('
    header#header { background: #0E1A1D !important; }
    #menu ul, #menu .nav { display: flex; flex-wrap: wrap; list-style: none; padding-left: 0; margin-bottom: 0; }
    #menu ul > li, #menu .nav > li { position: relative; }
    #menu > div > ul > li > a, #menu > ul > li > a, #menu .nav > li > a, #menu .nav-item > a {
        display: block; padding: 10px 15px; color: #fff !important; text-decoration: none !important;
        font-family: Raleway, sans-serif; font-weight: 300; font-size: 13px;
        text-transform: uppercase; letter-spacing: 1px;
    }
    #menu > div > ul > li > a:hover, #menu > ul > li > a:hover, #menu .nav > li > a:hover, #menu .nav-item > a:hover { color: #f40 !important; }
    #menu .mod-menu__sub, #menu .nav-child, #menu .dropdown-menu {
        position: absolute; top: 100%; left: 0; display: none; min-width: 200px;
        background: #fff; border: 1px solid rgba(0,0,0,.15);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        z-index: 10000; padding: 5px 0; list-style: none; margin: 0;
    }
    #menu li:hover > .mod-menu__sub, #menu li:hover > .nav-child, #menu .dropdown:hover > .dropdown-menu { display: block; }
    #menu .mod-menu__sub a, #menu .nav-child a, #menu .dropdown-menu a {
        display: block; padding: 6px 20px; color: #333 !important; text-decoration: none !important; white-space: nowrap;
    }
    #menu .mod-menu__sub a:hover, #menu .nav-child a:hover, #menu .dropdown-menu a:hover { background-color: #f5f5f5; color: #f40 !important; }
    h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: inherit; text-decoration: none; }
    h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover { text-decoration: none; }
    #mainbody { padding: 30px 0; }
    #top { padding: 25px 0; }
    #top-modules { padding: 25px 0; }
    #bottom1 { padding: 30px 0; }
    #bottom2 { padding: 25px 0; }
    #footer { padding: 15px 0; }
    #breadcrumbs { padding: 10px 0; background: #f5f5f5; border-bottom: 1px solid #eaeaea; }
');

?>
<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <jdoc:include type="metas" />
        <jdoc:include type="styles" />
        <jdoc:include type="scripts" />
    </head>
    <body class="<?php echo $bodyclass . ' ' . $parentName . ' ' . $activeAlias . ' ' . $option . ' view-' . $view . ' ' . $frontpage . ' itemid-' . $itemid . ' ' . $loggedin . ' ' . $rtl_detection; ?>">
        <div class="body-wrapper" id="page">
        <header id="header">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="logo">
                    <?php echo $logo; ?>
                </div>
                <?php if ($this->countModules('menu')): ?>
                    <nav id="menu" class="d-none d-md-block">
                        <jdoc:include type="modules" name="menu" style="basic" />
                    </nav>
                <?php endif; ?>
                <button class="navbar-toggler d-md-none" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"
                    aria-controls="offcanvasMenu" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </header>

    <?php if ($this->countModules('slideshow')): ?>
        <div id="slider">
                <jdoc:include type="modules" name="slideshow" style="standard" />
        </div>
    <?php endif; ?>

    <?php if ($this->countModules('header')): ?>
        <div id="top" class="clearfix">
            <div class="container">
                <jdoc:include type="modules" name="header" style="standard" />
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->countModules('breadcrumbs')): ?>
        <div id="breadcrumbs">
            <div class="container">
                <jdoc:include type="modules" name="breadcrumbs" style="standard" />
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->countModules('top')): ?>
        <div id="top-modules" class="clearfix">
            <div class="container">
                <jdoc:include type="modules" name="top" style="standard" />
            </div>
        </div>
    <?php endif; ?>

        <!-- Mainbody -->
        <div id="mainbody" class="clearfix">
            <div class="container">
                <div class="row">
                <?php if ($this->countModules('left')): ?>
                    <div class="sidebar-left col-md-<?php echo $left; ?>">
                        <div class="sidebar-nav">
                            <jdoc:include type="modules" name="left" style="standard" />
                        </div>
                    </div>
                <?php endif; ?>
                    <!-- Content Block -->
                    <div id="content" class="col-md-<?php echo $span;?>">
                        <div id="message-component">
                            <jdoc:include type="message" />
                        </div>
                    <?php if ($this->countModules('above-content')): ?>
                        <div id="above-content">
                            <jdoc:include type="modules" name="above-content" style="standard" />
                        </div>
                    <?php endif; ?>
                    <?php
                        $menu_check = $app->getMenu();

                        if ($frontpageshow) {
                            ?>
                            <div id="content-area">
                                <jdoc:include type="component" />
                            </div>
                            <?php
                        } else {
                            $activeItem = $menu_check->getActive();
                            if ($activeItem !== null && $activeItem !== $menu_check->getDefault()) {
                                ?>
                                <div id="content-area">
                                    <jdoc:include type="component" />
                                </div>
                                <?php
                            }
                        }
                    ?>
                    <?php if ($this->countModules('below-content')): ?>
                        <div id="below-content">
                            <jdoc:include type="modules" name="below-content" style="standard" />
                        </div>
                    <?php endif; ?>
                    </div>
                    <?php if ($this->countModules('right')) : ?>
                    <aside class="sidebar-right col-md-<?php echo $right; ?>">
                        <jdoc:include type="modules" name="right" style="standard" />
                    </aside>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php if ($this->countModules('bottom')): ?>
        <div id="bottom1" class="clearfix">
            <jdoc:include type="modules" name="bottom" style="standard" />
        </div>
    <?php endif; ?>

    <?php if ($this->countModules('footer')): ?>
        <div id="bottom2" class="clearfix">
            <div class="container">
                <jdoc:include type="modules" name="footer" style="standard" />
            </div>
        </div>
    <?php endif; ?>

        <footer id="footer" class="clearfix">
            <div class="container">
                <div class="copyright">
                <?php if ($copyrights) : ?>
                    <p><?php echo $copytext ?></p>
                <?php  else : ?>
                    <a href="<?php echo $this->baseurl ?>"> <?php echo $sitename; ?></a> <?php echo date('Y');?>
                <?php endif; ?>
                </div>
            </div>
            <?php if ($totop) : ?>
                <a href="#" class="go-top">Back to Top <i class="fa fa-arrow-circle-up"></i></a>
            <?php endif; ?>
        </footer>

        <!-- Offcanvas Mobile Menu -->
        <div class="offcanvas offcanvas-<?php echo $menuslide; ?>" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasMenuLabel">
                    <a href="<?php echo $this->baseurl ?>/" class="<?php echo $icon1; ?>"></a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php if ($this->countModules('mob-menu-above')): ?>
                <div class="mob-menu-above">
                    <jdoc:include type="modules" name="mob-menu-above" style="standard" />
                </div>
                <?php endif; ?>
                <?php if ($this->countModules('menu')): ?>
                    <jdoc:include type="modules" name="menu" style="none" />
                <?php endif; ?>
                <?php if ($this->countModules('mob-menu-below')): ?>
                <div class="mob-menu-below">
                    <jdoc:include type="modules" name="mob-menu-below" style="standard" />
                </div>
                <?php endif; ?>
            </div>
        </div>

        </div><!-- /.body-wrapper -->

        <?php if (@filesize('templates/' . $this->template . '/js/analytics-bottom.js') > 5): ?>
            <script src="<?php echo $tplUrl; ?>/js/analytics-bottom.js" type="text/javascript"></script>
        <?php endif; ?>
    </body>
</html>
