<?php
namespace Perspective\WareHouse\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
    * Define resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('Perspective\WareHouse\Model\Post',
        'Perspective\WareHouse\Model\ResourceModel\Post');
    }
}