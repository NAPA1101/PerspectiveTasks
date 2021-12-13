<?php
namespace Perspective\SecondTask\Block;
class TaskBlock extends \Magento\Framework\View\Element\Template
{    
    protected $_productCollectionFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $data);
    }

    public function getProductCollectionByCategories($ids){
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        $collection->addAttributeToFilter('price', array('gteq' => 50));
        $collection->addAttributeToFilter('price', array('lteq' => 60));
        
        return $collection;
    }
}