<?php

/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/24/18
 * Time: 9:50 AM.
 */

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Hash;
//use Spatie\Activitylog\Traits\LogsActivity;
use Auth;


class User extends Authenticatable
{
	//use LogsActivity;
    use Notifiable;
    use EntrustUserTrait;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';



    /**
     * @return array
     */
    protected $fillable = [
        'user_id', 'username', 'email', 'password', 'firstname', 'lastname', 'status',
    ];

	//protected static $logAttributes = ['email', 'firstname'];


	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    protected static function boot()
    {
		parent::boot();

		static::updating(function ($user) {
			activity('Thành viên')
				->performedOn($user)
				->causedBy(Auth::user()->user_id)
				->withProperties([
					'username' => $user->username,
					'email'    => $user->email,
					'first_name' => $user->firstname,
					'last_name'  => $user->lastname,
					'status'	=> $user->status
				])
				->log('Cập nhật thành viên');
		});

		static::deleting(function ($user) {
			activity('Thành viên')
				->performedOn($user)
				->causedBy(Auth::user()->user_id)
				->withProperties([
					'username' => $user->username,
					'email'    => $user->email,
					'first_name' => $user->firstname,
					'last_name'  => $user->lastname,
					'status'	=> $user->status
				])
				->log('Xóa thành viên');
		});
    }

    public function getColumnsInTable()
    {
        $columns = array();
        $columnObjects = \DB::select("DESCRIBE {$this->table}");
        foreach ($columnObjects as $columnObject) {
            $columns[] = $columnObject->Field;
        }

        return $columns;
    }

    /**
     * @param $data
     * @param $object
     *
     * @return array
     */
    public function filterColumns($data, &$object)
    {
        $dataFormat = array();

        $columns = $this->getColumnsInTable();

        foreach ($data as $column => $value) {
            if (in_array($column, $columns)) {
                $object->$column = $value;
                $dataFormat[$column] = $value;
            }
        }

        return $dataFormat;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function add($data)
    {
        $object = new User();
        $data = $this->formatData($data);

        $this->filterColumns($data, $object);
        if ($object->save()) {
            $id = $object->{$this->primaryKey};
            $model = new RoleUser();
            $object = $model->add($data, $id);

            return $id;
        }
    }

    /**
     * @param $filters
     *
     * @return array
     */
    public function getShowAll($filters = array())
    {
        $sql = self::select();

        if (!empty($keyword = $filters['search'])) {
            $sql->where(function ($query) use ($keyword) {
                $query->where('username', 'LIKE', '%'.$keyword.'%');
            });
        }

        if (isset($filters['is_deleted'])) {
            $deleted = $filters['is_deleted'];
            $sql->where(function ($query) use ($deleted) {
                $query->where('is_deleted', $deleted);
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

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getUser($id)
    {
        $sql = self::leftJoin('user_profile', "{$this->table}.{$this->primaryKey}", '=', 'user_profile.user_id')
            ->where("{$this->table}.{$this->primaryKey}", $id);

        return $sql->first();
    }

    /**
     * @param $id
     * @param $data
     */
    public function edit($id, $data)
    {
        $object = $this->find($id);

        if ($object == null) {
            return null;
        }

//        $data = $this->formatData($data);
//        $this->filterColumns($data, $object);
//        $object->save();
        $object->update($data);
        return $id;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function formatData($data)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        }

        if (isset($data['password'])) {
            $data['password'] =  Hash::make($data['password']);
        }

        return $data;
    }

    /**
     * @param $id
     */
    public function moveTrash($id)
    {
        $object = $this->find($id);

        if ($object == null) {
            return null;
        }

        $object->is_deleted = 1;
       // $object->status = 0;

        $object->save();

        return $id;
    }

    /**
     * @param $id
     */
    public function putBack($id)
    {
        $object = $this->find($id);

        if ($object == null) {
            return null;
        }

        $object->is_deleted = 0;
       // $object->status = 1;

        $object->save();

        return $id;
    }

    /**
     * @param $id
     */
    public function removeTrash($id)
    {
        $object = $this->find($id);

        if ($object == null) {
            return null;
        }

        return $object->delete();
    }
}
