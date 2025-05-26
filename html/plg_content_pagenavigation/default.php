<?php
/**
 * @package     Joomla.Template.Override
 * @subpackage  plg_content_pagenavigation
 * @copyright   (C) 2024
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$this->loadLanguage();
$lang = $this->getLanguage();
?>

<nav class="pagenavigation" aria-label="<?php echo Text::_('PLG_PAGENAVIGATION_ARIA_LABEL'); ?>">
    <span class="pagination ms-0 justify-content-between">
        <?php if ($row->prev) :
            $direction = $lang->isRtl() ? 'right' : 'left'; ?>
            <a class="btn btn-sm btn-secondary previous" href="<?php echo Route::_($row->prev); ?>" rel="prev">
                <span class="visually-hidden">
                    <?php echo Text::sprintf('JPREVIOUS_TITLE', htmlspecialchars($rows[$location - 1]->title)); ?>
                </span>
                <i class="bi bi-chevron-<?php echo $direction; ?>" aria-hidden="true"></i>
                <span aria-hidden="true"><?php echo $row->prev_label; ?></span>
            </a>
        <?php endif; ?>

        <?php if ($row->next) :
            $direction = $lang->isRtl() ? 'left' : 'right'; ?>
            <a class="btn btn-sm btn-secondary next" href="<?php echo Route::_($row->next); ?>" rel="next">
                <span class="visually-hidden">
                    <?php echo Text::sprintf('JNEXT_TITLE', htmlspecialchars($rows[$location + 1]->title)); ?>
                </span>
                <span aria-hidden="true"><?php echo $row->next_label; ?></span>
                <i class="bi bi-chevron-<?php echo $direction; ?>" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
    </span>
</nav>
