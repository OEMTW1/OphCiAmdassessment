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



<!-- <h4 class="elementTypeName"><?php echo $element->elementType->name ?></h4> -->

<div class="view">

<table class='subtleWhiteSmall smallText'>
<tr>
<th>
<?php echo CHtml::encode($element->getAttributeLabel('cf_cfs_right')); ?>
</th>
<th>
<?php echo CHtml::encode($element->getAttributeLabel('cf_cfs_left')); ?>
</th>
</tr>
<tr>
<td>
<?php if (!$element->cf_cfs_right) {?> <?php }?>
		<?php if (!$element->cf_cfs_right) {?>

		<?php }else{?>
				<?php foreach ($element->cf_cfs_right as $cf_cfs_right) {?>
					<?php echo $cf_cfs_right->name?><br/>
				<?php }?>
		<?php }?>
</div>
</td>
<td>
<?php if (!$element->cf_cfs_left) {?> <?php }?>
		<?php if (!$element->cf_cfs_left) {?>

		<?php }else{?>
				<?php foreach ($element->cf_cfs_left as $cf_cfs_left) {?>
					<?php echo $cf_cfs_left->name?><br/>
				<?php }?>
		<?php }?>

</td>
</tr>


<tr>
<td><?php echo $element->cf_comment_right ?></td>
<td><?php echo $element->cf_comment_left ?></td>
</tr>


</table>






</div>

<hr>






