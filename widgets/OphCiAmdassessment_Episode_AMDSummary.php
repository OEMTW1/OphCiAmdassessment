<?php
/**
 * (C) OpenEyes Foundation, 2014
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (C) 2014, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class OphCiAmdassessment_Episode_AMDSummary extends EpisodeSummaryWidget
{


	// EJM (31/07/2014) Code copied/converted from original approach to episode summary widget
	// run() function corresponds to protected/components/summarywidgets/amdSummaryChart.php
	// renderSummary() function corresponds to protected/components/summarywidgets/views/amdSummaryChart.php

	public function run()
	{

		if (!isset($this->episode)) {
			return;
//			throw new CHttpException(403, 'There is no episode.');
		}

		if (empty($this->episode)) {
			return;
//			throw new CHttpException(403, 'There is no episode.');
		}


		// Return ALL events for the episode regardless of event type, explicitly order by datetime
		$events = Event::model()->findAll(array('condition'=>'episode_id=:episodeid', 'params'=>array(':episodeid'=>$this->episode->id), 'order'=>'created_date'));

		if (empty($events)) {
			return;
			//throw new CHttpException(403, 'No events found.');
		}



		$arrChartData = Array();

		$i = 0;

		if (!empty($events)) { // For each event for this episode get element values

			foreach ($events as $event) {

				// Pre-populating the array ensures that multiple charts' x axes are vertically aligned for all elements across different event types
				$arrChartData[$i]['event_id'] = $event->id;
				$arrChartData[$i]['event_date'] = $event->created_date;
				$arrChartData[$i]['event_date_NHS'] = $event->NHSDate('created_date');

//				$arrChartData[$i]['last_modified_date'] = $event->last_modified_date;
//				$arrChartData[$i]['last_modified_date_NHS'] = $event->NHSDate('last_modified_date');



				$element = Element_OphCiAmdassessment_VA::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){

					$va_right = 0;
					$va_left = 0;
					$va_right_aided = 0;
					$va_left_aided = 0;
					if(isset($element->measure_type_right->count_as_va)){$va_right = $element->measure_type_right->count_as_va;}
					if(isset($element->measure_type_left->count_as_va)){$va_left = $element->measure_type_left->count_as_va;}
					if(isset($element->measure_type_right_aided->count_as_va)){$va_right_aided = $element->measure_type_right_aided->count_as_va;}
					if(isset($element->measure_type_left_aided->count_as_va)){$va_left_aided = $element->measure_type_left_aided->count_as_va;}

					$arrChartData[$i]['right_lc'] = max($va_right,$va_right_aided);
					$arrChartData[$i]['left_lc'] =max($va_left,$va_left_aided);


				}


				$element = Element_OphCiAmdassessment_AMDStatus::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){

					if(isset($element->status_type_right->name)){$arrChartData[$i]['right_status'] = $element->status_type_right->name;}
					if(isset($element->status_type_left->name)){$arrChartData[$i]['left_status'] = $element->status_type_left->name;}

				}

				$element = Element_OphCiAmdassessment_TreatmentPlan::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){

					if(isset($element->tp_type_right->name)){$arrChartData[$i]['right_tp'] = $element->tp_type_right->name;}
					if(isset($element->tp_type_left->name)){$arrChartData[$i]['left_tp'] = $element->tp_type_left->name;}

				}


				$element = Element_OphCiAmdassessment_CRT::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){
					if(isset($element->crt_right)){$arrChartData[$i]['right_crt'] = $element->crt_right;}
					if(isset($element->crt_left)){$arrChartData[$i]['left_crt'] = $element->crt_left;}
				}

				$element = Element_OphTrAmdtreatmentnote_Injection::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){

					if(isset($element->injection_type_right->count_as_injection)){
						$arrChartData[$i]['right_injection'] = $element->injection_type_right->count_as_injection;
					}

					if(isset($element->injection_type_left->count_as_injection)){
						$arrChartData[$i]['left_injection'] = $element->injection_type_left->count_as_injection;
					}


					if(isset($element->injection_type_right->name)){
						$arrChartData[$i]['right_injection_desc'] = $element->injection_type_right->name;
					}


					if(isset($element->injection_type_left->name)){
						$arrChartData[$i]['left_injection_desc'] = $element->injection_type_left->name;
					}

					if(isset($element->injection_type_right->count_as_chart)){
						$arrChartData[$i]['right_injection_shortdesc'] = $element->injection_type_right->count_as_chart;
					}


					if(isset($element->injection_type_left->count_as_chart)){
						$arrChartData[$i]['left_injection_shortdesc'] = $element->injection_type_left->count_as_chart;
					}


				}

				$element = Element_OphCiDiagnosis_Diagnosis::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){

					if(isset($element->eye_id)){$arrChartData[$i]['eye_id'] = $element->eye_id;}
					if(isset($element->disorder_id)){$arrChartData[$i]['disorder_id'] = $element->disorder_id;}
					if(isset($element->eye->name)){$arrChartData[$i]['eye'] = $element->eye->name;}
					if(isset($element->disorder->term)){$arrChartData[$i]['disorder'] = $element->disorder->term;}
				}

				$element = Element_OphMiEpisodenote_EpisodeLog::model()->find('event_id = ?', array($event->id));
				if (!empty($element)){
					if(isset($element->log_comment)){$arrChartData[$i]['log_comment'] = $element->log_comment;}
				}




				$i = $i + 1;

			}

		}

        $this->render('OphCiAmdassessment_Episode_AMDSummary', array('arrChartData' => $arrChartData));

}


	protected function renderSummary($arrChartData){


// Put dates and values into an array suitable for jqplot


$data1L = Array();
$data2L = Array();
$data3L = Array();

$data1R = Array();
$data2R = Array();
$data3R = Array();


$XMin = $arrChartData[0]['event_date']; 
$XMax = $arrChartData[count($arrChartData) - 1]['event_date'];
$XMinE = explode("-",$XMin);
$XMin = $XMinE[0] . "-" . $XMinE[1] . "-01 00:00:00";  // Start at first day of the month, assumes YYYY-MM-DD date format


$XInterval = "1 month";
$XFormat = "%b";
$XDiffDays = round(abs(strtotime($XMax)-strtotime($XMin))/60/60/24);
if ($XDiffDays > (547)){ // > 18 months duration, change X interval and label format
	$XInterval = "1 year";
	$XFormat = "%b %Y";
}



$i = 0;


foreach($arrChartData AS $var => $row) {

	// EJM (20/11/2012) ?Pending release.  Added 3rd item for data point label, empty for all but injections and even then only one char, requires pointLabels.js
	// (It doesn't seem as though the type of injection can be put into the content of the highlighter tooltips which would have been preferable.)


	if(isset($row['right_lc'])){$data1R[$i] = array($row['event_date'],$row['right_lc'],'');} else {$data1R[$i] = array($row['event_date'],-99,'');} // i.e. array(date,value)
	if(isset($row['left_lc'])){$data1L[$i] = array($row['event_date'],$row['left_lc'],'');} else {$data1L[$i] = array($row['event_date'],-99,'');}

	if(isset($row['right_crt'])){$data2R[$i] = array($row['event_date'],min(array($row['right_crt'],600)),'');} else {$data2R[$i] = array($row['event_date'],-99,'');}
	if(isset($row['left_crt'])){$data2L[$i] = array($row['event_date'],min(array($row['left_crt'],600)),'');} else {$data2L[$i] = array($row['event_date'],-99,'');}

	if(isset($row['right_injection'])){$data3R[$i] = array($row['event_date'],(($row['right_injection'] * 100) -99),$row['right_injection_shortdesc']);} else {$data3R[$i] = array($row['event_date'],-99,'');}
	if(isset($row['left_injection'])){$data3L[$i] = array($row['event_date'],(($row['left_injection'] * 100) -99),$row['left_injection_shortdesc']);} else {$data3L[$i] = array($row['event_date'],-99,'');}

/*
	if(isset($row['right_lc'])){$data1R[$i] = array($row['event_date'],$row['right_lc']);} else {$data1R[$i] = array($row['event_date'],-99);} // i.e. array(date,value)
	if(isset($row['left_lc'])){$data1L[$i] = array($row['event_date'],$row['left_lc']);} else {$data1L[$i] = array($row['event_date'],-99);}

	if(isset($row['right_crt'])){$data2R[$i] = array($row['event_date'],min(array($row['right_crt'],600)));} else {$data2R[$i] = array($row['event_date'],-99);}
	if(isset($row['left_crt'])){$data2L[$i] = array($row['event_date'],min(array($row['left_crt'],600)));} else {$data2L[$i] = array($row['event_date'],-99);}

	if(isset($row['right_injection'])){$data3R[$i] = array($row['event_date'],(($row['right_injection'] * 100) -99));} else {$data3R[$i] = array($row['event_date'],-99);}
	if(isset($row['left_injection'])){$data3L[$i] = array($row['event_date'],(($row['left_injection'] * 100) -99));} else {$data3L[$i] = array($row['event_date'],-99);}

*/

	$i = $i + 1;
}



