<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public function newQuery()
    {
        $query = parent::newQuery(); // TODO: Change the autogenerated stub
        $query->orderBy('sortKey','ASC');
        return $query;
    }

    public static function create($name, $instructions, $checklistid)
    {
        $item = new Item();
        $item->name = $name;
        $item->instructions = $instructions;
        $item->checklist_id = $checklistid;
        $item->save();
        return $item;


    }
}
