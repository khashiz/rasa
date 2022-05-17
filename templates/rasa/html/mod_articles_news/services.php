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
<section class="uk-padding-large uk-padding-remove-horizontal uk-padding-remove-top">
    <div class="uk-margin-large-bottom uk-text-center styledTitle">
        <span>سایر خدمات</span>
        <h2>خدمات دیگری که ارائه می‌کنیم</h2>
    </div>
    <div class="uk-container">
        <div class="uk-slider-container-offset" data-uk-slider>
            <div class="uk-position-relative uk-visible-toggle">
                <div class="uk-slider-items uk-child-width-1-1 uk-child-width-1-4@s uk-grid">
                    <?php foreach ($list as $item) : ?>
                        <div class="mod-articlesnews__item" itemscope itemtype="https://schema.org/Article">
                            <?php require ModuleHelper::getLayoutPath('mod_articles_news', '_serviceitem'); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-top uk-hidden@s"></ul>
        </div>
    </div>
</section>