<?php
namespace Codilar\HelloWorld\Observer;


class Register implements ObserverInterface
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


