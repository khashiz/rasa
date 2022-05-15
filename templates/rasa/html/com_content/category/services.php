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
            <div class="uk-container uk-container-small">
                <div class="uk-margin-bottom uk-text-center styledTitle">
                    <span>حمل و نقل</span>
                    <h2>خدمات حمل و نقل بین المللی ما</h2>
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
                        <?php echo $beforeDisplayContent; ?>
                        <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                            <?php echo HTMLHelper::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
                        <?php endif; ?>
                        <?php echo $afterDisplayContent; ?>
                    </div>
                <?php endif; ?>
                <div class="com-content-category-blog__items blog-items items-leading <?php echo $this->params->get('blog_class_leading'); ?>">
                    <ul data-uk-switcher="animation: uk-animation-slide-bottom-small" class="uk-grid uk-grid uk-child-width-1-3 servicesTabs">
                        <?php foreach ($this->lead_items as &$item) : ?>
                            <li>
                                <span class="uk-flex uk-flex-center uk-flex-middle uk-flex-column uk-border-rounded uk-box-shadow-small uk-padding cursorPointer">
                                    <?php if (!empty(json_decode($item->urls)->urlatext)) { ?>
                                        <i class="uk-margin-small-bottom far fa-3x fa-fw fa-<?php echo json_decode($item->urls)->urlatext; ?>"></i>
                                    <?php } ?>
                                    <span class="font f700"><?php echo $item->title; ?></span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="uk-switcher uk-margin-medium-top">
                        <?php $leadingcount = 0; ?>
                        <?php foreach ($this->lead_items as &$item) :?>
                            <div class="com-content-category-blog__item blog-item" itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                                <?php
                                $this->item = &$item;
                                echo $this->loadTemplate('leadingitem');
                                ?>
                            </div>
                            <?php $leadingcount++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
	<?php endif; ?>

<div class="uk-background-muted uk-padding-large uk-padding-remove-horizontal uk-position-relative uk-background-cover uk-background-center-center hasShadow" style="background-image: url('https://images.unsplash.com/photo-1617952739760-1dcae19a1d93?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');" data-uk-parallax="bgy: -200">
    <div class="uk-container uk-container-small uk-position-relative">
        <div class="uk-text-center">
            <div class="uk-margin-medium-bottom uk-text-center styledTitle">
                <span>حمل و نقل دریایی</span>
                <h2 class="light">نگران حجم بار برای ارسال نباشید !</h2>
            </div>
            <div class="uk-text-white font f600 uk-margin-large-bottom">
                <p>ما در شرکت حمل و نقل بین المللی مسیر طلایی راسا ، بار شما را در هر مقداری از خرده بار تا بار فله ای یا کانتینری به مقصد می رسانیم !</p>
                <p>فقط کافیست تا با متحصصین ما در بخش حمل و نقل و دریایی تماس حاصل نمایید.</p>
            </div>
            <div>
                <a class="uk-button uk-button-primary uk-border-pill uk-box-shadow-small uk-width-1-1 uk-width-medium@s" href="#">تماس با ما</a>
            </div>
        </div>
    </div>
</div>

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
                <div class="uk-margin-medium-bottom uk-text-center styledTitle">
                    <span>خدمات دیگر</span>
                    <h2>همراه شما در واردات و صادرات هستیم !</h2>
                </div>
                <div class="uk-child-width-1-3" data-uk-grid>
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
</div>
