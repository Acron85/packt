<?php
namespace Foggyline\Plugged\Plugin;

class AbstractProductPlugin2
{
	public function beforeGetAddToCartUrl(
		$subject,
		$product,
		$additional = []
	)
	{
		echo('Plugin2 - beforeGetAddToCartUrl');
	}
	
	public function afterGetAddToCartUrl($subject)
	{
		echo('Plugin2 - afterGetAddToCartUrl');
	}
	
	public function aroundGetAddToCartUrl(
		$subject,
		\Closure $proceed,
		$product,
		$additional = []
	)
	{
		echo('Plugin2 - aroundGetAddToCartUrl');
		return $proceed($product, $additional);
	}
	
}



























