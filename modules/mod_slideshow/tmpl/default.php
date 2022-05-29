<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId = 'mod-custom' . $module->id;

if ($params->get('backgroundimage'))
{
	/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
	$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
	$wa->addInlineStyle('
#' . $modId . '{background-image: url("' . Uri::root(true) . '/' . HTMLHelper::_('cleanImageURL', $params->get('backgroundimage'))->url . '");}
', ['name' => $modId]);
}
?>
<div class="uk-margin-large-bottom uk-position-relative slideshow">
    <div class="uk-position-relative uk-visible-toggle" tabindex="-1" data-uk-slideshow="animation: slide; ratio: 3:1; autoplay: true; autoplay-interval: 4000; min-height: 300;" id="<?php echo $modId; ?>">
        <ul class="uk-slideshow-items">
            <?php foreach ($params->get('slideshow') as $item) : ?>
                <?php if ($item->background != '') { ?>
                    <li>
                        <img src="<?php echo (HTMLHelper::cleanImageURL($item->background))->url; ?>" alt="<?php echo $item->title; ?>" class="uk-width-1-1" data-uk-cover>
                        <a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" class="uk-display-block uk-link-reset coverWrapper uk-position-cover">
                            <?php if ($item->shadow) { ?>
                                <span class="cover"></span>
                            <?php } ?>
                            <?php if (!empty($item->title) || !empty($item->subtitle)) { ?>
                                <div class="uk-position-center-right uk-width-1-1">
                                    <div class="uk-container">
                                        <?php if (!empty($item->title)) { ?>
                                            <h2 class="uk-margin-remove font f900 uk-text-primary" data-uk-slideshow-parallax="opacity: 0,1,0; x: 300,-300;"><?php echo nl2br($item->title); ?></h2>
                                        <?php } ?>
                                        <?php if (!empty($item->subtitle)) { ?>
                                            <p class="uk-margin-remove-bottom uk-margin-small-top uk-text-white font f700" data-uk-slideshow-parallax="opacity: 0,1,0; x: 600,-600;"><?php echo nl2br($item->subtitle); ?></p>
                                        <?php } ?>
                                        <div>
                                            <object class="uk-margin-top uk-display-inline-block" data-uk-slideshow-parallax="opacity: 0,1,0; x: 450,-450;">
                                                <a href="" class="uk-button uk-button-primary uk-button-small uk-border-pill uk-text-white">اطلاعات بیشتر</a>
                                            </object>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </a>
                    </li>
                <?php } ?>
            <?php endforeach; ?>
        </ul>
        <span class="uk-position-center-left uk-padding slideshowArrow uk-text-primary cursorPointer uk-visible@s" data-uk-slideshow-item="previous"><i class="fal fa-fw fa-2x fa-chevron-left"></i></span>
        <span class="uk-position-center-right uk-padding slideshowArrow uk-text-primary cursorPointer uk-visible@s" data-uk-slideshow-item="next"><i class="fal fa-fw fa-2x fa-chevron-right"></i></span>
        <div class="uk-position-bottom-center uk-position-small uk-light">
            <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin-small-bottom"></ul>
        </div>
    </div>
</div>