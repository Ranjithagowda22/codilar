<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 19/3/18
 * Time: 5:46 PM
 */
namespace Codilar\SellerForm\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();
        $table = $installer->getConnection()
       /* $tableName = $installer->getTable('seller_product_page');
        if (!$installer->tableExists('$tableName')) {
            $table = $installer->getConnection()*/
                ->newTable($installer->getTable('seller_product_page'))
                ->addColumn('product_id', Table::TYPE_INTEGER, null, [
                    'identity' => true,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ], 'Post ID')
                ->addColumn('category', Table::TYPE_TEXT, 255, ['nullable => false'], 'Post Category')
                ->addColumn('product_name', Table::TYPE_TEXT,255,['nullable=>false'], 'Post Product_Name')
                ->addColumn('product_price', Table::TYPE_TEXT,255,['nullable=>false'], 'Post Product_Price')
                ->addColumn('url_key', Table::TYPE_TEXT, 255, [], 'Post URL Key')
                ->addColumn('description', Table::TYPE_TEXT, '64k', [], 'Post  Description')
                ->addColumn('image', Table::TYPE_TEXT, 255, [], 'Post Image')
                ->addColumn('enabled', Table::TYPE_INTEGER, 1, [], 'Post Enabled')
                ->setComment('About Your Table');
                $installer->getConnection()->createTable($table);
                $installer->endSetup();
    }
}