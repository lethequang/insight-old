<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/24/18
 * Time: 9:48 AM
 */

namespace App\Http\Models;


use Zizaco\Entrust\EntrustPermission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Permission extends EntrustPermission
{
    use SoftDeletes;
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * @param array $filters
     *
     * @return array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

//    public function getShowAll($filters = array())
//    {
//        $sql = self::select();
//        if (!empty($keyword = $filters['search'])) {
//            $sql->where(function ($query) use ($keyword) {
//                $query->where('name', 'LIKE', '%'.$keyword.'%');
//            });
//        }
//        $total = $sql->count();
//        $data = $sql->skip($filters['offset'])
//            ->take($filters['limit'])
//            ->orderBy($filters['sort'], $filters['order'])
//            ->get()
//            ->toArray();
//
//        return ['total' => $total, 'data' => $data];
//    }

    public function getShowAll($filters = array())
    {
        $sql = self::select();
        if (isset($filters['is_deleted'])) {
            if($filters['is_deleted'] == 1) {
                $sql->onlyTrashed();
            }
        }
        if (!empty($keyword = $filters['search'])) {
            $sql->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            });
        }
        $total = $sql->count();
        $data = $sql->skip($filters['offset'])
            ->take($filters['limit'])
            ->orderBy($filters['sort'], $filters['order'])
            ->get()
            ->toArray();
        return ['total' => $total, 'data' => $data];
    }
}