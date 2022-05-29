<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Subform
 *
 * @copyright   (C) 2019 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

defined('_JEXEC') or die;

if (!$context || empty($field->subform_rows))
{
	return;
}

$result = '';

// Iterate over each row that we have
foreach ($field->subform_rows as $subform_row)
{
	// Placeholder array to generate this rows output
	$row_output = array();

	// Iterate over each sub field inside of that row
	foreach ($subform_row as $subfield)
	{
		$class   = trim($subfield->params->get('render_class', ''));
		$layout  = trim($subfield->params->get('layout', 'render'));
		$content = trim(
			FieldsHelper::render(
				$context,
				'field.' . $layout, // normally just 'field.render'
				array('field' => $subfield)
			)
		);

		// Skip empty output
		if ($content === '')
		{
			continue;
		}

		// Generate the output for this sub field and row
		$row_output[] = $content;
	}

	// Skip empty rows
	if (count($row_output) == 0)
	{
		continue;
	}

	$result .= implode(',', $row_output) . '\n';
}
?>

<?php if (trim($result) != '') : ?>
	<?php echo $result; ?>
<?php endif; ?>
