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
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product as VendorProduct;
use Magento\Catalog\Model\ImageUploaderFactory;

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
     *
        /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var VendorProduct
     */
    private $product;
    /**
     * @var ImageUploaderFactory
     */
    private $imageUploaderFactory;

    /**
     * Product constructor.
     * @param Sample $sample
     * @param VendorProduct $product
     * @param SampleRepositoryInterface $sampleRepository
     * @param ProductRepositoryInterface $productRepository
     * @param ImageUploaderFactory $imageUploaderFactory
     * @internal param VendorProduct $vendorproduct
     */
    public function __construct(
        Sample $sample,
        VendorProduct $product,
        SampleRepositoryInterface $sampleRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->sample = $sample;
        $this->sampleRepository = $sampleRepository;
        $this->productRepository = $productRepository;
        $this->product = $product;
    }


    /**
     * @param string $name
     * @param string $sku
     * @param float $price
     * @param int $stock
     * @param int $enabled
     * @param array $visibility
     * @param array $categories
     * @param string $image
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return VendorProduct
     */
    public function createProduct (
        $name,
        $sku,
        $price,
        $stock,
        $enabled = self::PRODUCT_IS_DISABLED,
        $visibility = VendorProduct\Visibility::VISIBILITY_NOT_VISIBLE,
        $categories = [],
        $sellerId
    ) {

        //$imageUploader = $this->imageUploaderFactory->create();


        $product = $this->product;

            $product->setTypeId(\Magento\Catalog\Model\Product\Type::TYPE_SIMPLE)
                ->setAttributeSetId(4)// 4 is id of Default attribute set here
                ->setName($name)
                ->setSku($sku)
                ->setPrice($price)
                ->setData('category_ids', implode(",", $categories))
                ->setStockData(['use_config_manage_stock' => 1, 'qty' => 100, 'is_qty_decimal' => 0, 'is_in_stock' => $stock])
                ->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_NOT_VISIBLE)
                ->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED)
                ->setData('vendor_id', $sellerId);
//        foreach ($_FILES as $fileId => $file) {
//                $path = $imageUploader->saveFileToTmpDir($fileId);
//                $product->addImageToMediaGallery( $path ,
//                    [
//                        'image', 'small_image', 'thumbnail'
//                    ], true, false );
//            }

        $sellerproduct = $this->productRepository->save($product);
        // var_dump("hello world");

           // var_dump($product->getData());
           return $product;
        }


}