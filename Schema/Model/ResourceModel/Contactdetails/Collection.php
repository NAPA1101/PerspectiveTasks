<?php
namespace Perspective\Schema\Model\ResourceModel\Contactdetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
    * Define resource model
    *
    * @return void
    */
    protected function _construct()
    {
        $this->_init('Perspective\Schema\Model\Contactdetails',
        'Perspective\Schema\Model\ResourceModel\Contactdetails');
    }
}