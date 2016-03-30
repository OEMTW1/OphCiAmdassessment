<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>


<?php
// keep this - shows how to indicate required fields
//echo CHtml::activeLabel($element, 'va_right', array('required' => true));
//echo $element->isAttributeRequired("va_right"); // useful!


 ?>


<div class="<?php echo $element->elementType->class_name?>">
<!-- <h4 class="elementTypeName"><?php echo $element->elementType->name ?></h4> -->
<table>

<tr>
<td>
	<?php echo $form->dropDownList($element,'va_right',$element->va_measure_list,array('empty'=>'- Please select -'))?>
	<?php echo $form->dropDownList($element,'aid_right',$element->va_option_list,array('empty'=>'- Please select -'))?>
</td>
<td>
	<?php echo $form->dropDownList($element,'va_left',$element->va_measure_list,array('empty'=>'- Please select -'))?>
	<?php echo $form->dropDownList($element,'aid_left',$element->va_option_list,array('empty'=>'- Please select -'))?>
</td>
</tr>


<tr>
<td>
	<?php echo $form->dropDownList($element,'va_right_aided',$element->va_measure_list,array('empty'=>'- Please select -'))?>
	<?php echo $form->dropDownList($element,'aid_right_aided',$element->va_aided_option_list,array('empty'=>'- Please select -'))?>
</td>
<td>
	<?php echo $form->dropDownList($element,'va_left_aided',$element->va_measure_list,array('empty'=>'- Please select -'))?>
	<?php echo $form->dropDownList($element,'aid_left_aided',$element->va_aided_option_list,array('empty'=>'- Please select -'))?>

</td>
</tr>




</table>

</div>

