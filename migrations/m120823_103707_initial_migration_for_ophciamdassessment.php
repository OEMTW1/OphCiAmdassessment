<?php

class m120823_103707_initial_migration_for_ophciamdassessment extends CDbMigration
{
public function up() {

	// Get the event group for Treatment events
	$group = $this->dbConnection->createCommand()
	->select('id')
	->from('event_group')
	->where('code=:code', array(':code'=>'Ci'))
	->queryRow();

	// Create the new event_type
	$this->insert('event_type', array(
	'name' => 'AMD Assessment',
	'event_group_id' => $group['id'],
	'class_name' => 'OphCiAmdassessment'
	));

	// Get the newly created event type
	$event_type = $this->dbConnection->createCommand()
	->select('id')
	->from('event_type')
	->where('class_name=:class_name', array(':class_name'=>'OphCiAmdassessment'))
	->queryRow();






	// Create an element for aed
	$this->insert('element_type', array(
	'name' => 'Actual Event Date',
	'class_name' => 'Element_OphCiAmdassessment_ActualEventDate',
	'event_type_id' => $event_type['id'],
	'display_order' => 0,
	'default' => 1,
	));

	// Create basic table for the aed element
	$this->createTable('et_ophciamdassessment_aed', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'actual_event_date' => 'datetime',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_aed_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_aed_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_aed_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_aed_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_aed_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_aed_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');





	// Create an element for the new event type
	$this->insert('element_type', array(
	'name' => 'Subjective Change',
	'class_name' => 'Element_OphCiAmdassessment_SubjectiveChange',
	'event_type_id' => $event_type['id'],
	'display_order' => 20,
	'default' => 1,
	));


	// Create basic table for the sc element
	$this->createTable('et_ophciamdassessment_sc', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_sc_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_sc_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_sc_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_sc_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_sc_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_sc_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');





	// sc options drop-down
	$this->createTable('et_ophciamdassessment_sc_sc_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'count_as_index' => 'int(10) unsigned NOT NULL default 0',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_sso_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_sso_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_sso_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_sso_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

	$this->insert('et_ophciamdassessment_sc_sc_options',array('name'=>'Better','display_order'=>1,'count_as_index'=>3));
	$this->insert('et_ophciamdassessment_sc_sc_options',array('name'=>'Stable','display_order'=>2,'count_as_index'=>2));
	$this->insert('et_ophciamdassessment_sc_sc_options',array('name'=>'Worse','display_order'=>3,'count_as_index'=>1));
	$this->insert('et_ophciamdassessment_sc_sc_options',array('name'=>'N/A','display_order'=>4,'count_as_index'=>0));


	$this->addColumn('et_ophciamdassessment_sc','sc_left','int(10) unsigned NOT NULL DEFAULT 0 ');
	$this->addColumn('et_ophciamdassessment_sc','sc_right','int(10) unsigned NOT NULL DEFAULT 0 ');

//	$this->addColumn('et_ophciamdassessment_sc','sc_left','int(10) unsigned ');
//	$this->addColumn('et_ophciamdassessment_sc','sc_right','int(10) unsigned ');


	$this->createIndex('et_ophciamdassessment_ssol_fk','et_ophciamdassessment_sc','sc_left');
	$this->addForeignKey('et_ophciamdassessment_ssol_fk','et_ophciamdassessment_sc','sc_left','et_ophciamdassessment_sc_sc_options','id');

	$this->createIndex('et_ophciamdassessment_ssor_fk','et_ophciamdassessment_sc','sc_right');
	$this->addForeignKey('et_ophciamdassessment_ssor_fk','et_ophciamdassessment_sc','sc_right','et_ophciamdassessment_sc_sc_options','id');




	// Create an element for adverse events
	$this->insert('element_type', array(
	'name' => 'Adverse Event',
	'class_name' => 'Element_OphCiAmdassessment_AdverseEvent',
	'event_type_id' => $event_type['id'],
	'display_order' => 30,
	'default' => 1,
	));

	// Create basic table for the ae element
	$this->createTable('et_ophciamdassessment_ae', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'ae_comment_left' => 'TEXT NOT NULL',
	'ae_comment_right' => 'TEXT NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_ae_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_ae_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_ae_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_ae_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_ae_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_ae_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');




	// Drop-down for ae options
	$this->createTable('et_ophciamdassessment_ae_ae_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'count_as_index' => 'tinyint(3) unsigned NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_aeaeo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_aeaeo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_aeaeo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_aeaeo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'None','display_order'=>0,'count_as_index'=>0));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Endopthalmitis','display_order'=>1,'count_as_index'=>1));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Retinal detatchment','display_order'=>2,'count_as_index'=>2));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Uveitis','display_order'=>3,'count_as_index'=>3));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Corneal abrasion','display_order'=>4,'count_as_index'=>4));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Cataract','display_order'=>5,'count_as_index'=>5));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Myocardial infarction','display_order'=>6,'count_as_index'=>6));
	$this->insert('et_ophciamdassessment_ae_ae_options',array('name'=>'Cerebrovascular event','display_order'=>7,'count_as_index'=>7));



	// Create basic table for the ae one-to-many
	$this->createTable('et_ophciamdassessment_ae_ae', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'ae_id' => 'int(10) unsigned NOT NULL',
				'ae_option_id' => 'int(10) unsigned NOT NULL',
				'ae_eye_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_aeae_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_aeae_created_user_id_fk` (`created_user_id`)',
				'KEY `et_ophciamdassessment_aeae_ae_id_fk` (`ae_id`)',
				'KEY `et_ophciamdassessment_aeae_ae_option_id_fk` (`ae_option_id`)',
				'CONSTRAINT `et_ophciamdassessment_aeae_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_aeae_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_aeae_ae_id_fk` FOREIGN KEY (`ae_id`) REFERENCES `et_ophciamdassessment_ae` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_aeae_option_id_fk` FOREIGN KEY (`ae_option_id`) REFERENCES `et_ophciamdassessment_ae_ae_options` (`id`)'
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);





	// Create an element for clinical findings events
	$this->insert('element_type', array(
	'name' => 'Clinical Finding',
	'class_name' => 'Element_OphCiAmdassessment_ClinicalFinding',
	'event_type_id' => $event_type['id'],
	'display_order' => 40,
	'default' => 1,
	));

	// Create basic table for the ae element
	$this->createTable('et_ophciamdassessment_cf', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'cf_comment_left' => 'TEXT NOT NULL',
	'cf_comment_right' => 'TEXT NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_cf_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_cf_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_cf_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_cf_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_cf_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_cf_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');




	// Drop-down for ae options
	$this->createTable('et_ophciamdassessment_cf_cf_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'count_as_index' => 'tinyint(3) unsigned NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_cfcfo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_cfcfo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_cfcfo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_cfcfo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

//	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'None','display_order'=>0,'count_as_index'=>0));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Haemorrhage - subretinal','display_order'=>2,'count_as_index'=>2));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Haemorrhage - subRPE','display_order'=>3,'count_as_index'=>3));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Haemorrhage - vitreous/preretinal','display_order'=>4,'count_as_index'=>4));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'RPE rip','display_order'=>5,'count_as_index'=>5));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'RPE atrophy','display_order'=>6,'count_as_index'=>16));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'RPE hyperpigmentation','display_order'=>7,'count_as_index'=>17));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'PED','display_order'=>8,'count_as_index'=>6));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Fibrovascular PED','display_order'=>9,'count_as_index'=>18));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Drusenoid PED','display_order'=>10,'count_as_index'=>19));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Geographic atrophy','display_order'=>11,'count_as_index'=>7));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Subfoveal RPE atrophy','display_order'=>12,'count_as_index'=>22));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Drusen','display_order'=>13,'count_as_index'=>8));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Hard Drusen','display_order'=>14,'count_as_index'=>11));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Soft Drusen','display_order'=>15,'count_as_index'=>12));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Stable','display_order'=>16,'count_as_index'=>9));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Dry','display_order'=>17,'count_as_index'=>10));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'CMO','display_order'=>18,'count_as_index'=>13));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Retinal elevation/fluid','display_order'=>19,'count_as_index'=>1));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Intraretinal fluid','display_order'=>20,'count_as_index'=>14));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Subretinal fluid','display_order'=>21,'count_as_index'=>15));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Subretinal fibrosis','display_order'=>22,'count_as_index'=>20));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Subfoveal fibrosis','display_order'=>23,'count_as_index'=>21));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'RAP lesion','display_order'=>24,'count_as_index'=>23));

	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Cataract','display_order'=>25,'count_as_index'=>24));
	$this->insert('et_ophciamdassessment_cf_cf_options',array('name'=>'Disciform scar','display_order'=>26,'count_as_index'=>25));

	// Create basic table for the ae one-to-many
	$this->createTable('et_ophciamdassessment_cf_cf', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'cf_id' => 'int(10) unsigned NOT NULL',
				'cf_option_id' => 'int(10) unsigned NOT NULL',
				'cf_eye_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_cfcf_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_cfcf_created_user_id_fk` (`created_user_id`)',
				'KEY `et_ophciamdassessment_cfcf_cf_id_fk` (`cf_id`)',
				'KEY `et_ophciamdassessment_cfcf_cf_option_id_fk` (`cf_option_id`)',
				'CONSTRAINT `et_ophciamdassessment_cfcf_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_cfcf_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_cfcf_cf_id_fk` FOREIGN KEY (`cf_id`) REFERENCES `et_ophciamdassessment_cf` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_cfcf_option_id_fk` FOREIGN KEY (`cf_option_id`) REFERENCES `et_ophciamdassessment_cf_cf_options` (`id`)'
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);





	// Create an element for iop
	$this->insert('element_type', array(
	'name' => 'Intraocular Pressure',
	'class_name' => 'Element_OphCiAmdassessment_IOP',
	'event_type_id' => $event_type['id'],
	'display_order' => 50,
	'default' => 1,
	));

	// Create basic table for the iop element
	$this->createTable('et_ophciamdassessment_iop', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
//	'iop_left' => 'tinyint(4) unsigned NOT NULL DEFAULT 0',
//	'iop_right' => 'tinyint(4) unsigned NOT NULL DEFAULT 0',
	'iop_left' => 'tinyint(4) unsigned DEFAULT NULL',
	'iop_right' => 'tinyint(4) unsigned DEFAULT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_iop_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_iop_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_iop_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_iop_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_iop_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_iop_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



	// Create an element for oct findings events
	$this->insert('element_type', array(
	'name' => 'OCT Finding',
	'class_name' => 'Element_OphCiAmdassessment_OCTFinding',
	'event_type_id' => $event_type['id'],
	'display_order' => 60,
	'default' => 1,
	));

	// Create basic table for the ae element
	$this->createTable('et_ophciamdassessment_of', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'of_comment_left' => 'TEXT NOT NULL',
	'of_comment_right' => 'TEXT NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_of_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_of_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_of_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_of_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_of_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_of_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');




	// Drop-down for ae options
	$this->createTable('et_ophciamdassessment_of_of_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'count_as_index' => 'tinyint(3) unsigned NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_ofofo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_ofofo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_ofofo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_ofofo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

//	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'None','display_order'=>0,'count_as_index'=>0));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Stable','display_order'=>1,'count_as_index'=>1));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Intraretinal fluid','display_order'=>2,'count_as_index'=>2));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Subretinal fluid','display_order'=>3,'count_as_index'=>3));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'PED','display_order'=>4,'count_as_index'=>4));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Serous PED','display_order'=>5,'count_as_index'=>5));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Fibrovascular PED','display_order'=>6,'count_as_index'=>6));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'RPE rip','display_order'=>7,'count_as_index'=>7));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'CMO','display_order'=>8,'count_as_index'=>8));

	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Dry','display_order'=>9,'count_as_index'=>9));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Haemorrhage-Sub RPE','display_order'=>10,'count_as_index'=>10));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Haemorrhage-subretinal','display_order'=>11,'count_as_index'=>11));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Haemorrhage-intraretinal','display_order'=>12,'count_as_index'=>12));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Haemorrhage-preretinal','display_order'=>13,'count_as_index'=>13));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Poor image quality','display_order'=>14,'count_as_index'=>14));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Foveal atrophy','display_order'=>15,'count_as_index'=>15));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Loss or IS/OS boundary','display_order'=>16,'count_as_index'=>16));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Microtubules','display_order'=>17,'count_as_index'=>17));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Subretinal fibrosis','display_order'=>18,'count_as_index'=>18));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'RPE atrophy','display_order'=>19,'count_as_index'=>19));
	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Subfoveal RPE atrophy','display_order'=>20,'count_as_index'=>20));


	$this->insert('et_ophciamdassessment_of_of_options',array('name'=>'Subfoveal fibrosis','display_order'=>21,'count_as_index'=>21));




	// Create basic table for the ae one-to-many
	$this->createTable('et_ophciamdassessment_of_of', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'of_id' => 'int(10) unsigned NOT NULL',
				'of_option_id' => 'int(10) unsigned NOT NULL',
				'of_eye_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_ofof_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_ofof_created_user_id_fk` (`created_user_id`)',
				'KEY `et_ophciamdassessment_ofof_of_id_fk` (`of_id`)',
				'KEY `et_ophciamdassessment_ofof_of_option_id_fk` (`of_option_id`)',
				'CONSTRAINT `et_ophciamdassessment_ofof_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_ofof_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_ofof_of_id_fk` FOREIGN KEY (`of_id`) REFERENCES `et_ophciamdassessment_of` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_ofof_option_id_fk` FOREIGN KEY (`of_option_id`) REFERENCES `et_ophciamdassessment_of_of_options` (`id`)'
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);











	// Create an element for referral
	$this->insert('element_type', array(
	'name' => 'Referral',
	'class_name' => 'Element_OphCiAmdassessment_Referral',
	'event_type_id' => $event_type['id'],
	'display_order' => 110,
	'default' => 1,
	));

	// Create basic table for the ae element
	$this->createTable('et_ophciamdassessment_rf', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'rf_comment' => 'TEXT NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_rf_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_rf_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_rf_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_rf_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_rf_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_rf_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');




	// Drop-down for ae options
	$this->createTable('et_ophciamdassessment_rf_rf_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'count_as_index' => 'tinyint(3) unsigned NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_rfrfo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_rfrfo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_rfrfo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_rfrfo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);



