<?php

namespace Perspective\Admin\Block;

class TaskTwo extends \Magento\Catalog\Block\Product\ListProduct
{
    protected $helperData;

    public function __construct(
        \Perspective\Admin\Helper\DataHelper $helperData,
        \Magento\CatalogInventory\Api\StockStateInterface $stockState,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
    
        array $data = [])

    {
        $this->_registry = $registry;
        $this->helperData = $helperData;
        $this->stockState = $stockState;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    public function getQty($_product) 
    {
            return $this->stockState->getStockQty($_product); 
    }

    public function getNumber()
    {
        if ($this->helperData->getGeneralConfigTwo('number_on') == 1) {
            return $this->helperData->getGeneralConfigTwo('number_product');
        }
    }
}
