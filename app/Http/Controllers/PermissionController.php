<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/12/18
 * Time: 9:03 AM.
 */

namespace App\Http\Controllers;

use App\Http\Models\Permission;

use App\Http\Requests\Permission\RequestAdd;
use App\MyCore\Routing\MyController;
use Illuminate\Http\Request;
use Auth;

class PermissionController extends MyController
{
    public $data = array();
    public $_inputs = array();

    public function __construct()
    {
        parent::__construct();
        $this->_inputs = \Request::all();
        $this->data['controllerName'] = 'authorized';
        $this->data['params'] = $this->_inputs;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowPermission()
    {
        return view("{$this->data['controllerName']}.permission.show-permission", $this->data);
    }

    public function getAjaxDataPermission(Request $request)
    {
        $filters = [
            'offset' => (int)$request->input('offset', 0),
            'limit' => (int)$request->input('limit', PAGE_LIST_COUNT),
            'sort' => $request->input('sort', 'id'),
            'order' => $request->input('order', 'asc'),
            'search' => $request->input('search', ''),
        ];
        $model = new Permission();
        $data = $model->getShowAll($filters);
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAddPermission()
    {
        return view("{$this->data['controllerName']}.permission.addPermission");
    }

    public function postAddPermission(RequestAdd $request)
    {
        $permission = Permission::create($request->all());
        //attach the selected permissions

		activity('Quyền')
			->causedBy(Auth::user()->user_id)
			->performedOn($permission)
			->withProperties([
				'name' => $permission->name,
				'display_name'    => $permission->display_name,
				'description' => $permission->description
			])
			->log('Thêm quyền');
        session()->flash('msg-success', 'Thêm quyền thành công.');
        return redirect()->route('authorized.get-show-role');
    }


    public function postMoveTrash(Request $request)
    {
        $result = Permission::find($request->id);
		Permission::find($request->id)->delete();
        if (!$result) {
            return response()->json(['code' => 1, 'msg' => ' Quyền này không tồn tại . ']);
        }
		activity('Quyền')
			->causedBy(Auth::user()->user_id)
			->performedOn($result)
			->withProperties([
				'name' => $result->name,
				'display_name'    => $result->display_name,
				'description' => $result->description
			])
			->log('Xóa quyền');
        return response()->json(['code' => 0, 'msg' => ' Xóa quyền thành công .']);
    }

    public function getUpdatePermission($id)
    {
        $permission = Permission::find($id);
        return view("authorized.permission.update-permission", compact('permission'));
    }

    public function postUpdatePermission(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'unique:permissions,name'
            ],

            [
                'name.unique' => 'Tên đã tồn tại'
            ]

        );
        $permission = Permission::find($id);

        $data = $request->all();
        $permission->update($data);
        return redirect()->route('authorized.get-show-permission')->with('success', 'Quyền đã được cập nhập');
        //  return view("authorized.update-permission", compact('permission'));
    }

    public function getAjaxDataTrash(Request $request)
    {
        $filters = array(
            'offset' => (int)$request->input('offset', 0),
            'limit' => (int)$request->input('limit', PAGE_LIST_COUNT),
            'sort' => $request->input('sort', 'id'),
            'order' => $request->input('order', 'asc'),
            'search' => $request->input('search', ''),
            'is_deleted' => $request->input('is_deleted', 1),
        );
        $model = new Permission();
        $data = $model->getShowAll($filters);
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    public function getShowTrashRole(Request $request)
    {
        $role = Permission::onlyTrashed()->get();
        return view("{$this->data['controllerName']}.permission.show-trash-permission", compact('role'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function postPutBack($id)
    {
    	$result = Permission::withTrashed()->find($id);
    	Permission::withTrashed()->find($id)->restore();
		activity('Quyền')
			->causedBy(Auth::user()->user_id)
			->performedOn($result)
			->withProperties([
				'name' => $result->name,
				'display_name'    => $result->display_name,
				'description' => $result->description
			])
			->log('Khôi phục quyền');
        return response()->json(['code' => 0, 'msg' => 'Khôi phục quyền thành công.']);
    }

    public function postRemoveTrash($id)
    {
    	$result = Permission::withTrashed()->find($id);
    	Permission::withTrashed()->find($id)->forceDelete();
		activity('Quyền')
			->causedBy(Auth::user()->user_id)
			->performedOn($result)
			->withProperties([
				'name' => $result->name,
				'display_name'    => $result->display_name,
				'description' => $result->description
			])
			->log('Xóa quyền vĩnh viễn');
        return response()->json(['code' => 0, 'msg' => 'Quyền đã được xóa vĩnh viễn']);
        //  return redirect()->route('authorized.get-show-trash-role')->with('msg-success', 'Nhóm đã được xóa vĩnh viễn');
    }
}