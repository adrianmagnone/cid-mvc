<?php
namespace Cid\Factory;

use Cid\Factory\IFactory;

use Cid\Controllers\View\ViewHtml;
use Cid\Controllers\View\ViewHtmlCache;
use Cid\Controllers\View\ViewJson;

class FactoryView implements IFactory
{
	public function create($name)
	{
		switch ($name)
		{
			case 'Html':
				return new ViewHtml;
			case 'HtmlCache':
				return new ViewHtmlCache;
			case 'Json':
				return new ViewJson;
		}
	}
}