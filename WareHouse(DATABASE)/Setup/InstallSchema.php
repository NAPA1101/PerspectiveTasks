<?php
namespace Perspective\WareHouse\Setup;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
    {

        public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, 
        \Magento\Framework\Setup\ModuleContextInterface $context)
        {
            $installer = $setup;
            $installer->startSetup();
            if (!$installer->tableExists('perspective_warehouse')) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable('perspective_warehouse')
                )
                    ->addColumn(
                        'post_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ],
                        'Post ID'
                    )
                    ->addColumn(
                        'namewar',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Post NameWar'
                    )
                    ->addColumn(
                        'addwar',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post AddWar'
                    )
                    ->addColumn(
                        'idcat',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        '64k',
                        [],
                        'Post IDCat'
                    )
                    ->addColumn(
                        'idprod',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        [],
                        'Post IDProd'
                    )
                    ->addColumn(
                        'kolprod',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        1,
                        [],
                        'Post KolProd'
                    )
                    ->addColumn(
                            'dataprod',
                            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                            null,
                            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                            'DataProd'
                    )
                    ->setComment('Post Table');
                $installer->getConnection()->createTable($table);
    
                $installer->getConnection()->addIndex(
                    $installer->getTable('perspective_warehouse'),
                    $setup->getIdxName(
                        $installer->getTable('perspective_warehouse'),
                        ['namewar','addwar','idcat','idprod'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['namewar','addwar','idcat','idprod'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
            $installer->endSetup();
        }
    }