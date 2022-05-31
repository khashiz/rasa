<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!$list)
{
	return;
}

?>
<div class="uk-position-relative uk-visible-toggle" data-uk-slider>
    <div class="uk-slider-items uk-child-width-1-2 uk-child-width-1-6@s uk-text-center uk-grid uk-grid-small">
	    <?php foreach ($list as $item) : ?>
            <div class="mod-articlesnews__item" itemscope itemtype="https://schema.org/Article">
			    <?php require ModuleHelper::getLayoutPath('mod_articles_news', '_iconitem'); ?>
            </div>
	    <?php endforeach; ?>
    </div>
    <div class="uk-light">
        <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-top uk-hidden@s"></ul>
    </div>
</div>