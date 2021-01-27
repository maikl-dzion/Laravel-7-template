<?php

namespace App\Repositories;

use App\Models\BaseReference;

class BaseReferenceRepository implements BaseReferenceRepositoryInterface
{

    public function all()
    {
        return BaseReference::all()->toArray();
    }

    public function getByItemId($itemId)
    {
        $item = BaseReference::where('id', $itemId)->first()->toArray();
        print_r($item);
        return $item;
    }

    public function getListByRecourceType($resourceType, $active = 0) {

        if($active)
            $items = BaseReference::where('resourcetype', $resourceType)->where('active', $active)->get()->toArray();
        else
            $items = BaseReference::where('resourcetype', $resourceType)->get()->toArray();

        print_r($items);

        return $items;
    }

    public function getModel()
    {

    }


}