//	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'None','display_order'=>1));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Low vision assessment','display_order'=>2));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'ECLO','display_order'=>3));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Slight impairment registration','display_order'=>4));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Glaucoma','display_order'=>5));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Oculoplastics','display_order'=>6));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Vitreoretinal','display_order'=>7));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Corneal','display_order'=>8));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Community AMD service','display_order'=>9));


	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'YAG Capsulotomy','display_order'=>10));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Other Laser','display_order'=>11));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Listed for Cataract Surgery','display_order'=>12));
	$this->insert('et_ophciamdassessment_rf_rf_options',array('name'=>'Other Surgery','display_order'=>13));








	// Create basic table for the ae one-to-many
	$this->createTable('et_ophciamdassessment_rf_rf', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'rf_id' => 'int(10) unsigned NOT NULL',
				'rf_option_id' => 'int(10) unsigned NOT NULL',
//				'rf_eye_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT \'1\'',
				'created_date' => 'datetime NOT NULL DEFAULT \'1900-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_rfrf_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_rfrf_created_user_id_fk` (`created_user_id`)',
				'KEY `et_ophciamdassessment_rfrf_rf_id_fk` (`rf_id`)',
				'KEY `et_ophciamdassessment_rfrf_rf_option_id_fk` (`rf_option_id`)',
				'CONSTRAINT `et_ophciamdassessment_rfrf_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_rfrf_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_rfrf_rf_id_fk` FOREIGN KEY (`rf_id`) REFERENCES `et_ophciamdassessment_rf` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_rfrf_option_id_fk` FOREIGN KEY (`rf_option_id`) REFERENCES `et_ophciamdassessment_rf_rf_options` (`id`)'
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);
















	// Create an element for crt
	$this->insert('element_type', array(
	'name' => 'Central Macular Thickness',
	'class_name' => 'Element_OphCiAmdassessment_CRT',
	'event_type_id' => $event_type['id'],
	'display_order' => 70,
	'default' => 1,
	));

	// Create basic table for the crt element
	$this->createTable('et_ophciamdassessment_crt', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'crt_left' => 'int(10) unsigned DEFAULT NULL',
	'crt_right' => 'int(10) unsigned DEFAULT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_crt_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_crt_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_crt_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_crt_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_crt_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_crt_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



	// Create an element for va
	$this->insert('element_type', array(
	'name' => 'Visual Acuity',
	'class_name' => 'Element_OphCiAmdassessment_VA',
	'event_type_id' => $event_type['id'],
	'display_order' => 10,
	'default' => 1,
	));

	// Create basic table for the va element
	$this->createTable('et_ophciamdassessment_va', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_va_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_va_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_va_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_va_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_va_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_va_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


	// va options drop-down
	$this->createTable('et_ophciamdassessment_va_va_options',array(
				'id' => 'tinyint(4) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'count_as_index' => 'int(10) unsigned NOT NULL default 0',
				'count_as_aided' => 'int(10) unsigned NOT NULL default 0',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_vvo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_vvo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_vvo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_vvo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

	$this->insert('et_ophciamdassessment_va_va_options',array('name'=>'Unaided','display_order'=>1,'count_as_index'=>0,'count_as_aided'=>0));
	$this->insert('et_ophciamdassessment_va_va_options',array('name'=>'Glasses','display_order'=>2,'count_as_index'=>1,'count_as_aided'=>1));
	$this->insert('et_ophciamdassessment_va_va_options',array('name'=>'Contact Lens','display_order'=>3,'count_as_index'=>2,'count_as_aided'=>1));
	$this->insert('et_ophciamdassessment_va_va_options',array('name'=>'Pinhole','display_order'=>4,'count_as_index'=>3,'count_as_aided'=>2));
	$this->insert('et_ophciamdassessment_va_va_options',array('name'=>'Refraction','display_order'=>5,'count_as_index'=>4,'count_as_aided'=>2));




	// va measures drop-down
	$this->createTable('et_ophciamdassessment_va_va_measures',array(
				'id' => 'tinyint(4) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) signed NOT NULL',
				'count_as_va' => 'int(10) unsigned',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_vvm_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_vvm_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_vvm_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_vvm_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);




	for ($i = 1; $i <= 100; $i++) {
		$this->insert('et_ophciamdassessment_va_va_measures',array('name'=>$i,'display_order'=>100-$i,'count_as_va'=>$i));
	}
	$this->insert('et_ophciamdassessment_va_va_measures',array('name'=>'CF (1/60)','display_order'=>101,'count_as_va'=>0));
	$this->insert('et_ophciamdassessment_va_va_measures',array('name'=>'HM','display_order'=>102,'count_as_va'=>0));
	$this->insert('et_ophciamdassessment_va_va_measures',array('name'=>'LP','display_order'=>103,'count_as_va'=>0));
	$this->insert('et_ophciamdassessment_va_va_measures',array('name'=>'NLP','display_order'=>104,'count_as_va'=>0));

//	$this->insert('et_ophciamdassessment_va_va_measures',array('name'=>'N/A','display_order'=>105,'count_as_va'=>0));


	// 19/06/2013 Un-tested!
/*
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '5 (6/240)'), 'count_as_va = :count_as_va', array(':count_as_va' => 5));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '20 (6/120)'), 'count_as_va = :count_as_va', array(':count_as_va' => 20));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '25 (6/95)'), 'count_as_va = :count_as_va', array(':count_as_va' => 25));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '35 (6/60)'), 'count_as_va = :count_as_va', array(':count_as_va' => 35));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '47 (6/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 47));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '55 (6/24)'), 'count_as_va = :count_as_va', array(':count_as_va' => 55));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '62 (6/18)'), 'count_as_va = :count_as_va', array(':count_as_va' => 62));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '70 (6/12)'), 'count_as_va = :count_as_va', array(':count_as_va' => 70));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '76 (6/9)'), 'count_as_va = :count_as_va', array(':count_as_va' => 76));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '85 (6/6)'), 'count_as_va = :count_as_va', array(':count_as_va' => 85));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '90 (6/5)'), 'count_as_va = :count_as_va', array(':count_as_va' => 90));
*/
	// 24/06/2013 Un-tested!
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '5 (6/240)'), 'count_as_va = :count_as_va', array(':count_as_va' => 5));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '7 (1/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 7));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '10 (6/190)'), 'count_as_va = :count_as_va', array(':count_as_va' => 10));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '12 (2/60)'), 'count_as_va = :count_as_va', array(':count_as_va' => 12));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '15 (6/150)'), 'count_as_va = :count_as_va', array(':count_as_va' => 15));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '20 (6/120)'), 'count_as_va = :count_as_va', array(':count_as_va' => 20));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '22 (2/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 22));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '25 (6/95)'), 'count_as_va = :count_as_va', array(':count_as_va' => 25));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '26 (4/60)'), 'count_as_va = :count_as_va', array(':count_as_va' => 26));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '30 (6/75)'), 'count_as_va = :count_as_va', array(':count_as_va' => 30));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '31 (3/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 31));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '35 (6/60)'), 'count_as_va = :count_as_va', array(':count_as_va' => 35));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '37 (4/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 37));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '40 (6/48)'), 'count_as_va = :count_as_va', array(':count_as_va' => 40));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '42 (5/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 42));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '47 (6/36)'), 'count_as_va = :count_as_va', array(':count_as_va' => 47));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '50 (6/30)'), 'count_as_va = :count_as_va', array(':count_as_va' => 50));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '55 (6/24)'), 'count_as_va = :count_as_va', array(':count_as_va' => 55));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '60 (6/19)'), 'count_as_va = :count_as_va', array(':count_as_va' => 60));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '62 (6/18)'), 'count_as_va = :count_as_va', array(':count_as_va' => 62));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '65 (6/15)'), 'count_as_va = :count_as_va', array(':count_as_va' => 65));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '70 (6/12)'), 'count_as_va = :count_as_va', array(':count_as_va' => 70));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '75 (6/9.5)'), 'count_as_va = :count_as_va', array(':count_as_va' => 75));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '76 (6/9)'), 'count_as_va = :count_as_va', array(':count_as_va' => 76));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '80 (6/7.5)'), 'count_as_va = :count_as_va', array(':count_as_va' => 80));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '85 (6/6)'), 'count_as_va = :count_as_va', array(':count_as_va' => 85));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '90 (6/5)'), 'count_as_va = :count_as_va', array(':count_as_va' => 90));
	$this->update('et_ophciamdassessment_va_va_measures', array('name' => '95 (6/4)'), 'count_as_va = :count_as_va', array(':count_as_va' => 95));




