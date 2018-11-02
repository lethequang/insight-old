<?php

/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/11/18
 * Time: 11:32 AM.
 */

namespace App\Http\Controllers;

use App\Helpers\MyCurl;
use App\Http\Models\User;
use App\MyCore\Routing\MyController;
use Illuminate\Http\Request;
use App\Helpers\Endpoint;

class CustomerController extends MyController
{
    public $data = array();
    public $_model;
    public $_inputs = array();

    public function __construct()
    {
        parent::__construct();
//        $this->_model = new User();
//        $this->_inputs = \Request::all();
        $this->data['params'] = $this->_inputs;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowAll()
    {
        return view('customer.show-all');
    }

    public function getAjaxData(Request $request)
    {
        $filters = array(
            'offset' => (int) $request->input('offset', 0),
            'limit' => (int) $request->input('limit', PAGE_LIST_COUNT),
            'sort' => $request->input('sort', 'user_id'),
            'order' => $request->input('order', 'asc'),
        );

        if (!empty($request['email'])) {
            $filters['email'] = $request['email'];
            $filters['offset'] = 0;
        }
        if (!empty($request['phone'])) {
            $filters['phone'] = $request['phone'];
            $filters['offset'] = 0;
        }
        if (!empty($request['name'])) {
            $filters['name'] = $request['name'];
            $filters['offset'] = 0;
        }
        if (!empty($request['address'])) {
            $filters['address'] = $request['address'];
            $filters['offset'] = 0;
        }
        if (!empty($request['created_time_from'])) {
            $filters['created_time_from'] = $request['created_time_from'];
            $filters['offset'] = 0;
        }
        if (!empty($request['created_time_to'])) {
            $filters['created_time_to'] = $request['created_time_to'];
            $filters['offset'] = 0;
        }

        $response = $this->callApi('GET', Endpoint::$searchCustomerFdrive, $filters);

        $data = $response['data'];

        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    public function getDetailCustomer($id) {
        $result = $this->callApi('GET',Endpoint::$detailCustomer . $id);
      //  dd($result);
        return view("customer.detail")->with('data',$result['data']);
     // return $result;
    }
}
