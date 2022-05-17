<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
?>

<?php if ($params->get('img_intro_full') !== 'none') : ?>
	<figure class="uk-border-rounded uk-overflow-hidden uk-box-shadow-small newsflash-image">
        <a href="<?php echo $item->link; ?>" class="<?php echo $item->title; ?>" class="uk-display-block">
            <?php if (!empty($item->imageSrc)) { ?>
                <?php echo LayoutHelper::render(
                    'joomla.html.image',
                    [
                        'src' => $item->imageSrc,
                        'alt' => $item->imageAlt,
                    ]
                ); ?>
            <?php } else { ?>
                <?php echo LayoutHelper::render(
                    'joomla.html.image',
                    [
                        'src' => 'images/placeholder.svg',
                        'alt' => $item->imageAlt,
                    ]
                ); ?>
            <?php } ?>
            <?php if (!empty($item->imageCaption)) : ?>
                <figcaption>
                    <?php echo $item->imageCaption; ?>
                </figcaption>
            <?php endif; ?>
        </a>
	</figure>
<?php endif; ?>

<?php if ($params->get('item_title')) : ?>
    <?php $item_heading = $params->get('item_heading', 'h4'); ?>
    <<?php echo $item_heading; ?> class="uk-margin-remove newsflash-title uk-flex uk-flex-center">
    <?php if ($item->link !== '' && $params->get('link_titles')) : ?>
        <a href="<?php echo $item->link; ?>" class="uk-display-block uk-text-small font f700 uk-text-secondary">
            <?php echo $item->title; ?>
        </a>
    <?php else : ?>
        <?php echo $item->title; ?>
    <?php endif; ?>
    </<?php echo $item_heading; ?>>
<?php endif; ?>

<?php if (!$params->get('intro_only')) : ?>
	<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php if ($params->get('show_introtext', 1)) : ?>
	<?php echo $item->introtext; ?>
<?php endif; ?>

<?php echo $item->afterDisplayContent; ?>

<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $item, 'params' => $item->params, 'link' => $item->link)); ?>
<?php endif; ?>
