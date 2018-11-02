<?php

/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/12/18
 * Time: 9:03 AM.
 */

namespace App\Http\Controllers;

use App\Http\Models\PermissionRole;
use App\Http\Models\Permission;
use App\Http\Models\Role;
use App\Http\Models\RoleUser;
use App\Http\Models\User;
use App\Http\Requests\Role_User\RequestUpdate;
use App\Http\Requests\RoleRequest;
use App\MyCore\Routing\MyController;
use Illuminate\Http\Request;
use Auth;


class AuthorizedController extends MyController
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
    public function getShowRoleUser()
    {
        return view("{$this->data['controllerName']}.show-role-user");
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAjaxDataRoleUser(Request $request)
    {
        $filters = array(
            'offset' => (int)$request->input('offset', 0),
            'limit' => (int)$request->input('limit', PAGE_LIST_COUNT),
            'sort' => $request->input('sort', 'user_id'),
            'order' => $request->input('order', 'asc'),
            'search' => $request->input('search', ''),
            'is_deleted' => $request->input('is_deleted', 0),
        );
        $model = new RoleUser();
        $data = $model->getShowAll($filters);

        return response()->json([
            'rows' => $data['data'],
            'total' => $data['total'],
        ]);
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

        return view('authorized.add', $this->data);
        // return view("{$this->data['controllerName']}.add");
    }

    public function postAdd(RoleRequest $request)
    {
        $role = Role::create($request->all());
        //attach the selected permissions
        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }
        session()->flash('msg-success', 'Thêm nhóm thành công.');

        return redirect()->route('authorized.get-show-role');
    }

    public function getAddPermission()
    {
        return view("{$this->data['controllerName']}.addPermission");
    }

    public function postAddPermission(Request $request)
    {
        $role = Permission::create($request->all());
        //attach the selected permissions
        session()->flash('msg-success', 'Thêm quyền thành công.');

        return redirect()->route('authorized.get-show-role');
    }

    /**
     * @param RequestAdd $requestAdd
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditRoleUser($id)
    {
        $this->data['id'] = $id;
        $users = User::find($id);
        $model = new RoleUser();
        $this->data['model'] = $model->getRoleId($id);
        $userRoles = $users->roles->pluck('id')->toArray();
        $roles = Role::all();

        return view("{$this->data['controllerName']}.edit-role-user", $this->data, compact('roles', 'users', 'userRoles'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditRoleUser(RequestUpdate $request, $id)
    {
        $model = new RoleUser();

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

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
    public function getShowRole()
    {
        return view("{$this->data['controllerName']}.show-role", $this->data);
    }

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
    public function getEditPermission($id)
    {

        $this->data['id'] = $id;
        $model = new PermissionRole();
        $role = Role::find($id);
        $this->data['permission_id'] = $model->getPermissions($id);
        $this->data['permission_authorized'] = Permission::where('description', '=', 4)->get();
        $this->data['permission_customer'] = Permission::where('description', '=', 3)->get();
        $this->data['permission_user'] = Permission::where('description', '=', 1)->get();
        $this->data['permission_service'] = Permission::where('description', '=', 2)->get();
        if (!isset($role)) {
            abort(404, 'Unauthorized action.');
        }

        return view("{$this->data['controllerName']}.edit-permission", $this->data, compact('role'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditPermission(Request $request, $id)
    {
        $model = new PermissionRole();
		$subject = Role::where('id', $id)->first();
		$sub_permission = PermissionRole::where('role_id', $id)->get();

//        $permissionRole = PermissionRole::where('role_id',$id)->get();
//
//        $data = $request->all();
//        dd($data);
//        $permissionRole->update($data);

//        if (!empty($errors)) {
//            return redirect()->back()->withErrors($errors);
//        }
        if (empty($this->_inputs['permission_id'])) {
            $permissionRole = PermissionRole::where('role_id', $id)->first();
            if (!isset($permissionRole)) {
                return redirect()->back()->with('msg-success', ' Cập nhật phân quyền thành công . ');
            }
            $permissionRole->delete();
            return redirect()->back()->with('msg-success', ' Cập nhật phân quyền thành công . ');
        }

        if (!$model->edit($id, $this->_inputs['permission_id'])) {
            session()->flash('msg-error', ' Cập nhật phân quyền không thành công . ');

            return redirect()->back();
        }

		$dataFormat = array();

		foreach ($sub_permission as $item) {
			$object = $item['permission_id'];
			$dataFormat[] = $object ;
		}

		//dd($dataFormat);
		activity('Cấp độ truy cập')
			->causedBy(Auth::user()->user_id)
			->performedOn($subject)
			->withProperties([
				'role_id'  => $subject->id,
				'permission_id' => $dataFormat
			])
			->log('Cập nhật phân quyền');

        return redirect()->back()->with('msg-success', ' Cập nhật phân quyền thành công . ');
    }

    public function postMoveTrash(Request $request)
    {
        $result = Role::find($request->id)->delete();
        if (!$result) {
            return response()->json(['code' => 1, 'msg' => ' Nhóm này không tồn tại . ']);
        }

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

        return view("{$this->data['controllerName']}.show-trash", compact('role'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function postPutBack($id)
    {
        $role = Role::withTrashed()->find($id)->restore();

        return response()->json(['code' => 0, 'msg' => 'Khôi phục thành viên thành công.']);
    }

    public function postRemoveTrash($id)
    {
        $role = Role::withTrashed()->find($id)->forceDelete();

        return response()->json(['code' => 0, 'msg' => 'Nhóm đã được xóa vĩnh viễn']);
        //  return redirect()->route('authorized.get-show-trash-role')->with('msg-success', 'Nhóm đã được xóa vĩnh viễn');
    }
}
