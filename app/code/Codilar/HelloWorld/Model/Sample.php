<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 9:49 AM
 */


namespace Codilar\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;

class Sample extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Codilar\HelloWorld\Model\ResourceModel\Sample');
    }
}
