<?php

class m131001_142253_set_optional_fields extends CDbMigration
{
	public function up()
	{

		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_ActualEventDate'");
		$this->update('element_type',array('default'=>1),"class_name='Element_OphCiAmdassessment_SubjectiveChange'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_AdverseEvent'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_ClinicalFinding'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_IOP'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_OCTFinding'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_Referral'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_CRT'");
		$this->update('element_type',array('default'=>1),"class_name='Element_OphCiAmdassessment_VA'");
		$this->update('element_type',array('default'=>1),"class_name='Element_OphCiAmdassessment_AMDStatus'");
		$this->update('element_type',array('default'=>1),"class_name='Element_OphCiAmdassessment_TreatmentPlan'");
		$this->update('element_type',array('default'=>1),"class_name='Element_OphCiAmdassessment_FollowUp'");
		$this->update('element_type',array('default'=>0),"class_name='Element_OphCiAmdassessment_EyeDraw'");

		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_ActualEventDate'");
		$this->update('element_type',array('required'=>1),"class_name='Element_OphCiAmdassessment_SubjectiveChange'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_AdverseEvent'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_ClinicalFinding'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_IOP'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_OCTFinding'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_Referral'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_CRT'");
		$this->update('element_type',array('required'=>1),"class_name='Element_OphCiAmdassessment_VA'");
		$this->update('element_type',array('required'=>1),"class_name='Element_OphCiAmdassessment_AMDStatus'");
		$this->update('element_type',array('required'=>1),"class_name='Element_OphCiAmdassessment_TreatmentPlan'");
		$this->update('element_type',array('required'=>1),"class_name='Element_OphCiAmdassessment_FollowUp'");
		$this->update('element_type',array('required'=>0),"class_name='Element_OphCiAmdassessment_EyeDraw'");


	}

	public function down()
	{

	}

}
