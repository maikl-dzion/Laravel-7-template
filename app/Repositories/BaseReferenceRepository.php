<?php

namespace App\Repositories;

use App\Models\BaseReference;

class BaseReferenceRepository implements BaseReferenceRepositoryInterface
{
    protected $model;
    protected $primaryKey;

    public function __construct() {
        $this->model = new BaseReference;
        $this->primaryKey = $this->model->getPrimaryKey();
    }

    public function all()
    {
        return BaseReference::all()->toArray();
    }

    public function getByItemId($itemId)
    {
        // $item = BaseReference::where('id', $itemId)->first()->toArray();
        $item = BaseReference::find($itemId);
        return $item;
    }

    public function getListByRecourceType($resourceType, $active = 0) {

        if($active)
            $items = BaseReference::where('resourcetype', $resourceType)->where('active', $active)->get()->toArray();
        else
            $items = BaseReference::where('resourcetype', $resourceType)->get()->toArray();

        return $items;
    }

    public function addItem($data)
    {
        $model = new BaseReference();
        foreach ($data as $key => $value)
            $model->$key = $value;

        return $model->save();
    }

    public function updateItem($data)
    {
        $itemId = $this->getItemValue($data, $this->primaryKey, 0);
        $model  = BaseReference::find($itemId);
        foreach ($data as $key => $value)
            $model->$key = $value;
        return $model->save();
    }

    private function getItemValue($data, $fname, $defValue = '') {
        $value = $defValue;
        if(isset($data[$fname]))
            $value = $data[$fname];
        return $value;
    }

}
