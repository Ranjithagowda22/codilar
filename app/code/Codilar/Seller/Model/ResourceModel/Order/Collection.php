<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 18/3/18
 * Time: 12:00 PM
 */
namespace Codilar\Seller\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'order_id';
    protected $_eventPrefix = 'Codilar_seller_collection';
    protected $_eventObject = 'order_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codilar\Seller\Model\Order', 'Codilar\Seller\Model\ResourceModel\Order');
    }

}