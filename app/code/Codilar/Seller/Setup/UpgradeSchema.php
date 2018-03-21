<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 18/3/18
 * Time: 10:47 AM
 */

namespace Mageplaza\HelloWorld\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;

        $installer->startSetup();

        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists('Codilar_Seller_Product')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('Codilar_Seller_Product')
                )
                    ->addColumn(
                        'product_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [   'autoincrement'=>true,
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Product ID'
                    )
                    ->addColumn(
                        'product_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Product Name'
                    )
                    ->addColumn(
                        'url_key',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Product URL Key'
                    )
                    ->addColumn(
                        'product_decription',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        '64k',
                        [],
                        'product_decription'
                    )
                    ->addColumn(
                        'product_price',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Product Price'
                    )
                    ->addColumn(
                        'product_status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        1,
                        [],
                        'Product Status'
                    )
                    ->addColumn(
                        'featured_image',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post Featured Image'
                    )
                    ->addColumn(
                        'created_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Post Table');
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable('mageplaza_helloworld_post'),
                    $installer->getTable('Codilar_seller_product'),
                    $setup->getIdxName(
                        $installer->getTable('Codilar_seller_product'),
                        ['product_name', 'url_key', 'product_description', 'product_price', 'featured_image'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['product_name', 'url_key', 'product_description', 'product_price', 'featured_image'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }

            if (!$installer->tableExists('Codilar_Seller_Order')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('Codilar_Seller_Order')
                )
                    ->addColumn(
                        'Order_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [   'autoincrement'=>true,
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Order ID'
                    )
                    ->addColumn(
                        'product_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Product Id'
                    )
                    ->addColumn(
                        'product_name',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Product Name'
                    )
                    ->addColumn(
                        'url_key',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post URL Key'
                    )
                    ->addColumn(
                        'product_description',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        '64k',
                        [],
                        'Product Description'
                    )
                    ->addColumn(
                        'product_price',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Product Price'
                    )
                    ->addColumn(
                        'order status',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        1,
                        [],
                        'order Status'
                    )
                    ->addColumn(
                        'created_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                        'Created At'
                    )->addColumn(
                        'updated_at',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                        'Updated At')
                    ->setComment('Product Table');
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable('Codilar_seller_Order'),
                    $setup->getIdxName(
                        $installer->getTable('Codilar_seller_Order'),
                        ['order_id', 'url_key', 'product_name', 'product_price', 'order_status'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['order_id', 'url_key', 'product_name', 'product_price', 'order_status'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }



        }

        $installer->endSetup();
    }
}