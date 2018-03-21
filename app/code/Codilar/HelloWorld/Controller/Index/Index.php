<?php

namespace Emipro\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Emipro\HelloWorld\Model\SampleFactory;

class Index extends Action
{
    /**
     * @var \Codilar\HelloWorld\Model\SampleFactory
     */
    protected $_modelSampleFactory;

    /**
     * @param Context $context
     * @param SampleFactory $modelSampleFactory
     */
    public function __construct(
        Context $context,
        SampleFactory $modelSampleFactory
    ) {
        parent::__construct($context);
        $this->_modelSampleFactory = $modelSampleFactory;
    }

    public function execute()
    {
        $sampleModel = $this->_modelSampleFactory->create();

        // Load the item with ID is 1
        $item = $sampleModel->load(1);
        var_dump($item->getData());

        // Get sample collection
        $sampleCollection = $sampleModel->getCollection();
        // Load all data of collection
        var_dump($sampleCollection->getData());
    }
}