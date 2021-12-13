<?php
namespace Perspective\WareHouse\Model;
class Post extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    
    {
        $this->_init
        ('Perspective\WareHouse\Model\ResourceModel\Post');
    }
}