//	$this->addColumn('et_ophciamdassessment_va','va_left','tinyint(4) unsigned');
//	$this->addColumn('et_ophciamdassessment_va','va_right','tinyint(4) unsigned');

	$this->addColumn('et_ophciamdassessment_va','va_left','int(10) unsigned');
	$this->addColumn('et_ophciamdassessment_va','va_right','int(10) unsigned');

//	$this->addColumn('et_ophciamdassessment_va','va_left_aided','tinyint(4) unsigned');
//	$this->addColumn('et_ophciamdassessment_va','va_right_aided','tinyint(4) unsigned');

	$this->addColumn('et_ophciamdassessment_va','va_left_aided','int(10) unsigned');
	$this->addColumn('et_ophciamdassessment_va','va_right_aided','int(10) unsigned');


	$this->addColumn('et_ophciamdassessment_va','aid_left','tinyint(4) unsigned');
	$this->addColumn('et_ophciamdassessment_va','aid_right','tinyint(4) unsigned');


	$this->addColumn('et_ophciamdassessment_va','aid_left_aided','tinyint(4) unsigned');
	$this->addColumn('et_ophciamdassessment_va','aid_right_aided','tinyint(4) unsigned');


//	$this->addColumn('et_ophciamdassessment_va','aid_left','int(10) unsigned');
//	$this->addColumn('et_ophciamdassessment_va','aid_right','int(10) unsigned');


	$this->addColumn('et_ophciamdassessment_va','comment_left','TEXT NOT NULL');
	$this->addColumn('et_ophciamdassessment_va','comment_right','TEXT NOT NULL');



