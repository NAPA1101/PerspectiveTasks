<?php
namespace Perspective\FirstTestTasks\Block;

use Magento\Payment\Api\PaymentMethodListInterface;

class FirstBlock extends \Magento\Framework\View\Element\Template
{    
    protected $_stockItemRepository;
    protected $_productRepository;
    protected $_productImageHelper;
    protected $customerCollection;
    protected $_orderCollectionFactory;
    protected $_customerGroup;
    protected $paymentMethodList;
    protected $scopeConfig; 
    protected $shipconfig;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\CatalogInventory\Model\Stock\StockItemRepository $stockItemRepository,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Catalog\Helper\Image $productImageHelper,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollection,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Customer\Model\ResourceModel\Group\CollectionFactory $groupCollectionFactory,
        PaymentMethodListInterface $paymentMethodList,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Shipping\Model\Config $shipconfig,

        
        array $data = []
    )
    {
        $this->_stockItemRepository = $stockItemRepository;
        $this->_productRepository = $productRepository;
        $this->_productImageHelper= $productImageHelper;
        $this->customerCollection = $customerCollection;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->groupCollectionFactory = $groupCollectionFactory;
        $this->paymentMethodList = $paymentMethodList;
        $this->shipconfig = $shipconfig;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }
    
    public function getStockItem($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }

    public function getProductById($id)
    {
        return $this->_productRepository->getById($id);
    }

    public function getImageOriginalWidth($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getWidth();
    }

    public function getImageOriginalHeight($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getHeight();
    }    

    public function getImageUrl($product, $imageId, $attributes = [])
    {
        return $this->_productImageHelper->init($product, $imageId, $attributes)->getUrl();
    }

    public function getAllCustomers()
    {
            return $this->customerCollection->create();
    }
    
    public function getOrderCollection()
    {
       $collection = $this->_orderCollectionFactory->create()
         ->addAttributeToSelect('*')
         ->setOrder('created_at','desc');
     
     return $collection;
     
    }
/*
    public function getCustomerGroups() {
        $customerGroups = $this->_customerGroup->toOptionArray();
        array_unshift($customerGroups, array('value'=>'', 'label'=>'Any'));
        return $customerGroups;
    }
*/
    public function getCustomerGroupCollection() {
        if (!$this->hasData('customer_group_collection')) {
            $collection = $this->groupCollectionFactory->create();
            $this->setData('customer_group_collection', $collection);
        }
 
        return $this->getData('customer_group_collection');
    }

    public function getPayment()
    {
        $storeId = 1;
        $activePaymentMethodList = $this->paymentMethodList->getList($storeId);
        return $activePaymentMethodList;
    }

    public function getShippingMethods() {
        $activeCarriers = $this->shipconfig->getActiveCarriers();
    
        foreach($activeCarriers as $carrierCode => $carrierModel) {
           $options = array();
    
           if ($carrierMethods = $carrierModel->getAllowedMethods()) {
               foreach ($carrierMethods as $methodCode => $method) {
                    $code = $carrierCode . '_' . $methodCode;
                    $options[] = array('value' => $code, 'label' => $method);
               }
               $carrierTitle = $this->scopeConfig
                   ->getValue('carriers/'.$carrierCode.'/title');
            }
    
            $methods[] = array('value' => $options, 'label' => $carrierTitle);
        }
    
        return $methods;    
    }
}
?>