<?php

namespace Foggyline\Office\Block\Widget;

class Example extends \Magento\Framework\View\Element\Text implements \Magento\Widget\Block\BlockInterface
{
	protected function _beforeToHtml()
	{
		$this->setText("Hello World");			
		return parent::_beforeToHtml();
	}
}