//	$this->addColumn('et_ophciamdassessment_va','measure_left','tinyint(4) unsigned');
//	$this->addColumn('et_ophciamdassessment_va','measure_right','tinyint(4) unsigned');



	$this->createIndex('et_ophciamdassessment_vvol_fk','et_ophciamdassessment_va','aid_left');
	$this->addForeignKey('et_ophciamdassessment_vvol_fk','et_ophciamdassessment_va','aid_left','et_ophciamdassessment_va_va_options','id');

	$this->createIndex('et_ophciamdassessment_vvor_fk','et_ophciamdassessment_va','aid_right');
	$this->addForeignKey('et_ophciamdassessment_vvor_fk','et_ophciamdassessment_va','aid_right','et_ophciamdassessment_va_va_options','id');


	$this->createIndex('et_ophciamdassessment_vvola_fk','et_ophciamdassessment_va','aid_left_aided');
	$this->addForeignKey('et_ophciamdassessment_vvola_fk','et_ophciamdassessment_va','aid_left_aided','et_ophciamdassessment_va_va_options','id');

	$this->createIndex('et_ophciamdassessment_vvora_fk','et_ophciamdassessment_va','aid_right_aided');
	$this->addForeignKey('et_ophciamdassessment_vvora_fk','et_ophciamdassessment_va','aid_right_aided','et_ophciamdassessment_va_va_options','id');




