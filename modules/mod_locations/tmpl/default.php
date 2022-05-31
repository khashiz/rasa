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

$app  = JFactory::getApplication();
$tempParams = $app->getTemplate(true)->params;
?>
<section class="uk-padding-large uk-padding-remove-horizontal locations">
    <div class="uk-container">
        <div class="uk-margin-large-bottom uk-text-center styledTitle">
            <span class="uk-hidden"><?php echo $params->get('smalltitle'); ?></span>
            <h2><?php echo $params->get('maintitle'); ?></h2>
        </div>
        <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-large" data-uk-grid>
	        <?php foreach ($params->get('locations') as $item) : ?>
		        <?php if ($item->title != '') { ?>
                    <?php if ($item->type == 'existing') { ?>
                        <div>
                            <div class="uk-height-1-1 wrapper">
                                <div class="uk-grid-collapse uk-height-1-1" data-uk-grid>
                                    <div class="uk-width-1-1">
                                        <img src="<?php echo (HTMLHelper::cleanImageURL($item->img))->url; ?>" alt="<?php echo $item->title; ?>" class="uk-width-1-1">
                                    </div>
                                    <div class="uk-width-1-1 uk-width-auto@s">
                                        <iframe src="<?php echo $item->map_url; ?>" width="220" height="250" class="uk-height-1-1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                    <div class="uk-width-1-1 uk-width-expand@s">
                                        <div class="uk-padding uk-height-1-1">
                                            <h3 class="font f700 uk-position-relative uk-text-black"><?php echo $item->title; ?></h3>
                                            <ul class="uk-list uk-margin-remove uk-text-zero">
                                                <li>
                                                    <a href="">
                                                        <i class="fas fa-fw fa-map-signs"></i>
                                                        <span class="title"><?php echo JText::_('ADDRESS').' : '; ?></span>
                                                        <span class="value"><?php echo $item->address; ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="tel:<?php echo $tempParams->get('phone') ?>">
                                                        <i class="fas fa-fw fa-phone"></i>
                                                        <span class="title"><?php echo JText::_('PHONE').' : '; ?></span>
                                                        <span class="uk-display-inline-block ltr uk-text-<?php echo JFactory::getLanguage()->isRtl() ? 'right' : 'left'; ?> value"><?php echo $item->phone; ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="">
                                                        <i class="fas fa-fw fa-fax"></i>
                                                        <span class="title"><?php echo JText::_('FAX').' : '; ?></span>
                                                        <span class="uk-display-inline-block ltr uk-text-<?php echo JFactory::getLanguage()->isRtl() ? 'right' : 'left'; ?> value"><?php echo $item->fax; ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="mailto:<?php echo $item->email; ?>">
                                                        <i class="fas fa-fw fa-envelope-open-text"></i>
                                                        <span class="title"><?php echo JText::_('EMAIL').' : '; ?></span>
                                                        <span class="uk-display-inline-block ltr uk-text-<?php echo JFactory::getLanguage()->isRtl() ? 'right' : 'left'; ?> value"><?php echo $item->email; ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div>
                            <div class="uk-height-1-1 wrapper">
                                <div class="uk-grid-collapse uk-height-1-1" data-uk-grid>
                                    <div class="uk-width-1-1">
                                        <img src="<?php echo (HTMLHelper::cleanImageURL($item->img))->url; ?>" alt="<?php echo $item->title; ?>" class="uk-width-1-1">
                                    </div>
                                    <div class="uk-width-expand">
                                        <div class="uk-padding uk-height-1-1">
                                            <h3 class="font f700 uk-position-relative uk-text-black"><?php echo $item->title; ?></h3>
                                            <div class="uk-text-center uk-margin-medium-top uk-text-muted">
                                                <i class="fal fa-calendar-note fa-3x"></i>
                                                <p class="uk-margin-remove-bottom uk-text-small font"><?php echo $item->text; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
		        <?php } ?>
	        <?php endforeach; ?>
        </div>
    </div>
</section>