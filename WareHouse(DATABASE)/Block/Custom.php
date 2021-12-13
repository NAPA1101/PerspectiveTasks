<?php

namespace Perspective\WareHouse\Block;

class Custom extends \Magento\Framework\View\Element\Template
{

        public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Magento\Catalog\Model\ProductRepository $productRepository,
            \Magento\Catalog\Helper\Image $imageHelper,
            \Perspective\WareHouse\Model\PostFactory $postFactory)
    {
        parent::__construct($context);
        $this->_postFactory = $postFactory;
        $this->_imageHelper = $imageHelper;
        $this->_productRepository = $productRepository;
    }
    
    public function getCatProd($idcat)
    {
        $m = []; $i = 0;
        $post = $this->_postFactory->create();
        $collection = $post->getCollection();
            foreach($collection as $item) {
                if($item->getData('idcat') == $idcat && $item->getData('kolprod') != 0) {
                    $m[$i][] = $item->getData('namewar');
                    $m[$i][] = $item->getData('idprod');
                    $i++;
                }
            }
            
        return $m;
    }

    public function getProductImage($image)
        {
            $product = $this->_productRepository->getById($image);
            $image_url = $this->_imageHelper->init($product, 'product_base_image')->getUrl();
            return $image_url;
        }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }
}