<?php

namespace Perspective\WareHouse\Block;

class Tab extends \Magento\Framework\View\Element\Template
{
    protected $_registry;

        public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Perspective\WareHouse\Model\PostFactory $postFactory,
            \Magento\Framework\Registry $registry,
            array $data = []
        )
    {
        parent::__construct($context, $data);
        $this->_postFactory = $postFactory;
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function getCurrentCategory()
    {        
        return $this->_registry->registry('current_category');
    }
    
    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }    
}