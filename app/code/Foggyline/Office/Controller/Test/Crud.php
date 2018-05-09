<?php

namespace Foggyline\Office\Controller\Test;

class Crud extends \Foggyline\Office\Controller\Test
{
	protected $employeeFactory;
	protected $departmentFactory;
	protected $resultPageFactory;
	protected $messageManager;
	protected $sessionManager;
	protected $cookieMetadataFactory;
	protected $cookieManagerInterface;
	protected $configInterFace;
	protected $logger;
	
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Foggyline\Office\Model\EmployeeFactory $employeeFactory,
		\Foggyline\Office\Model\DepartmentFactory $departmentFactory,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Message\ManagerInterface $messageManager,
		\Magento\Framework\Session\SessionManagerInterface $sessionManager,
		\Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
		\Magento\Framework\Stdlib\CookieManagerInterface $cookieManagerInterface,
		\Magento\Framework\Session\Config\ConfigInterface $configInterFace,
		\Psr\Log\LoggerInterface $logger
	)
	{
		$this->messageManager = $messageManager;
		$this->employeeFactory = $employeeFactory;
		$this->departmentFactory = $departmentFactory;
		$this->resultPageFactory = $resultPageFactory;
		$this->sessionManager = $sessionManager;
		$this->cookieMetadataFactory = $cookieMetadataFactory;
		$this->cookieManagerInterface = $cookieManagerInterface;
		$this->configInterFace = $configInterFace;
		$this->logger = $logger;
		return parent::__construct($context);
	}	
	public function execute()
	{
		/* $department1 = $this->departmentFactory->create();
		$department1->setName('Finace');
		$department1->save();
		
		$department2 = $this->departmentFactory->create();
		$department2->setData('name', 'Research');
		$department2->save();
		
		$department3 = $this->departmentFactory->create();
		$department3->setData(['name' => 'Support']);
		$department3->save();
		
		$employee1 = $this->employeeFactory->create();
		$employee1->setDepartmentId($department1->getId());
		$employee1->setEmail('goran@mail.loc');
		$employee1->setFirstName('Goran');
		$employee1->setLastName('Gorvat');
		$employee1->setSeviceYears(3);
		$employee1->setDob('1984-04-18');
		$employee1->setSalary(3800.00);
		$employee1->setVatNumber('GB123451234');
		$employee1->setNote('Note #1');
		$employee1->save();
		
		//EAV model, creating new entities, flavour #2
		$employee2 = $this->employeeFactory->create();
		$employee2->setData('department_id', $department2->getId());
		$employee2->setData('email', 'marko@mail.loc');
		$employee2->setData('first_name', 'Marko');
		$employee2->setData('last_name', 'Tunukovic');
		$employee2->setData('service_years', 3);
		$employee2->setData('dob', '1984-04-18');
		$employee2->setData('salary', 3800.00);
		$employee2->setData('vat_number', 'GB123451234');
		$employee2->setData('note', 'Note #2');
		$employee2->save();
		
		//EAV model, creating new entities, flavour #3
		$employee3 = $this->employeeFactory->create();
		$employee3->setData([
		'department_id' => $department3->getId(),
		'email' => 'ivan@mail.loc',
		'first_name' => 'Ivan',
		'last_name' => 'Telebar',
		'service_years' => 2,
		'dob' => '1986-08-22',
		'salary' => 2400.00,
		'vat_number' => 'GB123454321',
		'note' => 'Note #3'
		]);
		$employee3->save(); 
		
		//Simple model, reading existing entities
		$department = $this->departmentFactory->create();
		$department->load(28);
		
		//EAV model, reading existing entities
		$employee = $this->employeeFactory->create();
		$employee->load(25);
		
		\Zend_Debug::dump($employee->toArray());
		
		
		//Udating existing entities
		$department = $this->departmentFactory->create();
		$department->load(28);
		$department->setName('Finance #2');
		$department->save();
		
		//Deleting existing entities
		$employee = $this->employeeFactory->create();
		$employee->load(25);
		$employee->delete(); 
		*/
		
		//Managing collection
		
		$collection = $this->employeeFactory->create()
			->getCollection();
		
		/* $collection = $this->_objectManager->create(
			'Foggyline\Office\Model\ResourceModel\Employee\Collection'
		); */
		
		$collection->addAttributeToSelect('salary')
					->addAttributeToSelect('vat_number');
					
		$collection->addAttributeToSelect('*')
			->setPageSize(25)
			->setCurPage(1);
		/* $collection->addAttributeToFilter('email',['like'=>'%mail.loc%'])
			->addAttributeToFilter('vat_number', ['like'=>'GB%'])
			->addAttributeToFilter('salary', ['gt'=>2400])
			->addAttributeToFilter('service_years', ['lt'=>10]); */
			
		$collection->addAttributeToFilter([
			['attribute'=>'salary', 'gt'=>2400],
			['attribute'=>'vat_number', 'like'=>'GB%']
		]);
		/* 	
		  foreach($collection as $employee){			
			\Zend_Debug::dump($employee->toArray());
		} */  
		
		/* $resultPage = $this->resultPageFactory->create();
		$this->messageManager->addSuccessMessage('Success-1');
		$this->messageManager->addSuccess('Success-2');
		$this->messageManager->addNotice('Notice-1');
		$this->messageManager->addNotice('Notice-2');
		$this->messageManager->addWarning('Warning-1');
		$this->messageManager->addWarning('Warning-2');
		$this->messageManager->addError('Error-1');
		$this->messageManager->addError('Error-2');
		return $resultPage; */
		
		$this->sessionManager->setFoggylineOfficeVar1('Office1');
		
		$cookieValue = 'Just some value';
		
		$cookieMetadata = $this->cookieMetadataFactory
			->createPublicCookieMetadata()
			->setDuration(3600)
			->setPath($this->configInterFace->getCookiePath())
			->setDomain($this->configInterFace->getCookieDomain())
			->setSecure($this->configInterFace->getCookieSecure())
			//->setHttpOnly($this->configInterFace->getCookieHttpOnly())
			;
		$this->cookieManagerInterface
			->setPublicCookie('cookie_name_1', $cookieValue, $cookieMetadata);
			
		$cookieMetadata = $this->cookieMetadataFactory
			->createSensitiveCookieMetadata()
			->setPath($this->configInterFace->getCookiePath())
			->setDomain($this->configInterFace->getCookieDomain())
		
			;
		$this->cookieManagerInterface->setSensitiveCookie('cookie_name_2', $cookieValue, $cookieMetadata);
			
		$this->logger->log(\Monolog\Logger::DEBUG, 'debug mgr');
		$this->logger->log(\Monolog\Logger::INFO, 'info msg');
		$this->logger->log(\Monolog\Logger::NOTICE, 'info msg');
		$this->logger->log(\Monolog\Logger::WARNING, 'warning msg');
		$this->logger->log(\Monolog\Logger::ERROR, 'error msg');
		$this->logger->log(\Monolog\Logger::CRITICAL, 'critical msg');
		$this->logger->log(\Monolog\Logger::ALERT, 'alert msg');
		$this->logger->log(\Monolog\Logger::EMERGENCY, 'emergency msg');
		
		$this->logger->debug('debug msg');
		$this->logger->notice('notice msg');
		$this->logger->error('error msg');
		$this->logger->warning('warning msg');
		
		$this->logger->info('User logged in', ['user' => 'Branco', 'age' => '32']);
		
		echo'<pre>';
		print_r($this->configInterFace->getOptions());
		echo'</pre>';
		/*\Magento\Framework\Profiler::start('foggyline:office:blabla');
		sleep(2);  // code block or single expression here
		\Magento\Framework\Profiler::stop('foggyline:office:blabla');*/
		
		
	}
}




















