<?php

namespace App\Http\Models;

use App\MyCore\Models\DBTable;
use Illuminate\Database\Eloquent\Model;

class LogModel extends DBTable
{
	protected $table = 'log_activity';
	protected $primaryKey = 'id';

	protected $fillable = [
		'url', 'route', 'action', 'causer', 'ip', 'user_agent','properties'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	public function getShowAll($filters = array())
	{
		$sql = self::select();

		if (!empty($filters['from'])) {
			$from = date('Y-m-d', strtotime($filters['from'])) . ' 00:00:00';
			$sql->whereDate('created_at', '>=', $from);
		}
		if (!empty($filters['to'])) {
			$to = date('Y-m-d', strtotime($filters['to'])) . ' 23:59:59';
			$sql->whereDate('created_at', '<=', $to);
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
