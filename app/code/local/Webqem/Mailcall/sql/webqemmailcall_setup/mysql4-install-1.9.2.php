<?php
/**
 * Webqem Mailcall
 *
 * @category    Webqem
 * @package     Webqem_Mailcall
 * @copyright   Copyright (c) 2012 webqem (http://www.webqem.com)
 * @author      webqem
 */

$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */

$installer->startSetup();

$attributeId = $installer->getAttributeId('catalog_product', 'wantitnow');
if(!$attributeId && false){
    $defaultValue = '1';
    $installer->addAttribute('catalog_product', 'wantitnow', array(
        'group'             => 'General',
        'type'              => 'int',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Can ship with Want It Now',
        'input'             => 'boolean',
        'class'             => '',
        'source'            => '',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'           => true,
        'required'          => true,
        'user_defined'      => true,
        'default'           => $defaultValue,
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'visible_in_advanced_search' => false,
        'unique'            => false,
        )
    );

    $newAttributeId = $installer->getAttributeId('catalog_product', 'wantitnow');

    $installer->run("
    INSERT INTO {$this->getTable('catalog_product_entity_varchar')}
        (entity_id, entity_type_id, attribute_id, value)
        SELECT entity_id, entity_type_id, {$newAttributeId}, '{$defaultValue}' FROM {$this->getTable('catalog_product_entity')}
    ");
}


/**
 * Create table: wantitnow_std
 */
if (false === $installer->getConnection()->isTableExists($installer->getTable('wantitnow/std'))) {
        ->newTable($installer->getTable('wantitnow/std'))
        ->addColumn('wantitnow_std_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'identity'  => true,
    $table = $installer->getConnection()
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true
        ),
        'WantItNow Std Id'
    )
        ->addColumn('sms_dispatched', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'WantItNow SMS Dispatched')
        ->addColumn('sms_arrival', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'WantItNow SMS Arrival')
    ;
    $installer->getConnection()->createTable($table);
}

$installer->addAttribute('quote', 'wantitnow_sms_dispatched', array('type' => 'int'));
$installer->addAttribute('quote', 'wantitnow_sms_arrival', array('type' => 'int'));
$installer->addAttribute('order', 'wantitnow_std_id', array('type' => 'int'));

$installer->endSetup();
