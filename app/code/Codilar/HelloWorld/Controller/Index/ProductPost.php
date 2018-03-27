<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 21/3/18
 * Time: 1:23 PM
 */

namespace Codilar\HelloWorld\Controller\Index;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;


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
     * @var UploaderFactory
     */
    private $fileUploaderFactory;

    /**
     * ProductPost constructor.
     * @param Context $context
     * @param Session $session
     * @param Product $product
     */
    public function __construct(
        Context $context,
        Session $session,
        Product $product,
        UploaderFactory $fileUploaderFactory

    )
    {
        parent::__construct($context);
        $this->session = $session;
        $this->product = $product;
        $this->fileUploaderFactory = $fileUploaderFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $sellerId = $this->session->getId();
        $this->messageManager->addSuccessMessage("products added sucessfully");
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererOrBaseUrl();

        try {
//            if (!$this->session->isLoggedIn()) {
//                throw new LocalizedException(__("Illegal access"));
//            } else if ($this->session->getCustomer()->getData('is_verified') != "yes") {
//                throw new LocalizedException(__("Illegal access"));
//            }
            /* @var \Magento\Framework\App\Request\Http $request */
            $request = $this->getRequest();
            $data = $request->getPostValue();

            $this->product->createProduct(
                $data['pname'],
                $data['sku'],
                $data['price'],
                $data['stock'],
                $data['enabled'],
                $data['visibility'],
                explode(",", $data['category']),
                $sellerId
            );

        } catch (InputException $inputException) {
            $this->messageManager->addWarningMessage("input error");
        } catch (StateException $stateException) {
            $this->messageManager->addWarningMessage("out of state");
        } catch (CouldNotSaveException $couldNotSaveException) {
            $this->messageManager->addWarningMessage($couldNotSaveException->getMessage());
        } catch (\Exception $exception) {
            echo $exception->getTraceAsString();die;
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;

    }
}