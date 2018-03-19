<?php
/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 17/3/18
 * Time: 6:59 PM
 */

/**
 * Created by PhpStorm.
 * User: ranjitha
 * Date: 13/3/18
 * Time: 11:23 AM
 */

namespace Codilar\HelloWorld\Observer;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Page\Config;


class Account implements ObserverInterface
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Config
     */
    private $pageConfig;

    /**
     * Product constructor.
     * @param Session $session
     * @param Config $pageConfig
     */
    public function __construct(
        Session $session,
        Config $pageConfig
    )
    {
        $this->session = $session;
        $this->pageConfig = $pageConfig;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /* @var Customer $customer */
        $this->pageConfig->getTitle()->set("create new account");
        $this->session->logout();
    }
}


