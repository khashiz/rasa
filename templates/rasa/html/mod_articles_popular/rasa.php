<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_popular
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if (!$list)
{
	return;
}

?>
<ul class="mostread mod-list uk-list sideList">
<?php foreach ($list as $item) : ?>
	<li itemscope itemtype="https://schema.org/Article">
		<a href="<?php echo $item->link; ?>" itemprop="url" class="uk-text-small font f600 uk-flex">
            <i class="far fa-chevron-double-<?php echo JFactory::getLanguage()->isRtl() ? 'left':'right'; ?>"></i>
			<span itemprop="name">
				<?php echo $item->title; ?>
			</span>
		</a>
	</li>
<?php endforeach; ?>
</ul>