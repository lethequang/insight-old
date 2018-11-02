<?php

namespace App\Http\Controllers;

use App\LogActivity;
use App\MyCore\Routing\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Compound;
use App\Http\Models\LogModel;

class LogController extends MyController
{


	public $data = array();
	public $_model;
	public $_inputs = array();

	public function __construct()
	{
		parent::__construct();
		$this->_model = new LogModel();
		$this->_inputs = \Request::all();
		$this->data['params'] = $this->_inputs;

		$this->data['controllerName'] = 'log';
	}




	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getShowAll()
	{
		$this->data['filters'] = [
			'from' => '',
			'to' => ''
		];
		return view("{$this->data['controllerName']}.show-all",$this->buildDataView($this->data));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getAjaxData(Request $request)
	{
		$filters = array(
			'offset' => (int) $request->input('offset', 0),
			'limit' => (int) $request->input('limit', PAGE_LIST_COUNT),
			'sort' => $request->input('sort', 'id'),
			'order' => $request->input('order', 'asc'),
			'search' => $request->input('search', ''),
			'from' => $request->input('from', ''),
			'to' => $request->input('to', '')
		);

		$data = $this->_model->getShowAll($filters);

		return response()->json([
			'total' => $data['total'],
			'rows' => $data['data'],
		]);
	}
}
