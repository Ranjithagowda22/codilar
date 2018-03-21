<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 9:51 AM
 */

namespace Codilar\HelloWorld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Sample extends AbstractDb
{

    const TABLE_NAME = "seller_product_page";
    const ID_FIELD = "product_id";

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::ID_FIELD);
    }
}
