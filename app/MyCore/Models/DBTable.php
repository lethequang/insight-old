<?php
/**
 * Created by PhpStorm.
 * User: tuantruong
 * Date: 7/24/18
 * Time: 9:51 AM
 */

namespace App\MyCore\Models;


use Illuminate\Database\Eloquent\Model;

class DBTable extends Model
{
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';


    /**
     * @return array
     */
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

}