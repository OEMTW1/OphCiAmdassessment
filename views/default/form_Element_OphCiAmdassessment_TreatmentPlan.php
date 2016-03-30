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


<?
if ($api = Yii::app()->moduleAPI->get('OphTrAmdtreatmentnote')) {

	$tp_drug_list = $api->getInjectionDrugListCountAsInjection();

}
?>



<div class="<?php echo $element->elementType->class_name?>">
<!-- <h4 class="elementTypeName"><?php echo $element->elementType->name ?></h4> -->
<table>



<tr>
<td>
<!--	<?php echo $form->dropDownList($element,'tp_right',$element->tp_option_list,array('empty'=>'- Please select -'))?> -->

	<?php
	$options = OphCiAmdassessment_tpType::model()->findAll();
	$html_options = array('empty'=>'- Please select -', 'options' => array());
	foreach ($options as $opt) {
		$html_options['options'][(string) $opt->id] = array('count_as_treatment' => $opt->count_as_treatment);
	}
//	echo CHtml::activeDropDownList($element,'tp_right', CHtml::listData($options,'id','name'), $html_options);
	echo $form->dropDownList($element,'tp_right',$element->tp_option_list,$html_options)
	?>



</td>
<td>
<!--	<?php echo $form->dropDownList($element,'tp_left',$element->tp_option_list,array('empty'=>'- Please select -'))?> -->

	<?php
	$options = OphCiAmdassessment_tpType::model()->findAll();
	$html_options = array('empty'=>'- Please select -', 'options' => array());
	foreach ($options as $opt) {
		$html_options['options'][(string) $opt->id] = array('count_as_treatment' => $opt->count_as_treatment);
	}
//	echo CHtml::activeDropDownList($element,'tp_left', CHtml::listData($options,'id','name'), $html_options);
	echo $form->dropDownList($element,'tp_left',$element->tp_option_list,$html_options)
	?>



</td>
</tr>

<tr>
<td>
<!--	<?php if(isset($tp_drug_list)){echo $form->dropDownList($element,'tp_drug_right',$tp_drug_list,array('empty'=>'- Please select -'));}?>  -->

<div class="sub-element-fields" id="div_<?php echo CHtml::modelName($element)?>_tp_drug_right"<?php if (!($element->tp_type_right && $element->tp_type_right->count_as_treatment == "1")) {?> style="display: none;"<?php }?>>
	<?php if(isset($tp_drug_list)){echo $form->dropDownList($element,'tp_drug_right',$tp_drug_list,array('empty'=>'- Please select -'));}?> 
</div>

</td>


<td>
<!--	<?php if(isset($tp_drug_list)){echo $form->dropDownList($element,'tp_drug_left',$tp_drug_list,array('empty'=>'- Please select -'));}?>  -->

<div class="sub-element-fields" id="div_<?php echo CHtml::modelName($element)?>_tp_drug_left"<?php if (!($element->tp_type_left && $element->tp_type_left->count_as_treatment == "1")) {?> style="display: none;"<?php }?>>
	<?php if(isset($tp_drug_list)){echo $form->dropDownList($element,'tp_drug_left',$tp_drug_list,array('empty'=>'- Please select -'));}?> 
</div>
</td>
</tr>


<tr>
<td>
	<?php echo $form->textArea($element,'tp_comment_right',array('rows' => 1, 'cols' => 40))?>
</td>
<td>
	<?php echo $form->textArea($element,'tp_comment_left',array('rows' => 1, 'cols' => 40))?>
</td>

</tr>




</table>

</div>



