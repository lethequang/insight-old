<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/24/18
 * Time: 9:48 AM.
 */
namespace App\Http\Models;
use Illuminate\Support\Facades\Config;
use Spatie\Activitylog\Traits\CausesActivity;
use Zizaco\Entrust\EntrustRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EntrustRole
{
    use SoftDeletes;
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    /**
     * @param array $filters
     *
     * @return array
     */
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

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
    public function users()
    {
        return $this->belongsToMany(Config('auth.providers.users.model'), Config('entrust.role_user_table'), Config('entrust.role_foreign_key'), Config('entrust.user_foreign_key'));
    }
}