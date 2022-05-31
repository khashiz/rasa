<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<a class="uk-display-block uk-link-reset" href="<?php echo $item->link; ?>">
    <span class="uk-margin-auto uk-border-circle uk-box-shadow-small uk-flex uk-flex-middle uk-flex-center uk-text-primary icon"><i class="far fa-<?php echo json_decode($item->urls)->urlatext; ?> fa-fw fa-3x"></i></span>
    <span class="uk-margin-top uk-text-white title font f700 uk-display-block"><?php echo $item->title; ?></span>
</a>