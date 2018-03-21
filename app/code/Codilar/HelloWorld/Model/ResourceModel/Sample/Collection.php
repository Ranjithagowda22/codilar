<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 9:53 AM
 */


namespace Codilar\HelloWorld\Model\ResourceModel\Sample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Codilar\HelloWorld\Model\Sample',
            'Codilar\HelloWorld\Model\ResourceModel\Sample'
        );
    }
}

