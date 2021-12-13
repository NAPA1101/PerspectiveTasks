<?php
namespace Perspective\Schema\Setup\Patch\Data;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Perspective\Schema\Model\ContactdetailsFactory;
Use Perspective\Schema\Model\ResourceModel\Contactdetails;
class AddData implements DataPatchInterface, PatchVersionInterface
{
	private $contactDetailsFactory;
	private $contactDetailsResource;
	private $moduleDataSetup;
	public function __construct(
		ContactdetailsFactory $contactDetailsFactory,
		Contactdetails $contactDetailsResource,
		ModuleDataSetupInterface $moduleDataSetup
	)
	{
		$this->contactDetailsFactory = $contactDetailsFactory;
		$this->contactDetailsResource = $contactDetailsResource;
		$this->moduleDataSetup=$moduleDataSetup;
	}
	public function apply()
	{
		$this->moduleDataSetup->startSetup();
		
		$contact1=$this->contactDetailsFactory->create();    	   
        $contact1->setProductId(5)->setTextReview('Text')->setDataReview('2021-11-13')->setName('Andrey')->setEmail('Andrey@mail')->setBonus(5);
		$this->contactDetailsResource->save($contact1);
		
		$contact2=$this->contactDetailsFactory->create(); 
        $contact2->setProductId(5)->setTextReview('Text')->setDataReview('2021-10-16')->setName('Andrey')->setEmail('Andrey@mail')->setBonus(5);
		$this->contactDetailsResource->save($contact2);
		
		$contact3=$this->contactDetailsFactory->create(); 
        $contact3->setProductId(2)->setTextReview('Text')->setDataReview('2021-11-4')->setName('Kirill')->setEmail('Kirill@mail')->setBonus(2);
		$this->contactDetailsResource->save($contact3);
		
		$contact4=$this->contactDetailsFactory->create(); 
        $contact4->setProductId(2)->setTextReview('Text')->setDataReview('2021-11-6')->setName('Ivan')->setEmail('Ivan@mail')->setBonus(2);
		$this->contactDetailsResource->save($contact4);
		
		$contact5=$this->contactDetailsFactory->create(); 
        $contact5->setProductId(3)->setTextReview('Text')->setDataReview('2021-11-9')->setName('Semen')->setEmail('Semen@mail')->setBonus(3);
		$this->contactDetailsResource->save($contact5);

		$contact6=$this->contactDetailsFactory->create(); 
        $contact6->setProductId(5)->setTextReview('Text')->setDataReview('2021-11-22')->setName('Andrey')->setEmail('Andrey@mail')->setBonus(5);
		$this->contactDetailsResource->save($contact6);
		
		$this->moduleDataSetup->endSetup();
	}
	public static function getDependencies()
	{
		return [];
	}
	public static function getVersion()
	{
		return '1.0.1';
	}
	public function getAliases()
 
	{
		return [];
	}
}