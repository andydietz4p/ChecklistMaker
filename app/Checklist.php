<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    //


    //relationships

    public function items(){
        return $this->hasMany('\App\Item');
    }


    public static function create($name, $items = [])
    {
        $checklist = new Checklist();
        $checklist->name = $name;
        $checklist->save();

        foreach($items as $key=>$item){
            Item::create($item['name'], $checklist->id);
        }


        return $checklist;


    }
}
