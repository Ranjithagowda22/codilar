<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 18/3/18
 * Time: 11:57 AM
 */

namespace Codilar\Seller\Model\ResourceModel;


class Product extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('codilar_seller_product', 'product_id');
    }

}