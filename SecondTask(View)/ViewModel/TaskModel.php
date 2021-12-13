<?php

namespace Perspective\SecondTask\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;


class TaskModel implements ArgumentInterface
{    
    protected $_productCollectionFactory;
        
    public function __construct(       
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;
    }

    public function getProductCollectionByCategories($ids)
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        $collection->addAttributeToFilter('price', array('gteq' => 50));
        $collection->addAttributeToFilter('price', array('lteq' => 60));
        
        return $collection;
    }
}