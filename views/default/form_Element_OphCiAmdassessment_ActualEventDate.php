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

if(! isset($this->event->episode->id)){
//	$firm = Firm::model()->findByPk(Yii::app()->session['selected_firm_id']);
	$firm = Firm::model()->findByPk($this->selectedFirmId);
	$patientId = $this->patient->id;
	$subspecialtyId = $firm->serviceSubspecialtyAssignment->subspecialty_id;
	$episode = Episode::model()->getBySubspecialtyAndPatient($subspecialtyId, $patientId, true);
//	if($episode){$episodeId = $episode->id;}
} else {
	$episode = $this->event->episode;
//	$episodeId = $this->event->episode->id;
}


if(isset($episode)){
	
$events = Event::model()->findAll(array('condition'=>'episode_id=:episodeid', 'params'=>array(':episodeid'=>$episode->id)));

if (!empty($events)) {

?>

<!--<h4 class="elementTypeName"><?php echo "Summary" ?></h4> -->

<div class="eventHighlight">

<?

/*
$this->widget('application.components.summaryWidgets.' . 'amdSummaryChart', array(
   'episode' => $episode
	));
*/

/*
$this->widget('application.components.summaryWidgets.' . 'amdDiagnosisSummary', array(
   'episode_id' => $episodeId
	));
*/

?>

</div>

<?

}}


?>


<div class="<?php echo $element->elementType->class_name?>">
<!-- <h4 class="elementTypeName"><?php echo $element->elementType->name ?></h4> -->



<?php echo $form->datePicker($element,'actual_event_date',array(),array())?>



