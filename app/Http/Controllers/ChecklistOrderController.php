<?php

namespace App\Http\Controllers;

use App\Checklist;
use Illuminate\Http\Request;

class ChecklistOrderController extends Controller
{
    /**
     * Update the sort order of the checklist items in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $count = 1;
        $checklist = Checklist::findOrFail($id);
        $items = $checklist->items;
        foreach ($request->items as $item) {
            $item = $items->where('id', str_replace('item_','',$item))->first();
            $item->sortKey = $count;
            $item->save();
            $count++;
        }
        return json_encode(['message' => 'Order Updated.']);
    }
}
