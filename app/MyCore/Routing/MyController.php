<?php

/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/20/18
 * Time: 2:59 PM.
 */

namespace App\MyCore\Routing;

use App\Helpers\MyCurl;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Route;
use App\Http\Models\LogModel;

class MyController extends BaseController
{
    public $user = null;
    protected $_inputs = array();
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();
            $causer = Auth::user()->user_id;
			$route = Route::getCurrentRoute()->getActionName();
			$action = Route::getCurrentRoute()->getActionMethod();

			$this->_inputs = \Request::all();
			$this->_inputs['subject_id'] = $request->route('id');

			$this->data['params'] = $this->_inputs;
			$dataFormat = json_encode($this->_formatData($this->data['params']));

			if (\Request::isMethod('post'))
			{
				LogModel::create(
					[
						'url' => \Request::fullUrl(),
						'route' => $route,
						'action' => $action,
						'causer' => $causer,
						'ip' => \Request::ip(),
						'user_agent' => \Request::header('user-agent'),
						'properties' => $dataFormat
					]
				);
			}
            return $next($request);
        });
    }

    /**
     * @param string $method
     * @param $url
     * @param array $var
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callApi($method = 'GET', $url, $var = array())
    {
        $headers = array(
            'Content-Type: application/json',
            'token: '.session('token'),
        );

        $curl = new MyCurl($headers);
        $response = array();
        switch ($method) {
            case 'GET':
                $response = $curl->get($url, $var);
                break;
            case 'POST':
                $response = $curl->post($url, $var);
                break;
        }

        if ($response === null) {
            session()->flash('msg-error', 'Hệ thống đã xảy ra lỗi, vui lòng thử lại sau.');

            return redirect()->back();
        }

        if (isset($response['code'])) {
            if ($response['code'] == -1) {
                dd($response);
            }
        }

        return $response;
    }
	/**
	 * push data xuống view
	 *
	 * @return mixed
	 * @author
	 */
	public function buildDataView($data = array()) {
		extract($data);
		return compact(array_keys($data));
	}

	private function _formatData($data) {
		if (isset($data['password'])) {
			//$data['password'] = \Hash::make($data['password']);
			unset($data['password']);
		}
		if (isset($data['password_confirmation'])) {
			unset($data['password_confirmation']);
		}
		if (isset($data['_token'])) {
			unset($data['_token']);
		}
		if (isset($data['subject_id']) == NULL) {
			unset($data['subject_id']);
		}
		return $data;
	}
}