//	$this->createIndex('et_ophciamdassessment_vvml_fk','et_ophciamdassessment_va','measure_left');
//	$this->addForeignKey('et_ophciamdassessment_vvml_fk','et_ophciamdassessment_va','measure_left','et_ophciamdassessment_va_va_measures','id');

//	$this->createIndex('et_ophciamdassessment_vvmr_fk','et_ophciamdassessment_va','measure_right');
//	$this->addForeignKey('et_ophciamdassessment_vvmr_fk','et_ophciamdassessment_va','measure_right','et_ophciamdassessment_va_va_measures','id');




	// Create an element for the new event type
	$this->insert('element_type', array(
	'name' => 'Status',
	'class_name' => 'Element_OphCiAmdassessment_AMDStatus',
	'event_type_id' => $event_type['id'],
	'display_order' => 80,
	'default' => 1,
	));


	// Create basic table for the sc element
	$this->createTable('et_ophciamdassessment_status', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_status_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_status_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_status_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_status_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_status_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_status_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


//	$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'AMD Treatment'))->queryRow();
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_AMDStatus'))->queryRow();



	// status options drop-down
	$this->createTable('et_ophciamdassessment_status_status_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'count_as_index' => 'int(10) unsigned NOT NULL default 0',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_ststo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_ststo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_ststo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_ststo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

/*
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'Active','display_order'=>1,'count_as_index'=>1));
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'In-active','display_order'=>2,'count_as_index'=>0));
*/

	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'Active','display_order'=>1,'count_as_index'=>1));
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'In-cycle','display_order'=>2,'count_as_index'=>2));
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'In-active','display_order'=>3,'count_as_index'=>3));
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'Endstage','display_order'=>4,'count_as_index'=>4));
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'Untreated/Surveillance','display_order'=>5,'count_as_index'=>5));
	$this->insert('et_ophciamdassessment_status_status_options',array('name'=>'Unknown','display_order'=>6,'count_as_index'=>6));


	$this->addColumn('et_ophciamdassessment_status','status_left','int(10) unsigned NOT NULL DEFAULT 0');
	$this->addColumn('et_ophciamdassessment_status','status_right','int(10) unsigned NOT NULL DEFAULT 0');

