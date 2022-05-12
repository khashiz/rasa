<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2019 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/* @var $formId int Form ID
 * @var $formOptions object Form options
 * @var $requiredMarker string Required marker
 * @var $showFormTitle int Form title parameters: 0 - hide, 1 - show
 */

if ($this->_form->GridLayout)
{
	require_once __DIR__ . '/grid/responsive.php';
	
	$grid = new RSFormProGridResponsive($this->_form->GridLayout, $formId, $formOptions, $requiredMarker, $showFormTitle);
	echo $grid->generate();
	return;
}
?>
<?php if ($showFormTitle) { ?>
<h2>{global:formtitle}</h2>
<?php } ?>
{error}
<?php foreach ($fieldsets as $page_num => $fields) { ?>
<!-- Do not remove this ID, it is used to identify the page so that the pagination script can work correctly -->
<fieldset class="formHorizontal formContainer" id="rsform_{global:formid}_page_<?php echo $page_num; ?>">
<?php
	if (!empty($fields['visible'])) {
		foreach ($fields['visible'] as $field) {
			// handle special hidden fields
			if ($this->getProperty($field['data'], 'LAYOUTHIDDEN', false)) {
				continue;
			}
			// retrieve the componentTypeId to check if is free text
			$componentTypeId = $this->getComponentType($field['data']['componentId'], $formId);
			
			$fieldName = $this->getProperty($field['data'], 'NAME');
			
			// detect if the field is a Captcha Field of any sort
			$captchaField = false;
			if (in_array($componentTypeId, RSFormProHelper::$captchaFields) && !empty($formOptions->RemoveCaptchaLogged)) {
				$captchaField = true;
			}
?>
<?php if ($captchaField) { ?>
	{if {global:userid} == "0"}
<?php } ?>
	<div class="rsform-block rsform-block-<?php echo JFilterOutput::stringURLSafe($fieldName)?>">
<?php if ($componentTypeId != RSFORM_FIELD_FREETEXT) { ?>
	<div class="formControlLabel"><?php if ($field['pagebreak']) { ?> &nbsp;<?php } else { ?>{<?php echo $fieldName; ?>:caption}<?php echo ($field['required'] ? '<strong class="formRequired">'.$requiredMarker.'</strong>' : ''); } ?></div>
		<div class="formControls">
<?php } ?>
			<div class="formBody">{<?php echo $fieldName; ?>:body}<?php if (!$field['pagebreak'] && $componentTypeId != RSFORM_FIELD_FREETEXT) { ?><span class="formValidation">{<?php echo $fieldName; ?>:validation}</span><?php } ?></div>
<?php
		if (!$field['pagebreak'] && $componentTypeId != RSFORM_FIELD_FREETEXT) {
?>
			<p class="formDescription">{<?php echo $fieldName; ?>:description}</p>
<?php } ?>
<?php if ($componentTypeId != RSFORM_FIELD_FREETEXT) { ?>
		</div>
<?php } ?>
	</div>
<?php if ($captchaField) { ?>
	{/if}
<?php } ?>
<?php
		}
	}
		
		if (!empty($fields['hidden'])) {
			foreach ($fields['hidden'] as $field) {
				$fieldName = $this->getProperty($field['data'], 'NAME'); ?>
	{<?php echo $fieldName; ?>:body}
<?php
			}
		}
?>
</fieldset>
<?php 
}