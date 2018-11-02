<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/25/18
 * Time: 10:16 AM
 */

namespace App\Http\Models;


use App\MyCore\Models\DBTable;

class PermissionRole extends DBTable
{
    protected $table = 'permission_role';
    public $timestamps = false;
    protected $primaryKey = 'role_id';


    /**
     * @param $id
     * @return mixed
     */
    protected $fillable = [
        'permission_id', 'role_id',
    ];

    public function getPermissions($id)
    {
        $select = $this->select();

        $data = $select->where('role_id', $id)
            ->orderBy('permission_id', 'asc')
            ->pluck('permission_id')
            ->toArray();

        return $data;
    }

    public function edit($id, $permission_id)
    {

        $this->where('role_id', $id)->delete();
        if($permission_id == null){
            return null;
        }

        foreach ($permission_id as $permissionId) {
            $object = new PermissionRole();
            $object->permission_id = $permissionId;
            $object->role_id = $id;
            $object->save();
        }
        return $id;
    }
}