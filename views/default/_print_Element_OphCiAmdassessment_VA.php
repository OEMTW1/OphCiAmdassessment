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




<div class="view">
<table style="font-size: 10pt;">
<tr>
<th><?php echo CHtml::encode($element->getAttributeLabel('va_right')); ?></th>
<th><?php echo CHtml::encode($element->getAttributeLabel('va_left')); ?></th>
</tr>
<tr>
<td><?php if(isset($element->measure_type_right->name)){echo $element->measure_type_right->name;}?></td>
<td><?php if(isset($element->measure_type_left->name)){echo $element->measure_type_left->name;}?></td>
</tr>
<tr>
<th><?php echo CHtml::encode($element->getAttributeLabel('aid_right')); ?></th>
<th><?php echo CHtml::encode($element->getAttributeLabel('aid_left')); ?></th>
</tr>
<tr>
<td><?php if(isset($element->aid_type_right->name)){echo $element->aid_type_right->name;}?></td>
<td><?php if(isset($element->aid_type_left->name)){echo $element->aid_type_left->name;}?></td>
</tr>
<tr>
<th><?php echo CHtml::encode($element->getAttributeLabel('va_right_aided')); ?></th>
<th><?php echo CHtml::encode($element->getAttributeLabel('va_left_aided')); ?></th>
</tr>
<tr>
<td><?php if(isset($element->measure_type_right_aided->name)){echo $element->measure_type_right_aided->name;}?></td>
<td><?php if(isset($element->measure_type_left_aided->name)){echo $element->measure_type_left_aided->name;}?></td>
</tr>
<tr>
<th><?php echo CHtml::encode($element->getAttributeLabel('aid_right_aided')); ?></th>
<th><?php echo CHtml::encode($element->getAttributeLabel('aid_left_aided')); ?></th>
</tr>
<tr>
<td><?php if(isset($element->aid_type_right_aided->name)){echo $element->aid_type_right_aided->name;}?></td>
<td><?php if(isset($element->aid_type_left_aided->name)){echo $element->aid_type_left_aided->name;}?></td>
</tr>
</table>





</div>



<!--

<h4 class="elementTypeName"><?php echo $element->elementType->name ?></h4>

<div class="view">

	<div class="col1">
		<div class="label"><?php echo CHtml::encode($element->getAttributeLabel('va_right')); ?></div>
		<div class="eventHighlight medium"><?php echo $element->va_right ?></div>
	</div>


	<div class="col1">
		<div class="label"><?php echo CHtml::encode($element->getAttributeLabel('va_right_aided')); ?></div>
		<div class="eventHighlight medium"><?php echo $element->va_right_aided ?></div>
	</div>


	<div class="col1">
		<div class="label"><?php echo CHtml::encode($element->getAttributeLabel('aid_right')); ?></div>
		<div class="eventHighlight medium"><?php if(isset($element->aid_type_right->name)){echo $element->aid_type_right->name;}?></div>
	</div>


<br>

	<div class="col1">
		<div class="label"><?php echo CHtml::encode($element->getAttributeLabel('va_left')); ?></div>
		<div class="eventHighlight medium"><?php echo $element->va_left ?></div>
	</div>




	<div class="col1">
		<div class="label"><?php echo CHtml::encode($element->getAttributeLabel('va_left_aided')); ?></div>
		<div class="eventHighlight medium"><?php echo $element->va_left_aided ?></div>
	</div>




	<div class="col1">
		<div class="label"><?php echo CHtml::encode($element->getAttributeLabel('aid_left')); ?></div>
		<div class="eventHighlight medium"><?php if(isset($element->aid_type_left->name)){echo $element->aid_type_left->name;}?></div>

	</div>


</div>

-->
<hr>
