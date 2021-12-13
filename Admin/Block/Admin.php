<?php

namespace Perspective\Admin\Block;

class Admin extends \Magento\Framework\View\Element\Template
{
    protected $helperData;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Perspective\Admin\Helper\DataHelper $helperData,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\CatalogInventory\Api\StockStateInterface $stockState,
        \Magento\Framework\Registry $registry,
        array $data = [])
        
        {
            parent::__construct($context, $data);
            $this->_registry = $registry;
            $this->_productRepository = $productRepository;
            $this->helperData = $helperData;
            $this->stockState = $stockState;
        }

        public function currentProduct() {
            return $this->_registry->registry('current_product');
        }

        public function priceProduct() {
            return $this->_productRepository->getById($this->currentProduct()->getId() - 1)->getPrice();
        }
        
        public function getExchangeRatesUAH()
        {   
            if ($this->helperData->getGeneralConfig('enable_ua') == 1) {
                return $this->priceProduct() * $this->helperData->getGeneralConfig('ua');
            }
        }

        public function getExchangeRatesRUS()
        {   
            if ($this->helperData->getGeneralConfig('enable_ru') == 1) {
                return $this->priceProduct() * $this->helperData->getGeneralConfig('ru');
            }
        }

        public function getExchangeRatesEURO()
        {   
            if ($this->helperData->getGeneralConfig('enable_euro') == 1) {
                return $this->priceProduct() * $this->helperData->getGeneralConfig('euro');
            }
        }

        public function getQty() 
        {
            return $this->stockState->getStockQty($this->currentProduct()->getId()-1); 
        }

        public function getTest() {
            return $this->helperData->getGeneralConfigTwo('number_product');
        }
}
