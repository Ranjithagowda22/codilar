<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 2:10 PM
 */

namespace Codilar\HelloWorld\Api;

use Codilar\HelloWorld\Model\ResourceModel\Sample\Collection;
use Codilar\HelloWorld\Model\Sample;
use Magento\Framework\Exception\LocalizedException;

interface SampleRepositoryInterface
{
    /**
     * @param $attributeValue
     * @param null $attributeName
     * @return Sample|null
     */
    public function load($attributeValue, $attributeName = null);

    /**
     * @param Sample $sample
     * @throws LocalizedException
     * @return Sample
     */
    public function save(Sample $sample);

    /**
     * @param $productId
     * @throws LocalizedException
     * @return mixed
     */
    public function delete($productId);

    /**
     * @return Collection
     */
    public function getCollection();
}