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
$params = $app->getTemplate(true)->params;
?>

<section class="uk-padding-large locations">
    <div class="uk-container">
        <div class="uk-margin-large-bottom uk-text-center styledTitle">
            <span>دفاتر ما</span>
            <h2>لیست دفاتر ما در منطقه</h2>
        </div>
        <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-large" data-uk-grid>
            <div>
                <div class="uk-height-1-1 wrapper">
                    <div class="uk-grid-collapse uk-height-1-1" data-uk-grid>
                        <div class="uk-width-1-1 uk-width-auto@s"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21794.00023647139!2d51.325854430204544!3d35.70906049082739!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xda1bf08cf9bd7464!2zMzXCsDQyJzI2LjciTiA1McKwMTknNTcuOCJF!5e0!3m2!1sen!2s!4v1652434635036!5m2!1sen!2s" width="220" height="250" class="uk-height-1-1" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                        <div class="uk-width-1-1 uk-width-expand@s">
                            <div class="uk-padding uk-height-1-1">
                                <h3 class="font f700 uk-position-relative uk-text-black">دفتر مرکزی</h3>
                                <ul class="uk-list uk-margin-remove uk-text-zero">
                                    <li>
                                        <a href="">
                                            <i class="fas fa-fw fa-map-signs"></i>
                                            <span class="title">آدرس : </span>
                                            <span class="value"><?php echo $params->get('address') ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tel:<?php echo $params->get('phone') ?>">
                                            <i class="fas fa-fw fa-phone"></i>
                                            <span class="title">تلفن : </span>
                                            <span class="uk-display-inline-block ltr uk-text-right value"><?php echo $params->get('phone') ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="fas fa-fw fa-fax"></i>
                                            <span class="title">فکس : </span>
                                            <span class="uk-display-inline-block ltr uk-text-right value"><?php echo $params->get('fax') ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:<?php echo $params->get('email') ?>">
                                            <i class="fas fa-fw fa-envelope-open-text"></i>
                                            <span class="title">ایمیل : </span>
                                            <span class="uk-display-inline-block ltr uk-text-right value"><?php echo $params->get('email') ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="uk-height-1-1 wrapper">
                    <div class="uk-grid-collapse uk-height-1-1" data-uk-grid>
                        <div class="uk-width-expand">
                            <div class="uk-padding uk-height-1-1">
                                <h3 class="font f700 uk-position-relative uk-text-black">دفتر بندرعباس</h3>
                                <div class="uk-text-center uk-margin-medium-top uk-text-muted">
                                    <i class="fal fa-calendar-note fa-3x"></i>
                                    <p class="uk-margin-remove-bottom uk-text-small font">افتتاح دفتر بندرعباس بزودی ...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>