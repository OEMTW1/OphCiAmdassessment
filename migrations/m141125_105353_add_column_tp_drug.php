<?php

class m141125_105353_add_column_tp_drug extends OEMigration
{

	public function up()
	{
		$this->addColumn('et_ophciamdassessment_tp', 'tp_drug_left', 'integer(10) unsigned default null');
		$this->addColumn('et_ophciamdassessment_tp', 'tp_drug_right', 'integer(10) unsigned default null');

		$this->addColumn('et_ophciamdassessment_tp_version', 'tp_drug_left', 'integer(10) unsigned default null');
		$this->addColumn('et_ophciamdassessment_tp_version', 'tp_drug_right', 'integer(10) unsigned default null');

	}

	public function down()
	{
		$this->dropColumn('et_ophciamdassessment_tp', 'tp_drug_left');
		$this->dropColumn('et_ophciamdassessment_tp', 'tp_drug_right');

		$this->dropColumn('et_ophciamdassessment_tp_version', 'tp_drug_left');
		$this->dropColumn('et_ophciamdassessment_tp_version', 'tp_drug_right');

	}

}
