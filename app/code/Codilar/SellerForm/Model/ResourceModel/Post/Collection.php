<?php
namespace Codilar\SellerForm\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'product_id';
    protected $_eventPrefix = 'seller_product_page_collection';
    protected $_eventObject = 'page_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codilar\SellerForm\Model\Post', 'Codilar\SellerForm\Model\ResourceModel\Post');
    }

}

