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
class Element_OphCiAmdassessment_TreatmentPlan extends BaseEventTypeElement
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
		return 'et_ophciamdassessment_tp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, tp_left, tp_right,  tp_comment_left, tp_comment_right, tp_drug_left, tp_drug_right', 'safe'),
			array('tp_left, tp_right', 'required'),

//			array('event_id, sc_left', 'safe'),
//			array('sc_left', 'required'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, tp_left, tp_right, tp_comment_left, tp_comment_right', 'safe', 'on' => 'search'),
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
			'tp_type_left' => array(self::BELONGS_TO, 'OphCiAmdassessment_tpType', 'tp_left'),
			'tp_type_right' => array(self::BELONGS_TO, 'OphCiAmdassessment_tpType', 'tp_right'),
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
			'tp_left' => 'Treatment Plan (L) *',
			'tp_right' => 'Treatment Plan (R) *',
			'tp_drug_left' => 'Treatment Drug (L)',
			'tp_drug_right' => 'Treatment Drug (R)',
			'tp_comment_left' => 'Any other details (L)',
			'tp_comment_right' => 'Any other details (R)',


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
		$criteria->compare('tp_left', $this->sc_left, true);
		$criteria->compare('tp_right',$this->sc_right,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}



	public function gettp_option_list() {

		return CHtml::listData(Yii::app()->db->createCommand()
			->select('et_ophciamdassessment_tp_tp_options.id, et_ophciamdassessment_tp_tp_options.name')
			->from('et_ophciamdassessment_tp_tp_options')
			->queryAll(), 'id', 'name');




	}



}
