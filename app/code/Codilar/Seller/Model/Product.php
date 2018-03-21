<?php
/**
 * Created by PhpStorm.
 * User: manish
 * Date: 18/3/18
 * Time: 11:43 AM
 */
namespace Codilar\Seller\Model;
class Product extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'Codilar_Seller_Product';

    protected $_cacheTag = 'Codilar_Seller_Product';

    protected $_eventPrefix = 'Codilar_Seller_Product';

    protected function _construct()
    {
        $this->_init('Codilar\Seller\Model\ResourceModel\Product');
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