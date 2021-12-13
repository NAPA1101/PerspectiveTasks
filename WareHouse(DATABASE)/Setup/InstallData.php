<?php

namespace Perspective\WareHouse\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	protected $_postFactory;

	public function __construct(\Perspective\WareHouse\Model\PostFactory $postFactory)
	{
		$this->_postFactory = $postFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$data = [
			'namewar' => "WareHouse#1",
			'addwar'  => "Address#1",
			'idcat'   => '14',
			'idprod'  => '436',
			'kolprod' => 5

		];
        $post = $this->_postFactory->create();
		$post->addData($data)->save();

        $data = [
            'namewar' => "WareHouse#1",
			'addwar'  => "Address#1",
			'idcat'   => '14',
			'idprod'  => '420',
			'kolprod' => 2
        ];
        $post = $this->_postFactory->create();
		$post->addData($data)->save();

        $data = [
            'namewar' => "WareHouse#1",
			'addwar'  => "Address#1",
			'idcat'   => '14',
			'idprod'  => '404',
			'kolprod' => 0
        ];
        $post = $this->_postFactory->create();
		$post->addData($data)->save();

        $data = [
            'namewar' => "WareHouse#2",
			'addwar'  => "Address#2",
			'idcat'   => '14',
			'idprod'  => '388',
			'kolprod' => 6
        ];
        $post = $this->_postFactory->create();
		$post->addData($data)->save();

        $data = [
            'namewar' => "WareHouse#3",
			'addwar'  => "Address#3",
			'idcat'   => '14',
			'idprod'  => '410',
			'kolprod' => 8
        ];
		$post = $this->_postFactory->create();
		$post->addData($data)->save();
		
		$data = [
            'namewar' => "WareHouse#3",
			'addwar'  => "Address#3",
			'idcat'   => '14',
			'idprod'  => '356',
			'kolprod' => 0
        ];
		$post = $this->_postFactory->create();
		$post->addData($data)->save();

		$data = [
            'namewar' => "WareHouse#3",
			'addwar'  => "Address#3",
			'idcat'   => '14',
			'idprod'  => '292',
			'kolprod' => 4
        ];
		$post = $this->_postFactory->create();
		$post->addData($data)->save();

		$data = [
            'namewar' => "WareHouse#3",
			'addwar'  => "Address#3",
			'idcat'   => '14',
			'idprod'  => '276',
			'kolprod' => 1
        ];
		$post = $this->_postFactory->create();
		$post->addData($data)->save();
	}
}