<?php

namespace Cid\Controllers;

use Cid\Controllers\Controller;

class ErrorController extends Controller
{
	public function notFound()
	{
		$this->set('codigo',      404);
		$this->set('descripcion', 'La página que estas buscando no existe.');
		return $this->render('error');
	}

	public function notAllowed()
	{
		$this->set('codigo',      500);
		$this->set('descripcion', 'La página que estas buscando no existe.');
		return $this->render('error');
	}
}