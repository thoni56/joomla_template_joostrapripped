<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Joostrap Ripped
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

$app    = Factory::getApplication();
$wa     = $this->getWebAssetManager();
$tplUrl = rtrim(Uri::root(), '/') . '/templates/' . $this->template;

// Load Bootstrap 5
$wa->useStyle('bootstrap.css');
$wa->useScript('bootstrap.collapse');
$wa->useStyle('fontawesome');

// Load template styles
$wa->registerAndUseStyle('tpl.template', $tplUrl . '/css/template.css');

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<jdoc:include type="metas" />
		<jdoc:include type="styles" />
		<jdoc:include type="scripts" />
	</head>
	<body class="contentpane component">
		<div class="wrapper">
			<jdoc:include type="message" />
			<jdoc:include type="component" />
		</div>
	</body>
</html>
