<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 1:33 PM
 */

namespace Codilar\HelloWorld\Helper;


use Codilar\HelloWorld\Api\SampleRepositoryInterface;
use Codilar\HelloWorld\Model\Sample;

class Product
{

    const PRODUCT_IS_ENABLED = 1;
    const PRODUCT_IS_DISABLED = 0;
    /**
     * @var Sample
     */
    private $sample;
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * Product constructor.
     * @param Sample $sample
     * @param SampleRepositoryInterface $sampleRepository
     */
    public function __construct(
        Sample $sample,
        SampleRepositoryInterface $sampleRepository
    )
    {
        $this->sample = $sample;
        $this->sampleRepository = $sampleRepository;
    }

    public function createProduct ($name, $price, $description = "", $categories = [], $image = "", $enabled = self::PRODUCT_IS_DISABLED) {
        $product = $this->sample->setData([
            'product_name'  =>  $name,
            'product_price' =>  $price,
            'description'   =>  $description,
            'category'      =>  implode(",", $categories),
            'image'         =>  $image,
            'enabled'       =>  $enabled
        ]);
        $this->sampleRepository->save($product);
        return $product;
    }

}