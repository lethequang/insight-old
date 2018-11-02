<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/12/18
 * Time: 9:03 AM.
 */

namespace App\Http\Controllers;

use App\Http\Models\Permission;
use App\Http\Models\Role;
use App\Http\Models\RoleUser;
use App\Http\Requests\RoleRequest;
use App\MyCore\Routing\MyController;
use Illuminate\Http\Request;
use Auth;

class RoleController extends MyController
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
    public function getShowRole()
    {
        return view("{$this->data['controllerName']}.role.show-role", $this->data);
    }


    public function getAdd()
    {
//        $permission_service = Permission::where('description', '=', 2)->get();
//        $permission_user = Permission::where('description', '=', 1)->get();
//        $permission_customer = Permission::where('description', '=', 3)->get();
//        $permission_authorized = Permission::where('description', '=', 4)->get();
        $this->data['permission_authorized'] = Permission::where('description', '=', 4)->get();
        $this->data['permission_customer'] = Permission::where('description', '=', 3)->get();
        $this->data['permission_user'] = Permission::where('description', '=', 1)->get();
        $this->data['permission_service'] = Permission::where('description', '=', 2)->get();
        return view('authorized.role.add', $this->data);
        // return view("{$this->data['controllerName']}.add");
    }

    public function postAdd(RoleRequest $request)
    {
        $role = Role::create($request->all());
        //attach the selected permissions
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
		activity('Nhóm thành viên')
				->causedBy(Auth::user()->user_id)
				->performedOn($role)
				->withProperties([
					'name' => $role->name,
					'display_name'    => $role->display_name,
					'description' => $role->description
				])
				->log('Thêm nhóm thành viên');
        session()->flash('msg-success', 'Thêm nhóm thành công.');
        return redirect()->route('authorized.get-show-role');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditRoleUser($id)
    {
        $model = new RoleUser();
        if (!$model->edit($id, $this->_inputs)) {
            session()->flash('msg-error', 'Cập nhật nhóm thành viên không thành công.');
            return redirect()->back();
        }
        session()->flash('msg-success', 'Cập nhật nhóm thành viên thành công.');
        return redirect()->back()->with('msg-success', 'Cập nhật nhóm thành viên thành công.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAjaxDataRole(Request $request)
    {
        $filters = [
            'offset' => (int)$request->input('offset', 0),
            'limit' => (int)$request->input('limit', PAGE_LIST_COUNT),
            'sort' => $request->input('sort', 'id'),
            'order' => $request->input('order', 'asc'),
            'search' => $request->input('search', ''),
            'is_deleted' => $request->input('is_deleted', 0),
        ];
        $model = new Role();
        $data = $model->getShowAll($filters);
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postMoveTrash(Request $request)
    {
        $result = Role::find($request->id);
		Role::find($request->id)->delete();
        if (!$result) {
            return response()->json(['code' => 1, 'msg' => ' Nhóm này không tồn tại . ']);
        }
		activity('Nhóm thành viên')
			->causedBy(Auth::user()->user_id)
			->performedOn($result)
			->withProperties([
				'name' => $result->name,
				'display_name'    => $result->display_name,
				'description' => $result->description
			])
			->log('Xóa nhóm thành viên');
        return response()->json(['code' => 0, 'msg' => ' Xóa nhóm thành công .']);
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
        $model = new Role();
        $data = $model->getShowAll($filters);
        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    public function getShowTrashRole(Request $request)
    {
        $role = Role::onlyTrashed()->get();
        return view("{$this->data['controllerName']}.role.show-trash", compact('role'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function postPutBack($id)
    {
    	$result = Role::withTrashed()->find($id);
        Role::withTrashed()->find($id)->restore();
		activity('Nhóm thành viên')
			->causedBy(Auth::user()->user_id)
			->performedOn($result)
			->withProperties([
				'name' => $result->name,
				'display_name'    => $result->display_name,
				'description' => $result->description
			])
			->log('Khôi phục nhóm thành viên');
        return response()->json(['code' => 0, 'msg' => 'Khôi phục thành viên thành công.']);
    }

    public function postRemoveTrash($id)
    {
        $result = Role::withTrashed()->find($id);
		Role::withTrashed()->find($id)->forceDelete();

		activity('Nhóm thành viên')
			->causedBy(Auth::user()->user_id)
			->performedOn($result)
			->withProperties([
				'name' => $result->name,
				'display_name'    => $result->display_name,
				'description' => $result->description
			])
			->log('Xóa nhóm thành viên vĩnh viễn');
        return response()->json(['code' => 0, 'msg' => 'Nhóm đã được xóa vĩnh viễn']);
        //  return redirect()->route('authorized.get-show-trash-role')->with('msg-success', 'Nhóm đã được xóa vĩnh viễn');
    }
}