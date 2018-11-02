<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/19/18
 * Time: 2:01 PM
 */

namespace App\Http\Controllers\Fdrive;
use Illuminate\Http\Request;

use App\Helpers\Endpoint;
use App\MyCore\Routing\MyController;
use Illuminate\Validation\Rule;
use Validator;

class ServerController extends MyController
{
    public $data = array();
    public $inputs = array();

    public function __construct()
    {
        parent::__construct();
        $this->inputs = \Request::all();
        $this->data['params'] = $this->inputs;
        $this->data['controllerName'] = 'server';
        $this->data['pageTitle'] = 'Thêm mới server';
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd() {
        $this->callApi('GET', Endpoint::$getAddServer);
        return view("fdrive.{$this->data['controllerName']}.add", $this->data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAdd() {
        $result = $this->callApi('POST', Endpoint::$postAddServer, $this->inputs);

        if ($result->code != 0) {
            return redirect()->back()->with('msg-error', $result->message);
        }
        return redirect()->back()->with('msg-success', $result->message);
    }

    public function getShowAll() {
        return view("fdrive.server.show-all");
    }

    public function getShowDetail($id) {
        $result= $this->callApi('GET',Endpoint::$detailServerFdrive.$id);
//        if($result['code']<>'200'){
//            abort(403, 'Error.');
//        }
        return view("fdrive.server.detail")->with('data',$result['data']);
    }

    public function getDetailServer($id) {
        $result= $this->callApi('GET',Endpoint::$detailServerFdrive.$id);
        return $result;
    }

    public function getAjaxData(Request $request) {
        $filters = array(
            'offset'    => (int) $request->input('offset', 0),
            'limit'     => (int) $request->input('limit', PAGE_LIST_COUNT),
            'sort'      => $request->input('sort', 'vm_code'),
            'order'     => $request->input('order', 'asc')
//            'vm_code'    => $request->input('vm_code', null),
//            'ip'    => $request->input('ip', null),
//            'created_time_from'    => $request->input('created_time_from', null),
//            'created_time_to'    => $request->input('created_time_to', null)
        );

        if (isset($request['vm_code'])) {
            $filters['vm_code']=$request['vm_code'];
            $filters['offset'] = 0;
        }
        if (isset($request['ip'])) {
            $filters['ip']=$request['ip'];
            $filters['offset'] = 0;
        }
        if (isset($request['vm_name_show'])) {
            $filters['vm_name_show']=$request['vm_name_show'];
            $filters['offset'] = 0;
        }
        if (isset($request['created_time_from'])) {
            $filters['created_time_from']=$request['created_time_from'];
            $filters['offset'] = 0;
        }
        if (isset($request['created_time_to'])) {
            $filters['created_time_to']=$request['created_time_to'];
            $filters['offset'] = 0;
        }

        $response = $this->callApi('GET',Endpoint::$searchServerFdrive,$filters);

        $data = $response['data'];
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data']
        ]);
    }

    public function ActionServer(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'action' => [
                    'string', 'max:40',
                    Rule::in(['boot', 'reset', 'shutdown'])],
                'vmId' => 'required|max:100',
                'userId' => 'required|max:100',
            ]

        );
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
        $url=Endpoint::$actionServerFdrive.$request->input('action').'/'. (string)$request->input('vmId').'/'.(string)$request->input('userId');
        $result = $this->callApi('GET', $url);
//        if ($result['state']==true){
//            return response()->json($result);
//        }
        return response()->json($result);
    }

}