//	$this->addColumn('et_ophciamdassessment_status','status_left','int(10) unsigned ');
//	$this->addColumn('et_ophciamdassessment_status','status_right','int(10) unsigned ');


	$this->createIndex('et_ophciamdassessment_stol_fk','et_ophciamdassessment_status','status_left');
	$this->addForeignKey('et_ophciamdassessment_stol_fk','et_ophciamdassessment_status','status_left','et_ophciamdassessment_status_status_options','id');

	$this->createIndex('et_ophciamdassessment_stor_fk','et_ophciamdassessment_status','status_right');
	$this->addForeignKey('et_ophciamdassessment_stor_fk','et_ophciamdassessment_status','status_right','et_ophciamdassessment_status_status_options','id');

















	// Create an element for the new event type
	$this->insert('element_type', array(
	'name' => 'Treatment Plan',
	'class_name' => 'Element_OphCiAmdassessment_TreatmentPlan',
	'event_type_id' => $event_type['id'],
	'display_order' => 90,
	'default' => 1,
	));


	// Create basic table for the sc element
	$this->createTable('et_ophciamdassessment_tp', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_tp_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_tp_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_tp_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_tp_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_tp_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_tp_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


//	$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('name=:name', array(':name'=>'AMD Treatment'))->queryRow();
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_TreatmentPlan'))->queryRow();



	// status options drop-down
	$this->createTable('et_ophciamdassessment_tp_tp_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'count_as_index' => 'int(10) unsigned NOT NULL default 0',
				'count_as_treatment' => 'int(10) unsigned NOT NULL default 0',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_tptpo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_tptpo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_tptpo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_tptpo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'N/A','display_order'=>9,'count_as_index'=>0,'count_as_treatment'=>0));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'No treatment','display_order'=>1,'count_as_index'=>1,'count_as_treatment'=>0));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Anti VEGf','display_order'=>2,'count_as_index'=>2,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Anti VEGf 1 of 3','display_order'=>2,'count_as_index'=>3,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Anti VEGf 2 of 3','display_order'=>3,'count_as_index'=>4,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Anti VEGf 3 of 3','display_order'=>4,'count_as_index'=>5,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Anti VEGf treat and extend','display_order'=>5,'count_as_index'=>6,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'PDT','display_order'=>6,'count_as_index'=>7,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Photocoagulation','display_order'=>7,'count_as_index'=>8,'count_as_treatment'=>1));
	$this->insert('et_ophciamdassessment_tp_tp_options',array('name'=>'Combination','display_order'=>8,'count_as_index'=>9,'count_as_treatment'=>1));


	$this->addColumn('et_ophciamdassessment_tp','tp_comment_left','TEXT NOT NULL');
	$this->addColumn('et_ophciamdassessment_tp','tp_comment_right','TEXT NOT NULL');


	$this->addColumn('et_ophciamdassessment_tp','tp_left','int(10) unsigned DEFAULT NULL');
	$this->addColumn('et_ophciamdassessment_tp','tp_right','int(10) unsigned DEFAULT NULL');


	$this->createIndex('et_ophciamdassessment_tpol_fk','et_ophciamdassessment_tp','tp_left');
	$this->addForeignKey('et_ophciamdassessment_tpol_fk','et_ophciamdassessment_tp','tp_left','et_ophciamdassessment_tp_tp_options','id');

	$this->createIndex('et_ophciamdassessment_tpor_fk','et_ophciamdassessment_tp','tp_right');
	$this->addForeignKey('et_ophciamdassessment_tpor_fk','et_ophciamdassessment_tp','tp_right','et_ophciamdassessment_tp_tp_options','id');














	// Create an element for Follow-up
	$this->insert('element_type', array(
	'name' => 'Follow-up',
	'class_name' => 'Element_OphCiAmdassessment_FollowUp',
	'event_type_id' => $event_type['id'],
	'display_order' => 120,
	'default' => 1,
	));

	// Create basic table for the comment element
	$this->createTable('et_ophciamdassessment_followup', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'followup_comment' => 'TEXT NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_followup_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_followup_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_followup_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_followup_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_followup_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_followup_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


	// Drop-down for followup options
	$this->createTable('et_ophciamdassessment_followup_followup_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_ffo_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_ffo_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_ffo_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_ffo_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);

	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'None','display_order'=>1));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'1 month','display_order'=>2));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'2 months','display_order'=>3));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'3 months','display_order'=>4));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'4 months','display_order'=>5));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'5 months','display_order'=>6));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'6 months','display_order'=>7));
	$this->insert('et_ophciamdassessment_followup_followup_options',array('name'=>'Discharge','display_order'=>8));