if((count($data1R) <= 0) && (count($data2R) <= 0)){return;} // Stop now if no data



// Display the chart(s)

echo "<table class='subtleWhite smallText'><tr><td>";


$this->widget('application.extensions.jqplot.JqplotGraphWidget', 
array('data'=>array($data1R,$data2R,$data3R),
      'options'=>array(
			'title'=>'R',
			'series'=>array(array(
						'showLine'=>false,
						'label'=>'VA',
						'markerOptions'=>array('size'=>7, 'style'=>'x', 'color'=>'')),
					array(
						'showLine'=>false,
						'label'=>'CMT',
						'yaxis'=>'y2axis',
						'markerOptions'=>array('size'=>7, 'style'=>'x', 'color'=>'')),
					array(

						'showLine'=>false,
						'label'=>'INJ',
						'markerOptions'=>array('size'=>7, 'style'=>'diamond', 'color'=>'#FF0000'))

					),

			'axes'=>array(
					'xaxis'=>array(
							'min'=>$XMin,
							'max'=>$XMax,
							'renderer'=>'js:$.jqplot.DateAxisRenderer',
							'tickInterval'=>$XInterval,
							'tickOptions'=>array('formatString'=>$XFormat, 'show'=>true)
					),
					'yaxis'=>array(
							'useSeriesColor'=>true,
							'label'=>'VA',
							'min'=>0,
							'max'=>120,
							'tickInterval'=>10,'tickOptions'=>array('formatString'=>'%d')
					),
					'y2axis'=>array(
							'useSeriesColor'=>true,

							'min'=>0,
							'max'=>600,
							'tickInterval'=>50,'tickOptions'=>array('formatString'=>'%d')
					),

			),
			'highlighter'=>array(
					'show'=>true,
					'tooltipAxes'=>'y',
					'useAxesFormatters'=>false,
					'tooltipFormatString'=>'%d'
			),

	),

        'htmlOptions'=>array(
               'style'=>'width:400px;height:250px;'
        ),
        'pluginScriptFile'=>array(
            'jqplot.dateAxisRenderer.js',
            'jqplot.pointLabels.js',
            'jqplot.highlighter.js')
    )
);



