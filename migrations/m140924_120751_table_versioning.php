<?php

class m140924_120751_table_versioning extends OEMigration
{
	public function up()
	{

		$this->addColumn('et_ophciamdassessment_ae_ae_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_cf_cf_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_followup_followup_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_of_of_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_rf_rf_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_sc_sc_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_status_status_options', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_va_va_measures', 'active', 'boolean not null default true');
		$this->addColumn('et_ophciamdassessment_va_va_options', 'active', 'boolean not null default true');


		$this->versionExistingTable('et_ophciamdassessment_ae');
		$this->versionExistingTable('et_ophciamdassessment_ae_ae');
		$this->versionExistingTable('et_ophciamdassessment_ae_ae_options');
		$this->versionExistingTable('et_ophciamdassessment_aed');
		$this->versionExistingTable('et_ophciamdassessment_cf');
		$this->versionExistingTable('et_ophciamdassessment_cf_cf');
		$this->versionExistingTable('et_ophciamdassessment_cf_cf_options');
		$this->versionExistingTable('et_ophciamdassessment_crt');
		$this->versionExistingTable('et_ophciamdassessment_followup');
		$this->versionExistingTable('et_ophciamdassessment_followup_followup_options');
		$this->versionExistingTable('et_ophciamdassessment_iop');
		$this->versionExistingTable('et_ophciamdassessment_of');
		$this->versionExistingTable('et_ophciamdassessment_of_of');
		$this->versionExistingTable('et_ophciamdassessment_of_of_options');
		$this->versionExistingTable('et_ophciamdassessment_rf');
		$this->versionExistingTable('et_ophciamdassessment_rf_rf');
		$this->versionExistingTable('et_ophciamdassessment_rf_rf_options');
		$this->versionExistingTable('et_ophciamdassessment_sc');
		$this->versionExistingTable('et_ophciamdassessment_sc_sc_options');
		$this->versionExistingTable('et_ophciamdassessment_status');
		$this->versionExistingTable('et_ophciamdassessment_status_status_options');
		$this->versionExistingTable('et_ophciamdassessment_tp');
		$this->versionExistingTable('et_ophciamdassessment_tp_tp_options');
		$this->versionExistingTable('et_ophciamdassessment_va');
		$this->versionExistingTable('et_ophciamdassessment_va_va_measures');
		$this->versionExistingTable('et_ophciamdassessment_va_va_options');


	}

	public function down()
	{

		$this->dropTable('et_ophciamdassessment_ae_version');
		$this->dropTable('et_ophciamdassessment_ae_ae_version');
		$this->dropTable('et_ophciamdassessment_ae_ae_options_version');
		$this->dropTable('et_ophciamdassessment_aed_version');
		$this->dropTable('et_ophciamdassessment_cf_version');
		$this->dropTable('et_ophciamdassessment_cf_cf_version');
		$this->dropTable('et_ophciamdassessment_cf_cf_options_version');
		$this->dropTable('et_ophciamdassessment_crt_version');
		$this->dropTable('et_ophciamdassessment_followup_version');
		$this->dropTable('et_ophciamdassessment_followup_followup_options_version');
		$this->dropTable('et_ophciamdassessment_iop_version');
		$this->dropTable('et_ophciamdassessment_of_version');
		$this->dropTable('et_ophciamdassessment_of_of_version');
		$this->dropTable('et_ophciamdassessment_of_of_options_version');
		$this->dropTable('et_ophciamdassessment_rf_version');
		$this->dropTable('et_ophciamdassessment_rf_rf_version');
		$this->dropTable('et_ophciamdassessment_rf_rf_options_version');
		$this->dropTable('et_ophciamdassessment_sc_version');
		$this->dropTable('et_ophciamdassessment_sc_sc_options_version');
		$this->dropTable('et_ophciamdassessment_status_version');
		$this->dropTable('et_ophciamdassessment_status_status_options_version');
		$this->dropTable('et_ophciamdassessment_tp_version');
		$this->dropTable('et_ophciamdassessment_tp_tp_options_version');
		$this->dropTable('et_ophciamdassessment_va_version');
		$this->dropTable('et_ophciamdassessment_va_va_measures_version');
		$this->dropTable('et_ophciamdassessment_va_va_options_version');


		$this->dropColumn('et_ophciamdassessment_ae_ae_options', 'active');
		$this->dropColumn('et_ophciamdassessment_cf_cf_options', 'active');
		$this->dropColumn('et_ophciamdassessment_followup_followup_options', 'active');
		$this->dropColumn('et_ophciamdassessment_of_of_options', 'active');
		$this->dropColumn('et_ophciamdassessment_rf_rf_options', 'active');
		$this->dropColumn('et_ophciamdassessment_sc_sc_options', 'active');
		$this->dropColumn('et_ophciamdassessment_status_status_options', 'active');
		$this->dropColumn('et_ophciamdassessment_va_va_measures', 'active');
		$this->dropColumn('et_ophciamdassessment_va_va_options', 'active');


	}

}
