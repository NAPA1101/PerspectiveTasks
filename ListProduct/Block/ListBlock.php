<?php




namespace Perspective\ListProduct\Block;



use Magento\Catalog\Api\Data\ProductInterface;



class ListBlock extends \Magento\Framework\View\Element\Template

{

    /** @var \Magento\Catalog\Model\ProductFactory  */

    protected $_productFactory;



    /** @var \Magento\Catalog\Model\ResourceModel\Product  */

    protected $_productResource;



    /** @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory  */

    protected $_productCollectionFactory;



    /** @var \Magento\CatalogRule\Model\RuleFactory  */

    protected $_ruleFactory;



    /** @var \Magento\CatalogRule\Model\ResourceModel\Rule  */

    protected $_ruleResource;



    /** @var \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory  */

    protected $_ruleCollectionFactory;



    /** @var \Magento\Store\Model\StoreManagerInterface  */

    protected $_storeManager;

    protected $_productRepository;



    public function __construct(

        \Magento\Catalog\Model\ProductFactory $productFactory,

        \Magento\Catalog\Model\ResourceModel\Product $productResource,

        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,

        \Magento\CatalogRule\Model\RuleFactory $ruleFactory,

        \Magento\CatalogRule\Model\ResourceModel\Rule $ruleResource,

        \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory $ruleCollectionFactory,

        \Magento\Store\Model\StoreManagerInterface $storeManager,

        //\Magento\Framework\View\Element\Template\Context $context,

        \Magento\Backend\Block\Template\Context $context,

		\Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        

        array $data = []

    ) {

        $this->_productFactory = $productFactory;

        $this->_ruleFactory = $ruleFactory;

        $this->_ruleResource = $ruleResource;

        $this->_ruleCollectionFactory = $ruleCollectionFactory;

        $this->_productResource = $productResource;

        $this->_productCollectionFactory = $productCollectionFactory;

        $this->_storeManager = $storeManager;

        $this->_productRepository = $productRepository;

        parent::__construct($context, $data);

    }



    /**

     * Get product by id via resource

     *

     * @param string $productId

     * @return \Magento\Catalog\Model\Product|null

     */

    public function getProductById($productId)

    {

        if (is_null($productId)) {

            return null;

        }



        $productModel = $this->_productFactory->create();

        $this->_productResource->load($productModel, $productId);



        return $productModel;

    }

    public function getProductId($productId)
    {
        return $this->_productRepository->getById($productId);
    }


    /**

     * @param int $price

     * @return array|\Magento\Framework\DataObject[]

     */

    public function getCheapProducts($price)

    {

        if (is_null($price)) {

            return [];

        }



        $productCollection = $this->_productCollectionFactory->create();

        $productCollection->addAttributeToSelect('*')

            ->addAttributeToFilter(ProductInterface::PRICE, ['lt' => $price])

            ->load();



        return $productCollection->getItems();

    }




public function getCatalogPriceRuleProductIds()

	{
//Обращение к Object Manager заменено на внедрение инъекций

/**$storeManager = \Magento\Framework\App\ObjectManager::getInstance()->create(

			 '\Magento\Store\Model\StoreManagerInterface'

		);*/

/** $catalogRule = \Magento\Framework\App\ObjectManager::getInstance()->create(

			 '\Magento\CatalogRule\Model\RuleFactory'

		); */



        

		

$websiteId = $this->_storeManager->getStore()->getWebsiteId();//current Website Id

	

		$resultProductIds = [];

$catalogRuleCollection = $this->_ruleCollectionFactory->create();

$catalogRuleCollection->addIsActiveFilter(1);//filter for active rules only

		foreach ($catalogRuleCollection as $catalogRule) {

			$productIdsAccToRule = $catalogRule->getMatchingProductIds();

			foreach ($productIdsAccToRule as $productId => $ruleProductArray) {

				if (!empty($ruleProductArray[$websiteId])) {

					$resultProductIds[$productId] = $productId;

				}

			}

		}

		return $resultProductIds;
    
    }


}