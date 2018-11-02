<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/16/18
 * Time: 3:27 PM
 */

namespace App\Http\Controllers;


use App\MyCore\Routing\MyController;

class DashboardController extends MyController
{
    public $data = array();
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex() {
        $this->data['dashboard'] = $this->callApi('GET', 'http://api.openstack.fdrive.vn/api/v1/dashboard')['data'];
        return view("dashboard.index", $this->data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataBarChartServers() {

        $filter = array(
            'type' => '12_month_ago'
        );

        $dataChart = $this->callApi('GET', 'http://api.openstack.fdrive.vn/api/v1/dashboard/bar-chart-servers')['data'];

        $this->data['dataChart'] = $this->filterDataBarChart('server', $dataChart, $filter['type']);

        return response()->json($this->data['dataChart']);
    }

    /**
     *
     */
    public function getDataBarChartCustomers() {

        $filter = array(
            'type' => '12_month_ago'
        );

        $dataChart = $this->callApi('GET', 'http://api.openstack.fdrive.vn/api/v1/dashboard/bar-chart-customers')['data'];

        $this->data['dataChart'] = $this->filterDataBarChart('customer', $dataChart, $filter['type']);

        return response()->json($this->data['dataChart']);
    }

    /**
     * @param $chart
     * @param $dataCharts
     * @param string $type
     * @return array
     */
    protected function filterDataBarChart($chart = 'server', $dataCharts, $type = 'this_year') {
        $data = array();
        $field = 'user_created_time';
        if ($chart == 'server') {
            $field = 'vm_create_date';
        }

        switch ($type) {
            case 'this_year':
                for ($month = 1; $month <= 12; $month++) {
                    $monthName = date('M', mktime(0, 0, 0, $month, 1, 0));
                    $data[$month][$monthName] = 0;
                    foreach ($dataCharts as $item) {
                        $monthNumber = date('m', strtotime($item[$field]));
                        $monthName = date('M', strtotime($item[$field]));
                        if ($month == $monthNumber) {
                            $data[$month][$monthName] += 1;
                        }
                    }
                }
                break;
            case '12_month_ago':
                for ($i = 0; $i < 12; $i++) {
                    $monthYear = date('M Y', strtotime('-' . (12 - $i) . 'months'));
                    $data[$i][$monthYear] = 0;
                    foreach ($dataCharts as $item) {
                        $dateTime = date('M Y', strtotime($item[$field]));
                        if ($monthYear == $dateTime) {
                            $data[$i][$monthYear] += 1;
                        }
                    }
                }
                break;

        }

        return $data;
    }
}