/*


	$this->addColumn('et_ophciamdassessment_followup','followup_option_id','int(10) unsigned DEFAULT NULL');

	$this->createIndex('et_ophciamdassessment_fuo_fk','et_ophciamdassessment_followup','followup_option_id');
	$this->addForeignKey('et_ophciamdassessment_fuo_fk','et_ophciamdassessment_followup','followup_option_id','et_ophciamdassessment_followup_followup_options','id');

*/














/*

	// Create an element for referral
	$this->insert('element_type', array(
	'name' => 'Referral',
	'class_name' => 'Element_OphCiAmdassessment_Referral',
	'event_type_id' => $event_type['id'],
	'display_order' => 110,
	'default' => 1,
	));

	// Create basic table for the referral element
	$this->createTable('et_ophciamdassessment_referral', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'referral_comment' => 'TEXT NOT NULL',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_referral_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_referral_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_referral_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_referral_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_referral_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_referral_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');


	// Drop-down for referral options
	$this->createTable('et_ophciamdassessment_referral_referral_options',array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) COLLATE utf8_bin NOT NULL',
				'display_order' => 'tinyint(3) unsigned NOT NULL',
				'last_modified_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'last_modified_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'created_user_id' => "int(10) unsigned NOT NULL DEFAULT '1'",
				'created_date' => "datetime NOT NULL DEFAULT '1900-01-01 00:00:00'",
				'PRIMARY KEY (`id`)',
				'KEY `et_ophciamdassessment_rro_last_modified_user_id_fk` (`last_modified_user_id`)',
				'KEY `et_ophciamdassessment_rro_created_user_id_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophciamdassessment_rro_last_modified_user_id_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophciamdassessment_rro_created_user_id_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
	);


	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'None','display_order'=>1));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Low vision assessment','display_order'=>2));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'ECLO','display_order'=>3));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Slight impairment registration','display_order'=>4));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Glaucoma','display_order'=>5));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Oculoplastics','display_order'=>6));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Vitreoretinal','display_order'=>7));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Corneal','display_order'=>8));
	$this->insert('et_ophciamdassessment_referral_referral_options',array('name'=>'Community AMD service','display_order'=>9));

*/

/*

	$this->addColumn('et_ophciamdassessment_referral','referral_option_id','int(10) unsigned DEFAULT NULL');

	$this->createIndex('et_ophciamdassessment_reo_fk','et_ophciamdassessment_referral','referral_option_id');
	$this->addForeignKey('et_ophciamdassessment_reo_fk','et_ophciamdassessment_referral','referral_option_id','et_ophciamdassessment_referral_referral_options','id');

*/



	// Create an element for Follow-up
	$this->insert('element_type', array(
	'name' => 'Drawing',
	'class_name' => 'Element_OphCiAmdassessment_EyeDraw',
	'event_type_id' => $event_type['id'],
	'display_order' => 120,
	'default' => 1,
	));

	// Create basic table for the comment element
	$this->createTable('et_ophciamdassessment_eyedraw', array(
	'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
	'event_id' => 'int(10) unsigned NOT NULL',
	'comment_left' => 'TEXT NOT NULL',
	'comment_right' => 'TEXT NOT NULL',
	'eyedraw_left' => 'TEXT',
	'eyedraw_right' => 'TEXT',
	'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',	'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01
	00:00:00\'',
	'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
	'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
	'PRIMARY KEY (`id`)',
	'KEY `et_ophciamdassessment_eyedraw_event_id_fk` (`event_id`)',
	'KEY `et_ophciamdassessment_eyedraw_created_user_id_fk`
	(`created_user_id`)',
	'KEY `et_ophciamdassessment_eyedraw_last_modified_user_id_fk`
	(`last_modified_user_id`)',
	'CONSTRAINT `et_ophciamdassessment_eyedraw_event_id_fk` FOREIGN KEY
	(`event_id`) REFERENCES `event` (`id`)',
	'CONSTRAINT `et_ophciamdassessment_eyedraw_created_user_id_fk`
	FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
	'CONSTRAINT
	`et_ophciamdassessment_eyedraw_last_modified_user_id_fk` FOREIGN KEY
	(`last_modified_user_id`) REFERENCES `user` (`id`)',
	), 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin');




}



