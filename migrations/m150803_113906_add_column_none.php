<?php

class m150803_113906_add_column_none extends OEMigration
{
	public function up()
	{

		$this->addColumn('et_ophciamdassessment_tp_tp_options', 'count_as_none', 'tinyint(1) unsigned not null default 0');
		$this->addColumn('et_ophciamdassessment_tp_tp_options_version', 'count_as_none', 'tinyint(1) unsigned not null default 0');

	}

	public function down()
	{

		$this->dropColumn('et_ophciamdassessment_tp_tp_options', 'count_as_none');
		$this->dropColumn('et_ophciamdassessment_tp_tp_options_version', 'count_as_none');

	}


}
