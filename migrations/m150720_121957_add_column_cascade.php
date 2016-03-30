<?php

class m150720_121957_add_column_cascade extends OEMigration
{
	public function up()
	{

		$this->addColumn('et_ophciamdassessment_tp_tp_options', 'count_as_cascade', 'integer(10) unsigned not null default 0');
		$this->addColumn('et_ophciamdassessment_tp_tp_options_version', 'count_as_cascade', 'integer(10) unsigned not null default 0');

	}

	public function down()
	{

		$this->dropColumn('et_ophciamdassessment_tp_tp_options', 'count_as_cascade');
		$this->dropColumn('et_ophciamdassessment_tp_tp_options_version', 'count_as_cascade');

	}

}
