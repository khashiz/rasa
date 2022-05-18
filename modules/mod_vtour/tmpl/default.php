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
<section class="uk-background-muted uk-padding-large uk-padding-remove-horizontal">
    <div class="uk-container uk-container-xsmall uk-text-center">
        <div class="uk-margin-bottom uk-text-center styledTitle">
            <span>تور مجازی</span>
            <h2>از راه دور مهمان دفتر ما باشید</h2>
        </div>
        <div class="uk-text-center font uk-text-black f500 uk-margin-medium-bottom">
            <p>با بازدید از تور مجازی ما ، از راه دور از دفتر مرکزی ما بازدید کنید.</p>
        </div>
        <div>
            <a href="#" class="uk-button uk-button-primary uk-border-pill uk-button-large uk-width-1-1 uk-width-auto@m">بازدید از تور مجازی</a>
        </div>
    </div>
</section>
<div id="<?php echo $modId; ?>" class="mod-custom custom">
	<?php echo $module->content; ?>
</div>
