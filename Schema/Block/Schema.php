<?php

namespace Perspective\Schema\Block;

class Schema extends \Magento\Framework\View\Element\Template
{
        public function __construct(
            \Magento\Framework\View\Element\Template\Context $context,
            \Perspective\Schema\Model\ContactdetailsFactory $ContactdetailsFactory)
    {
        parent::__construct($context);
        $this->_ContactdetailsFactory = $ContactdetailsFactory;
    }

    public function getResult()
    {
        $post = $this->_ContactdetailsFactory->create();
        $collection = $post->getCollection();
        return $collection;
    }

    public function getFilter($name)
    {
        $post = $this->_ContactdetailsFactory->create();
        $collection = $post->getCollection();
        $collection->addFieldToFilter('name', $name)
        ->addFieldToFilter('data_review', array('gteq' => date('Y-m-01')));
        return $collection;        
    }
}