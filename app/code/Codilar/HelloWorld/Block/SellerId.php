<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 26/3/18
 * Time: 6:16 PM
 */

namespace Codilar\HelloWorld\Block;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Catalog\Model\Product;

class SellerId extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Registry
     */
    private $registry;

    /**
     * HelloWorld constructor.
     * @param Template\Context $context
     * @param Session $session
     * @param array $data
     */
    public function __construct(Template\Context $context, Registry $registry, array $data = [])
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
    }

    public function getSellerId()
    {
        /*@var \Magento\Catalog\Model\Product $product */
       $product=$this->registry->registry("current_product");
//       var_dump($product->getData('vendor_id'));die;
       return $product->getData('vendor_id');

    }
}