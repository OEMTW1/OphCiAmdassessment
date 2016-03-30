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

/**
 * This is the model class for table "element_DiagnosisDetails".
 *
 * The followings are the available columns in table 'element_operation':
 * @property string $id
 * @property integer $event_id
 * @property integer $surgeon_id
 * @property integer $assistant_id
 * @property integer $anaesthetic_type
 *
 * The followings are the available model relations:
 * @property Event $event
 */
class Element_OphCiAmdassessment_VA extends BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return ElementOperation the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophciamdassessment_va';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, va_left, va_right_aided, va_left_aided, va_right, aid_left, aid_right, aid_left_aided, aid_right_aided, measure_left, measure_right', 'safe'),
			array('va_left, va_right', 'required'),

//			array('event_id, injection_drug_left', 'safe'),
//			array('injection_drug_left', 'required'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, va_left, va_right, va_right_aided, va_left_aided, va_right, aid_left, aid_right, measure_left, measure_right', 'safe', 'on' => 'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
//			'va_left' => array(self::BELONGS_TO, 'va', 'va_left'),
//			'va_right' => array(self::BELONGS_TO, 'va', 'va_right'),
//			'va_left_aided' => array(self::BELONGS_TO, 'va', 'va_left_aided'),
//			'va_right_aided' => array(self::BELONGS_TO, 'va', 'va_right_aided'),
			'aid_type_left' => array(self::BELONGS_TO, 'OphCiAmdassessment_AidType', 'aid_left'),
			'aid_type_right' => array(self::BELONGS_TO, 'OphCiAmdassessment_AidType', 'aid_right'),

			'aid_type_left_aided' => array(self::BELONGS_TO, 'OphCiAmdassessment_AidType', 'aid_left_aided'),
			'aid_type_right_aided' => array(self::BELONGS_TO, 'OphCiAmdassessment_AidType', 'aid_right_aided'),


			'measure_type_left' => array(self::BELONGS_TO, 'OphCiAmdassessment_MeasureType', 'va_left'),
			'measure_type_right' => array(self::BELONGS_TO, 'OphCiAmdassessment_MeasureType', 'va_right'),
			'measure_type_left_aided' => array(self::BELONGS_TO, 'OphCiAmdassessment_MeasureType', 'va_left_aided'),
			'measure_type_right_aided' => array(self::BELONGS_TO, 'OphCiAmdassessment_MeasureType', 'va_right_aided'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'va_left' => 'VA (L) *',
			'va_right' => 'VA (R) *' ,
//			'va_right' => 'VA (R)' . str_replace('1',' *',$this->isAttributeRequired('va_right')),

			'va_left_aided' => 'VA Aided (L)',
			'va_right_aided' => 'VA Aided (R)',

			'aid_left' => 'Aid (L)',
			'aid_right' => 'Aid (R)',


			'aid_left_aided' => 'Aid (L)',
			'aid_right_aided' => 'Aid (R)',


			'measure_left' => 'Alternative (L)',
			'measure_right' => 'Alternative (R)',


		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('va_left', $this->va_left, true);
		$criteria->compare('va_right',$this->va_right,true);
		$criteria->compare('va_left_aided', $this->va_left_aided, true);
		$criteria->compare('va_right_aided',$this->va_right_aided,true);

		$criteria->compare('aid_left', $this->aid_left, true);
		$criteria->compare('aid_right',$this->aid_right,true);


		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}



	public function getva_option_list() {

		return CHtml::listData(Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_va_va_options.id, et_ophciamdassessment_va_va_options.name')
			->from('et_ophciamdassessment_va_va_options')
			->where('et_ophciamdassessment_va_va_options.count_as_aided <= :caa', array(':caa' => '1'))
			->queryAll(), 'id', 'name');




	}


	public function getva_aided_option_list() {

		return CHtml::listData(Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_va_va_options.id, et_ophciamdassessment_va_va_options.name')
			->from('et_ophciamdassessment_va_va_options')
			->where('et_ophciamdassessment_va_va_options.count_as_aided = :caa', array(':caa' => '2'))
			->queryAll(), 'id', 'name');




	}




	public function getva_measure_list() {

		return CHtml::listData(Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_va_va_measures.id, et_ophciamdassessment_va_va_measures.name')
			->from('et_ophciamdassessment_va_va_measures')
			->order('display_order')
			->queryAll(), 'id', 'name');




	}

/*
	public function getva_measure_list() {

		return CHtml::listData(Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_va_va_measures.id, et_ophciamdassessment_va_va_measures.name')
			->from('et_ophciamdassessment_va_va_measures')
			->queryAll(), 'id', 'name');




	}
*/


	public function getva_option_array()
	{

		// Returns an array that indicates whether a specific drug_id should be regarded as an injection

		$options = Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_va_va_options.id, et_ophciamdassessment_va_va_options.name')
			->from('et_ophciamdassessment_va_va_options')
			->queryAll();
		$optionarray = array();
		foreach ($options as $option) {
			$optionarray[$option['id']] = $option['name'];
		}

		return $optionarray;

	}



/*
	public function getCountAsMeasure()
	{

		// Returns an array that indicates whether a specific measure_id can be regarded as a va measure

		$vameasures = Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_va_va_measures.id,et_ophciamdassessment_va_va_measures.count_as_index')
			->from('et_ophciamdassessment_va_va_measures')
			->queryAll();
		$count_as_measure = array();
		foreach ($vameasures as $vameasure) {
			$count_as_measure[$vameasure['id']] = $vameasure['count_as_index'];
		}

		return $count_as_measure;

	}
*/



}