public function down() {



	// Find the event type
	$event_type = $this->dbConnection->createCommand()
	->select('id')
	->from('event_type')
	->where('class_name=:class_name', array(':class_name'=>'OphCiAmdassessment'))
	->queryRow();




	// Find the AED element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_ActualEventDate'))->queryRow();


	// Delete the AED element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for aed
	$this->dropTable('et_ophciamdassessment_aed');




	// Find the subjective change element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_SubjectiveChange'))->queryRow();


	// Delete the subjective change element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for subjective change
	$this->dropTable('et_ophciamdassessment_sc');
	$this->dropTable('et_ophciamdassessment_sc_sc_options');



	// Find the ae element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_AdverseEvent'))->queryRow();


	// Delete the ae element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for ae one-to-many
	$this->dropTable('et_ophciamdassessment_ae_ae');

	// Drop the table created for ae options
	$this->dropTable('et_ophciamdassessment_ae_ae_options');

	// Drop the table created for ae
	$this->dropTable('et_ophciamdassessment_ae');



	// Find the cf element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_ClinicalFinding'))->queryRow();


	// Delete the ae element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for ae one-to-many
	$this->dropTable('et_ophciamdassessment_cf_cf');

	// Drop the table created for ae options
	$this->dropTable('et_ophciamdassessment_cf_cf_options');

	// Drop the table created for ae
	$this->dropTable('et_ophciamdassessment_cf');



	// Find the iop element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_IOP'))->queryRow();


	// Delete the iop element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for iop
	$this->dropTable('et_ophciamdassessment_iop');






	// Find the of element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_OCTFinding'))->queryRow();


	// Delete the ae element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for ae one-to-many
	$this->dropTable('et_ophciamdassessment_of_of');

	// Drop the table created for ae options
	$this->dropTable('et_ophciamdassessment_of_of_options');

	// Drop the table created for ae
	$this->dropTable('et_ophciamdassessment_of');






	// Find the of element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_Referral'))->queryRow();


	// Delete the rf element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for rf one-to-many
	$this->dropTable('et_ophciamdassessment_rf_rf');

	// Drop the table created for rf options
	$this->dropTable('et_ophciamdassessment_rf_rf_options');

	// Drop the table created for rf
	$this->dropTable('et_ophciamdassessment_rf');






	// Find the crt element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_CRT'))->queryRow();


	// Delete the crt element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for crt
	$this->dropTable('et_ophciamdassessment_crt');



	// Find the va element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_VA'))->queryRow();


	// Delete the va element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for va
	$this->dropTable('et_ophciamdassessment_va');
	$this->dropTable('et_ophciamdassessment_va_va_options');
	$this->dropTable('et_ophciamdassessment_va_va_measures');




	// Find the status element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_AMDStatus'))->queryRow();


	// Delete the subjective change element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for subjective change
	$this->dropTable('et_ophciamdassessment_status');
	$this->dropTable('et_ophciamdassessment_status_status_options');



	// Find the status element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_TreatmentPlan'))->queryRow();


	// Delete the subjective change element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for subjective change
	$this->dropTable('et_ophciamdassessment_tp');
	$this->dropTable('et_ophciamdassessment_tp_tp_options');





	// Find the followup element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_FollowUp'))->queryRow();

	// Delete the followup element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for followup options
	$this->dropTable('et_ophciamdassessment_followup_followup_options');

	// Drop the table created for followup
	$this->dropTable('et_ophciamdassessment_followup');

/*

	// Find the referral element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_Referral'))->queryRow();

	// Delete the followup element type
	$this->delete('element_type','id='.$element_type['id']);

	// Drop the table created for followup options
	$this->dropTable('et_ophciamdassessment_referral_referral_options');

	// Drop the table created for followup
	$this->dropTable('et_ophciamdassessment_referral');
*/

	// Find the eyedraw element type
	$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id = :event_type_id and class_name=:class_name',array(':event_type_id' => $event_type['id'], ':class_name'=>'Element_OphCiAmdassessment_EyeDraw'))->queryRow();

	// Delete the eyedraw element type
	$this->delete('element_type','id='.$element_type['id']);


	// Drop the table created for eyedraw
	$this->dropTable('et_ophciamdassessment_eyedraw');



	// Delete the event type
	$this->delete('event_type','id='.$event_type['id']);




}



}
