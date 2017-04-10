@extends('layouts.app')

@section('head')

    <style>
        .checklistitem .checklistItemOptions {
            display: none;
        }

        .checklistitem:hover .checklistItemOptions {
            display: inline-block;
        }

        .placeholder {
            height: 50px;
            background-color: #23527c;
        }


    </style>
@endsection

@section('content')
    <meta name="checklist_id" content="{{$checklist->id}}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 id="checklistName">{{$checklist->name}}</h1>
                <ul id='checklist' class="list-group">

                    @foreach($checklist->items as $item)
                        @include('all.checklistitem')
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4">
                <h3>Checklist Options</h3>
                <div class="panel">
                    <div class="panel-body">
                        <button id='addItemButton' class="btn btn-info btn-lg">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Item
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        //enable the add item button
        $('#addItemButton').on('click', function () {
            bootbox.dialog({
                message: "Item Text: <input type='text' class='form-control' id='name'><br>Instructions: <textarea class='form-control' id='instructions' rows='5'></textarea>",
                buttons: {
                    "Add Item": function (result) {
                        console.dir(result);
                        $.post('/checklistitem',
                            {
                                name: $(this).find('#name').val(),
                                instructions: $(this).find('#instructions').val(),
                                checklist_id: $('meta[name="checklist_id"]').attr('content')
                            },
                            function (data) {
                                $('#checklist').append(data);
                            });
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-warning btn-sm'
                    }
                },

            });
        });

        //handle the delete item button
        $('#checklist').on('click', '.deleteItemButton', function () {
            var itemid = $(this).data('itemid');
            var clickedButton = $(this);

            bootbox.confirm('Really delete this item?', function (result) {
                if (result) {
                    $.ajax({
                        url: '/checklistitem/' + itemid,
                        type: 'DELETE',
                        success: function (result) {
                            clickedButton.closest('.list-group-item').remove();
                        }
                    });
                }
            });


        });

        //handle the checklist renaming
        $('body').on('click', '#checklistName', function () {
            var checklistName = $(this).text();
            bootbox.prompt(
                {
                    title: 'Enter Name of Checklist',
                    value: checklistName,
                    callback: function (result) {
                        if (result) {
                            $("#checklistName").text(result);
                        }
                    }
                }
            )
        });

        //enable list item reordering
        $(function () {
            $("#checklist").sortable({
                placeholder: "list-group-item placeholder",
                opacity: 0.9,
                axis: 'y',

                start: function (event, ui) {
                    ui.placeholder.height(ui.item.height());
                },
                update: function (event, ui) {
                    var checklist_id = $('meta[name="checklist_id"]').attr('content');
                    var items = $('#checklist').sortable('toArray');


                    $.ajax({
                        type: 'POST',
                        url: '/checklistitemorder/' + checklist_id,
                        data: {items: items},
                        success: function (data) {
                            console.dir(data);
                        },
                        error: function (xhr, status, errorThrown) {
                            console.log(xhr); //could be alert if you don't use the dev tools
                        },
                        dataType: "json"
                    });


                }
            });
            $("#checklist").disableSelection();
        });
    </script>


@endsection