<?php

namespace Foggyline\Office\Observer;

use Magento\Framework\Event\ObserverInterface;

class LogCustomerEmail implements ObserverInterface
{
	public function __construct(\Psr\Log\LoggerInterface $logger)
	{
		$this->logger = $logger;
	}
	
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$costomer = $obsever->getEvent()->getModel();
		$this->logger->info('Foggyline\Office: ' . $customer->getEmail());
		return $this;
	}
}