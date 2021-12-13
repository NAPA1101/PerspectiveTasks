<?php
/**
* Copyright © 2019 Magenest. All rights reserved.
* See COPYING.txt for license details.
*/
namespace Perspective\Schema\Setup\Patch\Schema;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class AddColumn implements SchemaPatchInterface {
        
        private $moduleDataSetup;
        public function __construct(
        
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }
        
    public static function getDependencies()
    {
        return [];
    }
    
    public function getAliases()
        {
        return [];
        }
    
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->addColumn(
        $this->moduleDataSetup->getTable('declarative_table'),
            'bonus',
                [
                'type' => Table::TYPE_INTEGER,
                'padding' => 10,'nullable' => false, 'unsigned' => 'true',
                'comment' => 'Bonus',
                ]
    );
        $this->moduleDataSetup->endSetup();
    }
}