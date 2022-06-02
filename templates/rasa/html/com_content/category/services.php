<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

foreach ($this->category->jcfields as $field) :
	$fieldsValue[$field->name] = $field->value;
	$fieldsRawValue[$field->name] = $field->rawvalue;
endforeach;

?>
<div class="com-content-category-blog blog" itemscope itemtype="https://schema.org/Blog">

	<?php if ($this->params->get('show_category_title', 1)) : ?>
	<<?php echo $htag; ?>>
		<?php echo $this->category->title; ?>
	</<?php echo $htag; ?>>
	<?php endif; ?>
	<?php echo $afterDisplayTitle; ?>

	<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new FileLayout('joomla.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif; ?>

    <?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
        <?php if ($this->params->get('show_no_articles', 1)) : ?>
            <div class="uk-text-center uk-padding-large uk-padding-remove-horizontal">
                <div>
                    <i class="fal fa-5x fa-file-signature uk-text-muted uk-margin-bottom"></i>
                </div>
                <span class="uk-text-black font f700"><?php echo Text::_('COM_CONTENT_NO_ARTICLES'); ?></span>
            </div>
        <?php endif; ?>
    <?php endif; ?>

	<?php if (!empty($this->lead_items)) : ?>
        <div class="uk-padding-large uk-padding-remove-horizontal">
            <div class="uk-container">
                <div class="uk-margin-bottom uk-text-center styledTitle">
                    <span><?php echo JText::_('OUR_SERVICES'); ?></span>
                    <h2><?php echo JText::_('FULL_TITLE'); ?></h2>
                </div>
                <?php  if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
                    <div class="uk-margin-large-bottom category-desc clearfix uk-text-center font uk-text-black f500">
                        <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
                            <?php echo LayoutHelper::render(
                                'joomla.html.image',
                                [
                                    'src' => $this->category->getParams()->get('image'),
                                    'alt' => empty($this->category->getParams()->get('image_alt')) && empty($this->category->getParams()->get('image_alt_empty')) ? false : $this->category->getParams()->get('image_alt'),
                                ]
                            ); ?>
                        <?php endif; ?>
                        <?php // echo $beforeDisplayContent; ?>
                        <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                            <?php echo HTMLHelper::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
                        <?php endif; ?>
                        <?php echo $afterDisplayContent; ?>
                    </div>
                <?php endif; ?>
                <div class="com-content-category-blog__items blog-items items-leading <?php echo $this->params->get('blog_class_leading'); ?>">
                    <ul class="uk-child-width-expand servicesTabs" data-uk-tab="animation: uk-animation-slide-bottom-small">
                        <?php foreach ($this->lead_items as &$item) : ?>
                            <li>
                                <span class="uk-flex uk-flex-center uk-flex-middle uk-flex-column cursorPointer">
                                    <?php if (!empty(json_decode($item->urls)->urlatext)) { ?>
                                        <i class="far fa-3x fa-fw fa-<?php echo json_decode($item->urls)->urlatext; ?>"></i>
                                    <?php } ?>
                                    <span class="uk-margin-small-top font f700 uk-visible@s"><?php echo $item->title; ?></span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <ul class="uk-switcher uk-margin-medium-top">
                        <?php $leadingcount = 0; ?>
                        <?php foreach ($this->lead_items as &$item) :?>
                            <li class="com-content-category-blog__item blog-item" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                                <?php
                                $this->item = &$item;
                                echo $this->loadTemplate('leadingitem');
                                ?>
                            </li>
                            <?php $leadingcount++; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
	<?php endif; ?>

<section class="uk-background-muted uk-padding-large uk-padding-remove-horizontal uk-position-relative uk-background-cover uk-background-center-center hasShadow benefits" style="background-image: url('<?php echo 'images/services/large/'.$fieldsValue['catbriefbg'] ?>'); background-repeat: no-repeat; background-position-y: calc(-360.112px); background-size: 1903px 1269px;" data-uk-parallax="bgy: -200">
    <div class="uk-container uk-container-small uk-position-relative">
        <div class="uk-text-center">
            <div class="uk-margin-large-bottom uk-text-center styledTitle">
                <span><?php echo $fieldsValue['catsmalltitle']; ?></span>
                <h2 class="light"><?php echo $fieldsValue['catmaintitle']; ?></h2>
            </div>
            <div class="uk-position-relative uk-visible-toggle" data-uk-slider>
                <div class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@s uk-text-center uk-grid uk-grid-small">
	                <?php $items = explode('\n', $fieldsValue['icons']); ?>
                    <?php for($i = 0; $i < count($items)-1; $i++) { ?>
                        <?php $item = explode(',', $items[$i]); ?>
                        <div>
                            <span class="uk-margin-auto uk-border-circle uk-box-shadow-small uk-flex uk-flex-middle uk-flex-center uk-text-primary icon"><i class="<?php echo $item[0]; ?>"></i></span>
                            <span class="uk-margin-top uk-text-white title font f700 uk-display-block"><?php echo $item[1]; ?></span>
                        </div>
                    <?php } ?>
                </div>
                <div class="uk-light">
                    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-top uk-hidden@s"></ul>
                </div>
            </div>
        </div>
    </div>
</section>

	<?php
	$introcount = count($this->intro_items);
	$counter = 0;
	?>

	<?php if (!empty($this->intro_items)) : ?>
		<?php $blogClass = $this->params->get('blog_class', ''); ?>
		<?php if ((int) $this->params->get('num_columns') > 1) : ?>
			<?php $blogClass .= (int) $this->params->get('multi_column_order', 0) === 0 ? ' masonry-' : ' columns-'; ?>
			<?php $blogClass .= (int) $this->params->get('num_columns'); ?>
		<?php endif; ?>
		<div class="uk-padding-large uk-padding-remove-horizontal com-content-category-blog__items blog-items <?php echo $blogClass; ?>">
            <div class="uk-container">
                <div class="uk-child-width-1-1 uk-child-width-1-3@s uk-flex-center" data-uk-grid>
                    <?php foreach ($this->intro_items as $key => &$item) : ?>
                        <div class="com-content-category-blog__item blog-item" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                            <?php
                            $this->item = & $item;
                            echo $this->loadTemplate('introitem');
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
		</div>
	<?php endif; ?>

	<?php if (!empty($this->link_items)) : ?>
		<div class="items-more">
			<?php echo $this->loadTemplate('links'); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
		<div class="com-content-category-blog__children cat-children">
			<?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
				<h3> <?php echo Text::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
			<?php endif; ?>
			<?php echo $this->loadTemplate('children'); ?> </div>
	<?php endif; ?>
	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
		<div class="com-content-category-blog__navigation w-100">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="com-content-category-blog__counter counter float-end pt-3 pe-2">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
			<div class="com-content-category-blog__pagination">
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		</div>
	<?php endif; ?>
    <div class="uk-padding-large uk-padding-remove-horizontal com-content-category-blog__items blog-items">
        <div class="uk-container">
            <div class="uk-margin-medium-bottom uk-text-center styledTitle">
                <span><?php echo JText::_('OTHER_SERVICES'); ?></span>
                <h2><?php echo JText::_('WITH_YOU_IN_EXPORTS'); ?></h2>
            </div>
            <div class="uk-child-width-1-1 uk-child-width-1-3@s uk-flex-center" data-uk-grid>
	            <?php $otheritems = explode('\n', $fieldsValue['otheritems']); ?>
	            <?php for($j = 0; $j < count($otheritems)-1; $j++) { ?>
		            <?php $otheritem = explode(',', $otheritems[$j]); ?>
                    <div class="com-content-category-blog__item blog-item uk-first-column" itemprop="blogPost" itemscope="" itemtype="https://schema.org/BlogPosting">
                        <figure class="uk-border-rounded uk-overflow-hidden uk-box-shadow-small item-image"><?php echo $otheritem[1]; ?></figure>
                        <div class="item-content uk-text-center">
                            <div class="page-header">
                                <h2 itemprop="name" class="uk-h4 f700 font uk-flex uk-flex-center"><?php echo $otheritem[0]; ?></h2>
                            </div>
                        </div>
                    </div>
	            <?php } ?>
            </div>
        </div>
    </div>
</div>