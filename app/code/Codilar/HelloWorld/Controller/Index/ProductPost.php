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
use Magento\Framework\Exception\LocalizedException;

class ProductPost extends Action
{
    /**
     * @var Session
     */
    private $session;

    /**
     * ProductPost constructor.
     * @param Session $session
     * @param Context $context
     */
    public function __construct(
        Session $session,
        Context $context
    )
    {
        parent::__construct($context);
        $this->session = $session;
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
        try {
//            if (!$this->session->isLoggedIn()) {
//                throw new LocalizedException(__("Illegal access"));
//            } else if ($this->session->getCustomer()->getData('is_verified') != "yes") {
//                throw new LocalizedException(__("Illegal access"));
//            }
            /* @var \Magento\Framework\App\Request\Http $request */
            $request = $this->getRequest();
            $data = $request->getPostValue();


        } catch(LocalizedException $localizedException) {

        } catch (\Exception $exception) {

        }
    }
}