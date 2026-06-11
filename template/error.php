<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Joostrap Ripped
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$templateUrl = rtrim(Uri::root(), '/') . '/templates/' . $this->template;

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
	<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" type="text/css" />
	<?php if ($this->direction == 'rtl') : ?>
	<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template-rtl.css" type="text/css" />
	<?php endif; ?>
	<style>
		body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; padding: 2rem; }
		.error { max-width: 600px; margin: 4rem auto; text-align: center; }
		.error h1 { font-size: 3rem; color: #333; }
		.error h2 { font-size: 1.25rem; color: #666; margin-bottom: 2rem; }
		.home-btn a { display: inline-block; padding: 10px 24px; background: #333; color: #fff; text-decoration: none; border-radius: 4px; }
		.home-btn a:hover { background: #555; }
	</style>
</head>
<body>
	<div class="error">
		<div id="errorboxbody">
			<h1><?php echo $this->error->getCode(); ?></h1>
			<h2><?php echo $this->error->getMessage(); ?></h2>
			<h3><?php echo Text::_('JERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></h3>
			<div class="home-btn">
				<a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo Text::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>">
					<?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?>
				</a>
			</div>
			<?php if ($this->debug) : ?>
			<div style="margin-top: 2rem; text-align: left;">
				<?php echo $this->renderBacktrace(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>
