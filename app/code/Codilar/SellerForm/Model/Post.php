<?php
namespace Codilar\SellerForm\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'seller_product_page';

    protected $_cacheTag = 'seller_product_page';

    protected $_eventPrefix = 'seller_product_page';

    protected function _construct()
    {
        $this->_init('Codilar\SellerForm\Model\ResourceModel\Post');
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