echo "</td><td>";


$this->widget('application.extensions.jqplot.JqplotGraphWidget', 
array('data'=>array($data1L,$data2L,$data3L),
      'options'=>array(
			'title'=>'L',
			'series'=>array(array(
						'showLine'=>false,
						'markerOptions'=>array('size'=>7, 'style'=>'x', 'color'=>'')),
					array(
						'showLine'=>false,
						'yaxis'=>'y2axis',
						'markerOptions'=>array('size'=>7, 'style'=>'x', 'color'=>'')),
					array(
						'showLine'=>false,
						'markerOptions'=>array('size'=>7, 'style'=>'diamond', 'color'=>'#FF0000'))

					),
			'axes'=>array(
					'xaxis'=>array(
							'min'=>$XMin,
							'max'=>$XMax,
							'renderer'=>'js:$.jqplot.DateAxisRenderer',
							'tickInterval'=>$XInterval,
							'tickOptions'=>array('formatString'=>$XFormat, 'show'=>true)
					),
					'yaxis'=>array(
							'useSeriesColor'=>true,

							'min'=>0,
							'max'=>120,

							'tickInterval'=>10,'tickOptions'=>array('formatString'=>'%d')
					),
					'y2axis'=>array(
							'useSeriesColor'=>true,
							'label'=>'CMT',
							'min'=>0,
							'max'=>600,
							'tickInterval'=>50,'tickOptions'=>array('formatString'=>'%d')
					),


			),
			'highlighter'=>array(
					'show'=>true,
					'tooltipAxes'=>'y',
					'useAxesFormatters'=>false,
					'tooltipFormatString'=>'%d'
			),

	),

        'htmlOptions'=>array(
               'style'=>'width:400px;height:250px;'
        ),
        'pluginScriptFile'=>array(
            'jqplot.dateAxisRenderer.js',
            'jqplot.pointLabels.js',
            'jqplot.highlighter.js')
    )
);




