<?php

/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/11/18
 * Time: 11:32 AM.
 */

namespace App\Http\Controllers;

use App\Http\Models\User;
use App\Http\Models\Role;
use App\Http\Requests\User\RequestAdd;
use App\MyCore\Routing\MyController;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserEditRequest;
use Hash;
use Auth;

class UserController extends MyController
{
    public $data = array();
    public $_model;
    public $_inputs = array();

    public function __construct()
    {
        parent::__construct();
        $this->_model = new User();
        $this->_inputs = \Request::all();
        $this->data['params'] = $this->_inputs;

        $this->data['controllerName'] = 'user';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowAll()
    {
        return view("{$this->data['controllerName']}.show-all");
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
            'sort' => $request->input('sort', 'user_id'),
            'order' => $request->input('order', 'asc'),
            'search' => $request->input('search', ''),
            'is_deleted' => $request->input('is_deleted', 0),
        );

        $data = $this->_model->getShowAll($filters);

        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $this->data['id'] = $id;
        $this->data['model'] = $this->_model->getUser($id);
        if ($this->data['model'] == null) {
            return redirect()->back()->with('msg-error', 'Không tìm thấy thông tin thành viên này.');
        }

        return view("{$this->data['controllerName']}.edit", $this->data);
    }

    public function getEdit2($id)
    {
        $this->data['id'] = $id;
        $this->data['model'] = $this->_model->getUser($id);
        if ($this->data['model'] == null) {
            return redirect()->back()->with('msg-error', 'Không tìm thấy thông tin thành viên này.');
        }

        return view("{$this->data['controllerName']}.edit", $this->data);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(UserEditRequest $request, $id)
    {
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }
        $this->data['id'] = $id;
        if (!$this->_model->edit($id, $this->_inputs)) {
            return redirect()->back()->with('msg-error', 'Cập nhật thành viên không thành công.');
        }
		return redirect()->route('user.get-show-all')->with('msg-success', 'Cập nhật thành viên thành công.');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAdd()
    {
        $roles = Role::all();

        return view("{$this->data['controllerName']}.add", compact('roles'));
    }

    /**
     * @param RequestAdd $requestAdd
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postAdd(RequestAdd $requestAdd)
    {

        $errors = $requestAdd->validate();

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

//        if (!$this->_model->add($this->_inputs)) {
//            return redirect()->back()->with('msg-success', 'Thêm thành viên không thành công.');
//        }
//
//        return redirect()->route('user.get-show-all')->with('msg-success', 'Thêm thành viên thành công.');

         $input = $requestAdd->all();

         $user = User::create($input);
         $user->attachRole($requestAdd->role_id);

		activity('Thành viên')
			->causedBy(Auth::user()->user_id)
			->performedOn($user)
			->withProperties([
				'username' => $user->username,
				'email'    => $user->email,
				'first_name' => $user->firstname,
				'last_name'  => $user->lastname,
				'status'	=> $user->status
			])
			->log('Thêm thành viên');

         return redirect()->route('user.get-show-all')->with('msg-success', 'Thêm thành viên thành công.');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMoveTrash()
    {
        if (!$this->_model->moveTrash($this->_inputs['id'])) {
            return response()->json(['code' => 1, 'msg' => 'Thành viên này không tồn tại.']);
        }

        return response()->json(['code' => 0, 'msg' => 'Xóa thành viên thành công.']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getShowTrash()
    {
        return view("{$this->data['controllerName']}.show-trash");
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAjaxDataTrash(Request $request)
    {
        $filters = array(
            'offset' => (int) $request->input('offset', 0),
            'limit' => (int) $request->input('limit', PAGE_LIST_COUNT),

            'sort' => $request->input('sort', 'user_id'),
            'order' => $request->input('order', 'asc'),
            'search' => $request->input('search', ''),
            'is_deleted' => $request->input('is_deleted', 1),
        );

        $data = $this->_model->getShowAll($filters);

        return response()->json([
            'total' => $data['total'],
            'rows' => $data['data'],
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function postPutBack()
    {
        if (!$this->_model->putBack($this->_inputs['id'])) {
            return response()->json(['code' => 1, 'msg' => 'Thành viên này không tồn tại.']);
        }

        return response()->json(['code' => 0, 'msg' => 'Khôi phục thành viên thành công.']);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRemoveTrash()
    {
        if (!$this->_model->removeTrash($this->_inputs['id'])) {
            return response()->json(['code' => 1, 'msg' => 'Thành viên này không tồn tại.']);
        }

        return response()->json(['code' => 0, 'msg' => 'Xóa vĩnh viễn thành viên thành công.']);
    }
}
