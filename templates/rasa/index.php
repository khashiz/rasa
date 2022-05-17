<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.cassiopeia
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
JHtml::_('jquery.framework');

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

$app  = JFactory::getApplication();
$user = JFactory::getUser();
$params = $app->getTemplate(true)->params;
$menu = $app->getMenu();
$active = $menu->getActive();

$pageparams = $menu->getParams( $active->id );
$pageclass = $pageparams->get( 'pageclass_sfx' );

// Add CSS
if ($this->direction == 'rtl') {
    JHtml::_('stylesheet', 'uikit-rtl.min.css', array('version' => 'auto', 'relative' => true));
} else {
    JHtml::_('stylesheet', 'uikit.min.css', array('version' => 'auto', 'relative' => true));
}
JHtml::_('stylesheet', 'fontawesome.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'brands.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'light.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'regular.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'solid.min.css', array('version' => 'auto', 'relative' => true));
JHtml::_('stylesheet', 'rasa.css', array('version' => 'auto', 'relative' => true));

// Add js
JHtml::_('script', 'uikit.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'uikit-icons.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'particles.min.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'plyr.js', array('version' => 'auto', 'relative' => true));
JHtml::_('script', 'custom.js', array('version' => 'auto', 'relative' => true));

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu     = $app->getMenu()->getActive();
$pageclass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
$netparsi = "<a href='https://netparsi.com' class='uk-text-primary netparsi' target='_blank' rel='nofollow'>".JTEXT::sprintf('NETPARSI')."</a>";

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="metas" />
	<jdoc:include type="styles" />
	<jdoc:include type="scripts" />
</head>
<body class="<?php echo $option . ' view-' . $view . ($layout ? ' layout-' . $layout : ' no-layout') . ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') . ($pageclass ? ' ' . $pageclass : '') . ($this->direction == 'rtl' ? ' rtl' : ''); ?>">
    <header>
        <div class="uk-background-secondary uk-text-zero bar">
            <div class="uk-container">
                <div>
                    <div class="uk-child-width-auto uk-flex-between" data-uk-grid>
                        <div class="uk-flex uk-flex-middle">
                            <span class="uk-text-tiny uk-text-muted font uk-display-inline-block uk-margin-left">ما را دنبال کنبد :</span>
                            <ul class="uk-grid-small uk-child-width-auto socials" data-uk-grid>
                                <?php foreach ($params->get('socials') as $item) : ?>
                                    <?php if ($item->icon != '') { ?>
                                        <li><a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" data-uk-tooltip class="uk-flex uk-flex-center uk-flex-middle" target="_blank" id="<?php echo $item->title; ?>"><i class="fab fa-<?php echo $item->icon; ?>"></i></a></li>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <jdoc:include type="modules" name="lang" style="xhtml" />
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="uk-container">
                <div class="wrapper">
                    <div class="uk-grid-collapse" data-uk-grid>
                        <div class="uk-width-auto uk-hidden@m uk-flex uk-flex-middle">
                            <div class="uk-padding-small uk-padding-remove-horizontal uk-height-1-1">
                                <a href="#hamMenu" data-uk-toggle class="uk-button uk-button-default uk-padding-small uk-box-shadow-small uk-border-rounded uk-line-height-zero"><i class="far fa-bars fa-fw"></i></a>
                            </div>
                        </div>
                        <div class="uk-width-auto uk-visible@m">
                            <a href="<?php echo JUri::base(); ?>" title="<?php echo $sitename; ?>" class="uk-display-inline-block uk-padding-small uk-padding-remove-horizontal logo"><img src="<?php echo JUri::base().'images/logo-rtl.svg'; ?>" width="95" height="70" alt="<?php echo $sitename; ?>" data-uk-svg></a>
                        </div>
                        <div class="uk-width-expand uk-hidden@m uk-flex uk-flex-middle uk-flex-center">
                            <a href="<?php echo JUri::base(); ?>" title="<?php echo $sitename; ?>" class="uk-display-inline-block uk-padding-small uk-padding-remove-horizontal logo"><img src="<?php // echo JUri::base().'images/sprite.svg#logo'; ?>" width="" height="40" alt="<?php echo $sitename; ?>" data-uk-svg></a>
                        </div>
                        <div class="uk-width-expand uk-flex uk-flex-middle uk-flex-left uk-visible@m">
                            <div class="uk-grid-large uk-child-width-auto uk-flex-left" data-uk-grid>
                                <?php if (!empty($params->get('phone')) || !empty($params->get('email')) || !empty($params->get('fax'))) { ?>
                                    <div>
                                        <div class="uk-child-width-auto uk-grid-medium uk-grid-divider" data-uk-grid>
                                            <?php if (!empty($params->get('phone'))) { ?>
                                                <div>
                                                    <div class="uk-grid-small" data-uk-grid>
                                                        <div class="uk-width-auto uk-flex uk-flex-middle uk-text-primary"><i class="fal fa-phone fa-flip-horizontal fa-2x"></i></div>
                                                        <div class="uk-width-expand">
                                                            <div>
                                                                <span class="uk-display-block uk-text-tiny font f500 uk-text-muted"><?php echo JText::_('OURPHONE'); ?></span>
                                                                <span class="uk-display-block uk-text-small font f700 uk-text-black ltr"><?php $array = preg_split('/\n|\r\n/', $params->get('phone')); echo $array[0]; ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($params->get('email'))) { ?>
                                                <div>
                                                    <div class="uk-grid-small" data-uk-grid>
                                                        <div class="uk-width-auto uk-flex uk-flex-middle uk-text-primary"><i class="fal fa-envelope-open-text fa-flip-horizontal fa-2x"></i></div>
                                                        <div class="uk-width-expand">
                                                            <div>
                                                                <span class="uk-display-block uk-text-tiny font f500 uk-text-muted"><?php echo JText::_('OUREMAIL'); ?></span>
                                                                <span class="uk-display-block uk-text-small font f700 uk-text-black ltr"><?php echo $params->get('email'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($params->get('fax'))) { ?>
                                                <div>
                                                    <div class="uk-grid-small" data-uk-grid>
                                                        <div class="uk-width-auto uk-flex uk-flex-middle uk-text-primary"><i class="fal fa-fax fa-flip-horizontal fa-2x"></i></div>
                                                        <div class="uk-width-expand">
                                                            <div>
                                                                <span class="uk-display-block uk-text-tiny font f500 uk-text-muted"><?php echo JText::_('OURFAX'); ?></span>
                                                                <span class="uk-display-block uk-text-small font f700 uk-text-black ltr"><?php echo $params->get('fax'); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-background-white" data-uk-sticky="start: 200%; animation: uk-animation-slide-top">
            <div class="uk-container">
                <div class="uk-grid-collapse" data-uk-grid>
                    <div class="uk-width-expand"><jdoc:include type="modules" name="nav" style="html5" /></div>
                    <div class="uk-width-auto"><jdoc:include type="modules" name="search" style="html5" /></div>
                </div>
            </div>
        </div>
	</header>
    <jdoc:include type="modules" name="mobilesearch" style="html5" />
    <?php if ($pageparams->get('show_page_heading', 0)) { ?>
        <section class="uk-padding-large uk-padding-remove-horizontal uk-background-secondary uk-position-relative pageHead">
            <span class="uk-position-cover" id="hParticles"></span>
            <div class="uk-position-relative">
                <div class="uk-container">
                    <h2 class="font f900 uk-text-center uk-h1 uk-text-white uk-text-heavy"><?php echo $pageparams->get('page_heading'); ?></h2>
                    <jdoc:include type="modules" name="breadcrumbs" style="html5" />
                </div>
            </div>
        </section>
    <?php } ?>
    <?php if ($this->countModules('topout', true)) : ?>
        <jdoc:include type="modules" name="topout" style="html5" />
    <?php endif; ?>
    <main class="<?php if ($pageparams->get('mainpadding')) { echo 'uk-padding-large uk-padding-remove-horizontal';} ?>">
        <?php if ($this->countModules('topin', true)) : ?>
            <jdoc:include type="modules" name="topin" style="html5" />
        <?php endif; ?>
        <div class="<?php echo $pageparams->get('gridsize', '') ?>">
            <div class="uk-grid-divider" data-uk-grid>
                <?php if ($this->countModules('sidestart', true)) : ?>
                    <aside class="uk-width-1-1 uk-width-1-4@m uk-visible@m">
                        <div data-uk-sticky="offset: 92; bottom: true;">
                            <div class="uk-child-width-1-1" data-uk-grid><jdoc:include type="modules" name="sidestart" style="none" /></div>
                        </div>
                    </aside>
                <?php endif; ?>
                <article class="uk-width-1-1 uk-width-expand@m">
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                </article>
                <?php if ($this->countModules('sideend', true)) : ?>
                    <aside class="uk-width-1-1 uk-width-1-4@m"><jdoc:include type="modules" name="sideend" style="none" /></aside>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php if ($this->countModules('bottomout', true)) : ?>
        <jdoc:include type="modules" name="bottomout" style="html5" />
    <?php endif; ?>
    <footer class="uk-background-secondary uk-position-relative">
        <span class="uk-position-cover" id="fParticles"></span>
        <div class="uk-padding uk-padding-remove-horizontal uk-position-relative modules">
            <div class="uk-container">
                <div class="uk-grid-larg uk-flex-between uk-child-width-auto" data-uk-grid>
                    <div class="uk-width-expand">
                        <div class="uk-margin-bottom borderedSection">
                            <span class="uk-display-block uk-text-primary uk-h4 uk-margin-small-bottom font">با ما تماس بگیرید</span>
                            <a href="" class="uk-display-block uk-text-white uk-text-right font ltr">(+۹۸۲۱) ۳۴۵۶ ۸۷۵۹</a>
                        </div>
                        <jdoc:include type="modules" name="newsletter" style="html5" />
                        <ul class="uk-grid-small uk-child-width-auto uk-margin-medium-top socials" data-uk-grid>
                            <?php foreach ($params->get('socials') as $item) : ?>
                                <?php if ($item->icon != '') { ?>
                                    <li><a href="<?php echo $item->link; ?>" title="<?php echo $item->title; ?>" data-uk-tooltip class="uk-flex uk-flex-center uk-flex-middle" target="_blank" id="<?php echo $item->title; ?>"><i class="fab fa-<?php echo $item->icon; ?>"></i></a></li>
                                <?php } ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <jdoc:include type="modules" name="footer" style="html5" />
                    <div class="uk-width-1-1 uk-width-1-4@m help">
                        <h4>به کمک نیاز دارید ؟</h4>
<!--                        <div class="uk-cover-container uk-margin-bottom">-->
<!--                            <canvas width="400" height="150"></canvas>-->
<!--                            <img src="images/footer.png" alt="" uk-cover>-->
<!--                        </div>-->
                        <div class="uk-text-small uk-text-muted font">
                            <p>کارشناسان زبده ما آماده اند تا شما را برای دریافت بهترین خدمات راهنمایی کنند. کافیست تا درخواست خود را براما ارسال نمایید.</p>
                            <a href="#" class="uk-display-inline-block font">ارسال درخواست<i class="far fa-chevron-double-left"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-text-center uk-text-right@m  uk-position-relative copyright">
            <div class="uk-container">
                <div class="uk-padding uk-padding-remove-horizontal wrapper">
                    <div class="uk-grid-row-collapse uk-grid-column-medium" data-uk-grid>
                        <div class="uk-width-1-1 uk-width-expand@m">
                            <p class="uk-margin-remove uk-text-small uk-text-muted font"><?php echo JText::sprintf('COPYRIGHT', $sitename); ?></p>
                        </div>
                        <div class="uk-width-1-1 uk-width-auto@m">
                            <p class="uk-margin-remove uk-text-small uk-text-muted font"><?php echo JText::sprintf('DEVELOPER', $netparsi); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="hamMenu" data-uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar uk-card uk-card-default uk-padding-remove bgWhite">
            <div class="uk-flex uk-flex-column uk-height-1-1">
                <div class="uk-width-expand">
                    <div class="offcanvasTop uk-box-shadow-small uk-position-relative uk-flex-stretch">
                        <div class="uk-grid-collapse uk-height-1-1" data-uk-grid>
                            <div class="uk-flex uk-width-1-4 uk-flex uk-flex-center uk-flex-middle"><a onclick="UIkit.offcanvas('#hamMenu').hide();" class="uk-flex uk-flex-center uk-flex-middle uk-height-1-1 uk-width-1-1 uk-margin-remove"><i class="far fa-chevron-right"></i></a></div>
                            <div class="uk-flex uk-width-expand uk-flex uk-flex-right uk-flex-middle uk-text-white logo">logo here</div>
                        </div>
                    </div>
                    <div class="uk-padding-small"><jdoc:include type="modules" name="offcanvas" style="xhtml" /></div>
                </div>
            </div>
        </div>
    </div>
	<jdoc:include type="modules" name="debug" style="none" />
    <?php /* ?>
    <?php if ($pageclass == "home") { ?>
    <script type="text/javascript">
        jQuery(document).ready(function (){
            UIkit.modal("#newYear").show();
        });
    </script>
    <?php } ?>
    <div id="newYear" data-uk-modal>
        <div class="uk-modal-dialog uk-box-shadow-medium uk-border-rounded uk-overflow-hidden">
            <div class="uk-modal-header uk-padding-small">
                <h5 class="uk-modal-title uk-text-center font uk-text-bold uk-text-primary">سال نو مبارک</h5>
            </div>
            <div class="uk-modal-body uk-padding-remove">
                <style>.r1_iframe_embed {position: relative; overflow: hidden; width: 100%; height: auto; padding-top: 56.25%; } .r1_iframe_embed iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }</style><div class="r1_iframe_embed"><iframe src="https://player.arvancloud.com/index.html?config=https://tavanresan.arvanvod.com/EWe2pMbwN0/D7b8MJzVMJ/origin_config.json" style="border:0 #ffffff none;" name="نوروز ۱۴۰۱" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" data-uk-video></iframe></div>
            </div>
        </div>
    </div>
    <?php */ ?>

</body>
</html>











