<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 18/3/18
 * Time: 11:58 AM
 */
namespace Codilar\Seller\Model\ResourceModel;


class Order extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('codilar_seller_Order', 'order_id');
    }

}