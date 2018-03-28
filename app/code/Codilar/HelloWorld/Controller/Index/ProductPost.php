<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 1:23 PM
 */

namespace Codilar\HelloWorld\Controller\Index;


use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use \Codilar\HelloWorld\Helper\Product;
use Magento\Framework\Exception\StateException;
use  Magento\Framework\App\Filesystem\DirectoryList;


class ProductPost extends Action
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Product
     */
    private $product;

    /**
     * ProductPost constructor.
     * @param Context $context
     * @param Session $session
     * @param Product $product
     */
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    /**
     * @var DirectoryList
     */
    private $directoryList;

    /**
     * ProductPost constructor.
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     * @param \Magento\Framework\Image\AdapterFactory $adapterFactory
     * @param \Magento\Framework\Filesystem $filesystem
     * @param Context $context
     * @param Session $session
     * @param Product $product
     * @param DirectoryList $directoryList
     */
    public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\Framework\Filesystem $filesystem,
        Context $context,
        Session $session,
        Product $product,
        DirectoryList $directoryList
    )
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        parent::__construct($context);
        $this->session = $session;
        $this->product = $product;
        $this->directoryList = $directoryList;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $sellerId = $this->session->getId();
        $this->messageManager->addSuccessMessage("products added sucessfully");
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererOrBaseUrl();

        try {
            /* @var \Magento\Framework\App\Request\Http $request */
            $path = $this->directoryList->getPath('media');

            $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploadedImage = $uploader->save($path);

            $path = $uploadedImage['path']."/".$uploadedImage['file'];

            $request = $this->getRequest();
            $data = $request->getPostValue();

            $product = $this->product->createProduct(
                $data['pname'],
                $data['sku'],
                $data['price'],
                $data['stock'],
                $data['enabled'],
                $data['visibility'],
                explode(",", $data['category']),
                $sellerId,
                $path
            );

            /*echo "<pre>";
            print_r($product->getData());die;*/

//        } catch (InputException $inputException) {
//            $this->messageManager->addWarningMessage($inputException->getMessage());
//        } catch (StateException $stateException) {
//            $this->messageManager->addWarningMessage($stateException->getMessage());
//        } catch (CouldNotSaveException $couldNotSaveException) {
//            echo $couldNotSaveException->getTraceAsString();die;
//            $this->messageManager->addWarningMessage($couldNotSaveException->getMessage());
        } catch (\Exception $exception) {
           throw $exception;
            $this->messageManager->addErrorMessage($exception->getMessage());
        }



        return $resultRedirect;

    }
}