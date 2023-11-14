#
# alter tt_content table
#
CREATE TABLE tt_content (
    tx_plate_ces_check1 tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_plate_ces_check2 tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_plate_ces_input1 tinytext,
    pi_flexform_2 text,
    tx_plate_ce_layout tinytext,
    tx_plate_ces_infoblocks int(11) unsigned DEFAULT '0',
    inline_1 int(11) unsigned DEFAULT '0',
    tx_dpces_carousel_item int(11) unsigned DEFAULT '0',
    equal_height tinyint,
    media2 int(11) unsigned DEFAULT '0',
    media3 int(11) unsigned DEFAULT '0',
);

#
# alter sys_file_reference table
#
CREATE TABLE sys_file_reference (
    tx_plate_ces_check1 tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_plate_ces_check2 tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_plate_ces_check3 tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_plate_ces_blur tinyint(4) unsigned DEFAULT '0' NOT NULL,
    tx_plate_ces_select1 tinytext,
    tx_plate_ces_select2 tinytext,
    tx_plate_ces_select3 tinytext,
    tx_plate_ces_select4 tinytext,
    tx_plate_ces_input1 tinytext,
    tx_plate_ces_image int(11) unsigned DEFAULT '0',
    bodytext text,
);

# alter tx_plate_ces_infoblocks table
#
CREATE TABLE tx_plate_ces_infoblocks (
     header tinytext,
     layout tinytext,
     description text,
     description2 text,
     typolink varchar(4096),
     tx_plate_ces_icon varchar(4096),
     linkstyle tinyint(4) unsigned DEFAULT '0' NOT NULL,
     image int(11) unsigned DEFAULT '0' NOT NULL,
     hidden smallint unsigned DEFAULT '0' NOT NULL,
     starttime int(11) unsigned DEFAULT '0' NOT NULL,
     endtime int(11) unsigned DEFAULT '0' NOT NULL,
     parentid int(11) DEFAULT '0' NOT NULL,
     parenttable text,
     role varchar(255) DEFAULT '' NOT NULL,
);
