<?php

namespace Foggyline\Slider\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		print("UPGRADE SCRIPT");
		/**
		* Create table 'foggyline_slider_slide'
		*/
		$table = $installer->getConnection()
			->newTable($installer->getTable('foggyline_slider_slide'))
			->addColumn(
				'slide_id',
				\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
				null,
				['identity' => true, 'unsigned' => true,
				'nullable' => false, 'primary' => true],
				'Slide Id'
				)
			->addColumn(
				'title',
				\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
				200,
				[],
				'Title'
			)
			->setComment('Foggyline Slider Slide');
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}
































