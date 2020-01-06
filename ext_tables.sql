CREATE TABLE sys_file_reference (
	ausrichtung varchar(255) DEFAULT 'left' NOT NULL,
);

CREATE TABLE tx_sitepackage_domain_model_anchor (
	uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

	pages int(11) unsigned DEFAULT '0' NOT NULL,

    name varchar(255) DEFAULT '' NOT NULL,
    link varchar(255) DEFAULT '' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    untertitle varchar(255) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    t3ver_oid int(11) DEFAULT '0' NOT NULL,
    t3ver_id int(11) DEFAULT '0' NOT NULL,
    t3ver_wsid int(11) DEFAULT '0' NOT NULL,
    t3ver_label varchar(255) DEFAULT '' NOT NULL,
    t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
    t3ver_stage int(11) DEFAULT '0' NOT NULL,
    t3ver_count int(11) DEFAULT '0' NOT NULL,
    t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
    t3ver_move_id int(11) DEFAULT '0' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    t3_origuid int(11) DEFAULT '0' NOT NULL,
    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_state int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY t3ver_oid (t3ver_oid,t3ver_wsid),
    KEY language (l10n_parent,sys_language_uid)
);

CREATE TABLE pages (
	onepager int(11) DEFAULT '0' NOT NULL,
	onepagerclass varchar(255) DEFAULT '' NOT NULL,
	opanchors int(11) DEFAULT '0' NOT NULL,
	opfrom varchar(255) DEFAULT '' NOT NULL,
);

-- CREATE TABLE tx_sitepackage_anchor_pages_mm (
--    uid_local int(11) unsigned DEFAULT '0' NOT NULL,
--    uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
--    sorting int(11) unsigned DEFAULT '0' NOT NULL,
--    KEY uid_local (uid_local),
--    KEY uid_foreign (uid_foreign)
-- );
