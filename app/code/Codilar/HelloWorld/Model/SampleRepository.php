<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 2:16 PM
 */

namespace Codilar\HelloWorld\Model;


use Codilar\HelloWorld\Api\SampleRepositoryInterface;
use Codilar\HelloWorld\Model\ResourceModel\Sample\Collection;
use Codilar\HelloWorld\Model\ResourceModel\Sample\CollectionFactory;
use Codilar\HelloWorld\Model\SampleFactory as ModelFactory;
use Codilar\HelloWorld\Model\ResourceModel\Sample as ResourceModel;
use Magento\Framework\Exception\LocalizedException;

class SampleRepository implements SampleRepositoryInterface
{
    /**
     * @var SampleFactory
     */
    private $modelFactory;
    /**
     * @var ResourceModel
     */
    private $resourceModel;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * SampleRepository constructor.
     * @param SampleFactory $modelFactory
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ModelFactory $modelFactory,
        ResourceModel $resourceModel,
        CollectionFactory $collectionFactory
    )
    {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param $attributeValue
     * @param null $attributeName
     * @return Sample|null
     */
    public function load($attributeValue, $attributeName = null)
    {
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $attributeValue, $attributeName);
        return $model;
    }

    /**
     * @param Sample $sample
     * @throws LocalizedException
     * @return Sample
     */
    public function save(Sample $sample)
    {
        $this->resourceModel->save($sample);
        return $sample;
    }

    /**
     * @param $productId
     * @throws LocalizedException
     * @return mixed
     */
    public function delete($productId)
    {
        $model = $this->load($productId);
        $this->resourceModel->delete($model);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }
}