echo "</tr>";
//echo "</tr></table>";






$j = 0;
$concat_right = Array();
$concat_left = Array();
foreach($arrChartData AS $var => $row) {

	if((isset($row['right_injection_desc'])) && (isset($row['left_injection_desc']))){


		if($row['right_injection']){$concat_right[$j] = $row['right_injection_desc'];}
		if($row['left_injection']){$concat_left[$j] = $row['left_injection_desc'];}

		$j = $j + 1;


	}

}






if ($j > 0){

	$sum_right = array_count_values($concat_right);
	$sum_left = array_count_values($concat_left);

//	echo "<table class='subtleWhite smallText'>";
	echo "<tr>";
	echo "<th>";
	echo "Injections (R)";
	echo "</th>";
	echo "<th>";
	echo "Injections (L)";
	echo "</th>";
	echo "</tr>";




	echo "<tr>";

	echo "<td>";

	echo "<table>";
	foreach($sum_right AS $desc => $count) {
		echo "<tr>";
		echo "<td>";
		echo $desc;
		echo "</td>";
		echo "<td>";
		echo $count;
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";

	echo "</td>";
	echo "<td>";

	echo "<table>";
	foreach($sum_left AS $desc => $count) {
		echo "<tr>";
		echo "<td>";
		echo $desc;
		echo "</td>";
		echo "<td>";
		echo $count;
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";

	echo "</td>";
	echo "</tr>";
//	echo "</table>";
}




$k = 0;

foreach($arrChartData AS $var => $row) {

	if((isset($row['disorder_id'])) && (isset($row['eye_id']))){


		if ($k ==0){
//			echo "<table class='subtleWhite smallText'>";
			echo "<tr>";
//			echo "<th>";
//			echo "Date";
//			echo "</th>";
			echo "<th>";
			echo "Diagnosis (R)";
			echo "</th>";
			echo "<th>";
			echo "Diagnosis (L)";
			echo "</th>";
			echo "</tr>";
			$k = $k + 1;
		}


		echo "<tr>";

//		echo "<td>";
//		echo $row['event_date_NHS'];
//		echo "</td>";

		if($row['eye_id']==2){
			echo "<td>";
//			echo $row['disorder'];
//			echo $row['event_date_NHS']. ": \n".$row['disorder'];
			echo $row['disorder'] . " (" . $row['event_date_NHS'] . ")";
			echo "</td>";
			echo "<td>";
			echo "";
			echo "</td>";
		} else if($row['eye_id']==1){
			echo "<td>";
			echo "";
			echo "</td>";
			echo "<td>";
//			echo $row['disorder'];
//			echo $row['event_date_NHS']. ": ".$row['disorder'];
			echo $row['disorder'] . " (" . $row['event_date_NHS'] . ")";
			echo "</td>";

		} else if($row['eye_id']==3){
			echo "<td>";
//			echo $row['disorder'];
//			echo $row['event_date_NHS']. ": ".$row['disorder'];
			echo $row['disorder'] . " (" . $row['event_date_NHS'] . ")";
			echo "</td>";
			echo "<td>";
//			echo $row['disorder'];
//			echo $row['event_date_NHS']. ": ".$row['disorder'];
			echo $row['disorder'] . " (" . $row['event_date_NHS'] . ")";
			echo "</td>";

		} else {
			echo "<td>";
			echo "";
			echo "</td>";
			echo "<td>";
			echo "";
			echo "</td>";
		}


		echo "</tr>";
	}

}
//echo "</table>";









foreach($arrChartData AS $var => $row) {

	if((isset($row['right_status'])) && (isset($row['left_status']))){

		$status_right = $row['right_status'];
		$status_left = $row['left_status'];
	}
}

if((isset($status_right)) && (isset($status_left))){

//	echo "<table class='subtleWhite smallText'>";
	echo "<tr>";
	echo "<th>";
	echo "Most Recent Status (R)";
	echo "</th>";
	echo "<th>";
	echo "Most Recent Status (L)";
	echo "</th>";
	echo "</tr>";


	echo "<tr>";

	echo "<td>";
	echo $status_right;
	echo "</td>";
	echo "<td>";
	echo $status_left;
	echo "</td>";


	echo "</tr>";

}
//echo "</table>";



foreach($arrChartData AS $var => $row) {

	if((isset($row['right_tp']))){
		$tp_right = $row['right_tp'];
	}


	if((isset($row['right_tp']))){
		$tp_left = $row['left_tp'];
	}



}

if((isset($tp_right)) || (isset($tp_left))){

//	echo "<table class='subtleWhite smallText'>";
	echo "<tr>";
	echo "<th>";
	echo "Most Recent Treatment Plan (R)";
	echo "</th>";
	echo "<th>";
	echo "Most Recent Treatment Plan (L)";
	echo "</th>";
	echo "</tr>";


	echo "<tr>";

	echo "<td>";
	if((isset($tp_right))){echo $tp_right;}
	echo "</td>";
	echo "<td>";
	if((isset($tp_left))){echo $tp_left;}
	echo "</td>";


	echo "</tr>";

}
//echo "</table>";




/*
$m = 0;

foreach($arrChartData AS $var => $row) {

	if((isset($row['right_tp'])) || (isset($row['left_tp']))){


		if ($m ==0){
			echo "<table class='subtleWhite smallText'>";
			echo "<tr>";
			echo "<th>";
			echo "Treatment Plan (R)";
			echo "</th>";
			echo "<th>";
			echo "Treatment Plan (L)";
			echo "</th>";
			echo "</tr>";
			$m = $m + 1;
		}


		echo "<tr>";

		echo "<td>";
		if(isset($row['right_tp'])){echo $row['right_tp'];}
		echo "</td>";

		echo "<td>";
		if(isset($row['left_tp'])){echo $row['left_tp'];}
		echo "</td>";


		echo "</tr>";
	}

}
echo "</table>";
*/


$l = 0;

foreach($arrChartData AS $var => $row) {

	if((isset($row['log_comment'])) && (($row['log_comment'] <> ""))){


		if ($l ==0){
//			echo "<table class='subtleWhite smallText'>";
			echo "<tr>";
//			echo "<th>";
//			echo "Date";
//			echo "</th>";
			echo "<th colspan=2>";
			echo "Episode Log Comment";
			echo "</th>";
			echo "</tr>";
			$l = $l + 1;
		}


		echo "<tr>";

		echo "<td colspan=2>";
//		echo $row['event_date_NHS'];
//		echo ": ";
//		echo "</td>";

//		echo "<td>";
		echo $row['log_comment'];

		echo " (";
		echo $row['event_date_NHS'];
		echo ")";

		echo "</td>";


		echo "</tr>";
	}

}
echo "</table>";


	}




}
