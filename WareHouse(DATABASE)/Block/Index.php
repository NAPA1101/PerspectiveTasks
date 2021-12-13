<?php

namespace Perspective\WareHouse\Block;

class Index extends \Magento\Framework\View\Element\Template
{

        public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Perspective\WareHouse\Model\PostFactory $postFactory)
    {
        parent::__construct($context);
        $this->_postFactory = $postFactory;
        $this->_productRepository = $productRepository;
    }

    public function getResult()
    {
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
        return $collection;
    }

    public function getNameProd($namewar)
    {
        $m = [];
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
            foreach($collection as $item) {
                if($item->getData('namewar') == $namewar) {
                    $m[] = $item->getData('idprod');
                }
            }
            return $m;
    }
    public function getProductById($id) 
    {
        return $this->_productRepository->getById($id);
    }
}