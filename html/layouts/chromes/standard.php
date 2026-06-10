<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Chromes
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

if ((string) $module->content === '') {
    return;
}

$moduleTag   = htmlspecialchars($params->get('module_tag', 'div'), ENT_QUOTES, 'UTF-8');
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass = htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$modClassSfx = htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8');

$moduleAttribs          = [];
$moduleAttribs['class'] = trim('module ' . $modClassSfx);

if (!empty($attribs['class'])) {
    $moduleAttribs['class'] .= ' ' . htmlspecialchars($attribs['class'], ENT_QUOTES, 'UTF-8');
}

$headerAttribs = [];

if ($headerClass !== '') {
    $headerAttribs['class'] = $headerClass;
}

if ($moduleTag !== 'div') {
    if ($module->showtitle) {
        $moduleAttribs['aria-labelledby'] = 'mod-' . $module->id;
        $headerAttribs['id']              = 'mod-' . $module->id;
    } else {
        $moduleAttribs['aria-label'] = htmlspecialchars($module->title, ENT_QUOTES, 'UTF-8');
    }
}
?>
<<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
    <?php if ((bool) $module->showtitle) : ?>
        <div class="module-title">
            <<?php echo $headerTag; ?> <?php echo ArrayHelper::toString($headerAttribs); ?>><?php echo $module->title; ?></<?php echo $headerTag; ?>>
        </div>
    <?php endif; ?>
    <div class="module-content">
        <?php echo $module->content; ?>
    </div>
</<?php echo $moduleTag; ?>>
