<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 18/3/18
 * Time: 11:51 AM
 */
namespace Codilar\Seller\Model;
class Order extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'Codilar_Seller_Order';

    protected $_cacheTag = 'Codilar_Seller_Order';

    protected $_eventPrefix = 'Codilar_Seller_Order';

    protected function _construct()
    {
        $this->_init('Codilar\Seller\Model\ResourceModel\Order');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}