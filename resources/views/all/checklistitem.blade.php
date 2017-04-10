<li id='item_{{$item->id}}' class="list-group-item checklistitem">


    <span class="checklistItemOptions pull-right">

        <button type="button" class="btn btn-danger deleteItemButton" aria-label="Delete Item"
                data-itemid="{{$item->id}}">
            <span class="glyphicon glyphicon-trash" aria-label="Delete Item"></span>
        </button>


    </span>

    <h4>{{$item->name}}</h4>
    <span class="smalltext">
        {{$item->instructions}}
    </span>


</li>