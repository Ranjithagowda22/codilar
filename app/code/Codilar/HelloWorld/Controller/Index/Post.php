<?php

namespace Codilar\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

class Post extends Action
{

    public function __construct(
        \Magento\Framework\App\Action\Context $context

    ) {
        parent::__construct($context);
    }
    public function execute()
    {
        $data = $this->getRequest()->getParam('category');
        $data = $this->getRequest()->getParam('product_name');
        $data = $this->getRequest()->getParam('product_price');
        $data = $this->getRequest()->getParam('description');
        $data = $this->getRequest()->getParam('image');
        $data = $this->getRequest()->getParam('product_name');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $question = $objectManager->create('Codilar\HelloWorld\Model\Sample');
        $question->setData($data);
//$question->setEmail('test@test.com');
//$question->setQuery('Question Description');
        $question->save();
        $this->messageManager->addSuccess( __('Thanks for your valuable feedback.') );
//$this->messageManager->addSuccess('Query subbmitted successfully.');
        $this->_redirect('hello/inedx/post');
        return;



    }
}
