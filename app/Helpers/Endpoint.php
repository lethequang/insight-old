<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/13/18
 * Time: 10:54 AM
 */

namespace App\Helpers;

class Endpoint
{

    public static $login =                 API_BASE_INSIDE . 'insight/login';


    public static $getShowRoleStaff =      API_BASE_INSIDE . 'insight/authorized/show-role-staff';
    public static $getAjaxRoleStaff =      API_BASE_INSIDE . 'insight/staffs/ajax-data';

    public static $getShowRole =           API_BASE_INSIDE . 'insight/authorized/show-role';
    public static $getAjaxRole =           API_BASE_INSIDE . 'insight/authorized/ajax-role';

    public static $getEditRoleStaff =      API_BASE_INSIDE . 'insight/authorized/edit-role-staff/';
    public static $postEditRoleStaff =     API_BASE_INSIDE . 'insight/authorized/edit-role-staff/';

    public static $getEditPermission =     API_BASE_INSIDE . 'insight/authorized/edit-permission/';
    public static $postEditPermission =    API_BASE_INSIDE . 'insight/authorized/edit-permission/';



    public static $getShowAllStaffs =      API_BASE_INSIDE. 'insight/staffs/show-all';
    public static $ajaxStaff =             API_BASE_INSIDE. 'insight/staffs/ajax-data';
    public static $getEditStaff =          API_BASE_INSIDE. 'insight/staffs/edit/';
    public static $postEditStaff =         API_BASE_INSIDE. 'insight/staffs/edit/';
    public static $getAddStaff =           API_BASE_INSIDE. 'insight/staffs/add';
    public static $postAddStaff =          API_BASE_INSIDE. 'insight/staffs/add';
    public static $postRemove =            API_BASE_INSIDE. 'insight/staffs/remove';
    public static $postTrash =             API_BASE_INSIDE. 'insight/staffs/trash';
    public static $getShowTrash =          API_BASE_INSIDE. 'insight/staffs/show-trash';
    public static $ajaxTrash =             API_BASE_INSIDE. 'insight/staffs/ajax-trash';
    public static $postRestore =           API_BASE_INSIDE. 'insight/staffs/restore';


    public static $getAddServer =          API_BASE_INSIDE. 'insight/fdrive/server/add';
    public static $postAddServer =         API_BASE_INSIDE. 'insight/fdrive/server/add';

    public static $searchServerFdrive =         API_FDRIVE . 'server/search/';
    public static $detailServerFdrive =         API_FDRIVE . 'server/detail/';
    public static $actionServerFdrive =         API_FDRIVE . 'server/action/';

    public static $searchCustomerFdrive =         API_FDRIVE . 'users/search/';
    public static $detailCustomer =         API_FDRIVE . 'customer/detail/';
}
