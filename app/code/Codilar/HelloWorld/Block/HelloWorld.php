<?php

namespace Codilar\HelloWorld\Block;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\Product\Visibility;

class HelloWorld extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CategoryCollectionFactory
     */
    private $categoryCollectionFactory;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var Visibility
     */
    private $visibility;

    /**
     * Construct
     *
     * @param \Magento\Backend\Block\Template\Context|\Magento\Framework\View\Element\Template\Context $context
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param Visibility $visibility
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        CategoryCollectionFactory $categoryCollectionFactory,
        StoreManagerInterface $storeManager,
        Visibility $visibility,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->storeManager = $storeManager;
        $this->visibility = $visibility;
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        // companymodule is given in routes.xml
        // controller_name is folder name inside controller folder
        // action is php file name inside above controller_name folder
        $action = $this->_urlBuilder->getUrl('hello/index/index');
        return $action;
        // here controller_name is index, action is booking
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    public function getAllCategories()
    {
        /* @var \Magento\Store\Model\Store $currentStore */
        $currentStore = $this->storeManager->getStore();
        return $this->categoryCollectionFactory->create()
            ->addAttributeToSelect(['name'])
            ->addAttributeToFilter('entity_id', ['neq' => $currentStore->getRootCategoryId()])
            ->addAttributeToFilter('is_active', 1);
    }

    public function getVisibilities() {
        return $this->visibility->toOptionArray();
    }

}
