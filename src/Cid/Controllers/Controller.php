<?php
namespace Cid\Controllers;

use Cid\Controllers\IController;
use Cid\Controllers\View\IView;
use Cid\Controllers\View\ViewHtml;
use Cid\Controllers\View\ViewJson;
use Cid\Controllers\View\ViewHtmlCache;

use Cid\Factory\IFactory;
use Exception;

class Controller implements IController
{
	/**
	* @var IView
	*/
	protected $view = false;

	/**
	* @var array
	*/
	protected $vars = array();

	/**
	* @var IFactory
	*/
	protected $factoryModels;

	/**
	* @var IFactory
	*/
	protected $factoryViews;

	protected $request;
	protected $response;
	protected $parameters;

	public function before($request, $response, $vars)
	{
		$this->request = $request;
		$this->response = $response;
		$this->parameters = $vars;
	}

	public function render($name_view = '')
	{
		if (! $this->view)
		{
			$this->setContentToHtml();
		}

		$this->view->setResponse($this->response);
		$this->assignVarsToView();

		return $this->view->render($name_view);
	}

	public function set($name, $value = false)
	{
		if (is_array($name))
		{
			$this->setArray($name);
			return;
		}
		$this->vars[$name] = $value;
	}

	private function setArray(Array $data)
	{
		foreach ($data as $key => $value)
		{
			$this->vars[$key] = $value;
		}
	}

	public function setContentToHtml()
	{
		$this->view = $this->view('Html');
	}

	public function setContentToHtmlWithCache()
	{
		$this->view = $this->view('HtmlCache');
	}

	public function setContentToJson()
	{
		$this->view = $this->view('Json');
	}

	public function setContentToPlainText()
	{
		$this->view = $this->view('Text');
	}

	public function setContentToXml()
	{
		$this->view = $this->view('Xml');
	}

	private function assignVarsToView()
	{
		foreach ($this->vars as $key => $value)
		{
			$this->view->set($key, $value);
		}
	}

	public function getUrlBase()
	{
		return 'http' .
			($_SERVER['SERVER_PORT'] == 443 ? 's' : '') . '://' .
			 $_SERVER['HTTP_HOST'] . '/' ;
	}

	public function esMobil()
	{
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
		{
			return true;
		}
		return false;
	}

	public function setFactoryModels(IFactory $factory)
	{
		$this->factoryModels = $factory;
	}

	public function model($name)
	{
		if (! $this->factoryModels)
		{
			throw new Exception("No existe la forma de crear el modelo", 1);
		}

		return $this->factoryModels->create($name);
	}

	public function setFactoryViews(IFactory $factory)
	{
		$this->factoryViews = $factory;
	}

	public function view($name)
	{
		if (! $this->factoryViews)
		{
			throw new Exception("No existe la forma de crear la vista", 1);
		}

		return $this->factoryViews->create($name);
	}

	public function getParam($name)
	{
		if (! $this->parameters)
		{
			return false;
		}

		return (isset($this->parameters[$name])) ? $this->parameters[$name] : false;
	}
}
