<style>
    .div-table {
        display: table;
        width: 460px;
        background-color: #eee;
        border: 1px solid #c8cbcf;
        border-spacing: 5px; /* cellspacing:poor IE support for  this */
    }

    .div-table-row {
        display: table-row;
        width: auto;
        clear: both;
    }

    .div-table-col {
        float: left; /* fix for  buggy browsers */
        display: table-column;
        width: 110px;
        /*        background-color: #c8cbcf;*/
        padding: 3px;
        text-align: center;
    }
</style>
<div class="btn-group">
    <button type="button" class="btn btn-secondary btn-sm"><i class="las la-bars"></i></button>
    <button type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-expanded="false">
        <span class="sr-only">Pressione</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" id="openModal" data-id="{{$entry->getKey()}}"
           data-route="{{ url($crud->route.'/'.$entry->getKey()) }}" data-all="{{$entry->id}}" href="#"><i
                class="fa fa-eye"></i>Alterar status</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="activity/{{$entry->getKey()}}/show"><i class="fa fa-eye"></i>Visualizar</a>
        <a class="dropdown-item" href="activity/{{$entry->getKey()}}/edit"><i class="fa fa-edit"></i>Editar</a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteEntry(this)"
           data-route="{{ url($crud->route.'/'.$entry->getKey()) }}"><i class="fa fa-trash-alt"></i>Apagar</a>
        <div class="dropdown-divider"></div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Menu de opções de status: <b id="actId"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="div-table">
                    <div class="div-table-row" style="margin-top: 10px">
                        <p><b>Ações da atividade</b></p>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.ActivityStatus.WAITING')}}">
                                <img src="{{ asset('icons/waiting.png') }}" height="48" width="48">
                                <p>Aguardando</p>
                                </a>
                            </span>
                        </div>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.ActivityStatus.IN_PROGRESS')}}">
                                    <img src="{{ asset('icons/gear.png') }}" height="48" width="48">
                                    <p>Iniciar</p>
                                </a>
                            </span>
                        </div>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.activityStatus.ON_HOLD')}}">
                                    <img src="{{ asset('icons/pause.png') }}" height="48" width="48">
                                    <p>Pausar</p>
                                </a>
                            </span>
                        </div>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.activityStatus.DELIVERED')}}">
                                <img src="{{ asset('icons/delivery-box.png') }}" height="48" width="48">
                                <p>Entregar</p>
                                </a>
                            </span>
                        </div>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.activityStatus.PAID')}}">
                                <img src="{{ asset('icons/paid.png') }}" height="48" width="48">
                                <p>Pago</p>
                                </a>
                            </span>
                        </div>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.activityStatus.FINISHED')}}">
                                <img src="{{ asset('icons/flag.png') }}" height="48" width="48">
                                <p>Finalizado</p>
                                </a>
                            </span>
                        </div>
                        <div class="div-table-col">
                            <span>
                                <a href="activity/setStatus/{{$entry->getKey()}}/{{config('status.activityStatus.CANCELED')}}">
                                <img src="{{ asset('icons/delete.png') }}" height="48" width="48">
                                <p>Cancelado</p>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('after_scripts') @if (request()->ajax()) @endpush @endif

<script>
    //evita com que a modal fique por baixo
    $('#exampleModal').appendTo("body");
    $(document).off('click', '#openModal').on('click', '#openModal', function (e) {
        var route = $(this).data('route');
        $("#actId").html($(this).data('all'));
        $('#exampleModal').modal('show');
        //corrige o link da rota em caso de deleçao
        $('#btnDelete').attr('data-route', route);
    });
</script>
<script>

    if (typeof deleteEntry != 'function') {
        $("[data-button-type=delete]").unbind('click');

        function deleteEntry(button) {
            // ask for confirmation before deleting an item
            // e.preventDefault();
            var button = $(button);
            var route = button.attr('data-route');
            var row = $("#crudTable a[data-route='" + route + "']").closest('tr');

            swal({
                title: "{!! trans('backpack::base.warning') !!}",
                text: "{!! trans('backpack::crud.delete_confirm') !!}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "{!! trans('backpack::crud.cancel') !!}",
                        value: null,
                        visible: true,
                        className: "bg-secondary",
                        closeModal: true,
                    },
                    delete: {
                        text: "{!! trans('backpack::crud.delete') !!}",
                        value: true,
                        visible: true,
                        className: "bg-danger",
                    }
                },
            }).then((value) => {
                if (value) {
                    $.ajax({
                        url: route,
                        type: 'DELETE',
                        success: function (result) {
                            if (result == 1) {
                                // Show a success notification bubble
                                new Noty({
                                    type: "success",
                                    text: "{!! '<strong>'.trans('backpack::crud.delete_confirmation_title').'</strong><br>'.trans('backpack::crud.delete_confirmation_message') !!}"
                                }).show();
                                // Hide the modal, if any
                                $('.modal').modal('hide');
                                // Remove the details row, if it is open
                                if (row.hasClass("shown")) {
                                    row.next().remove();
                                }
                                // Remove the row from the datatable
                                row.remove();
                            } else {
                                // if the result is an array, it means
                                // we have notification bubbles to show
                                if (result instanceof Object) {
                                    // trigger one or more bubble notifications
                                    Object.entries(result).forEach(function (entry, index) {
                                        var type = entry[0];
                                        entry[1].forEach(function (message, i) {
                                            new Noty({
                                                type: type,
                                                text: message
                                            }).show();
                                        });
                                    });
                                } else {// Show an error alert
                                    swal({
                                        title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                        text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                        icon: "error",
                                        timer: 4000,
                                        buttons: false,
                                    });
                                }
                            }
                        },
                        error: function (result) {
                            // Show an alert with the result
                            swal({
                                title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                                text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                                icon: "error",
                                timer: 4000,
                                buttons: false,
                            });
                        }
                    });
                }
            });
        }
    }

    // make it so that the function above is run after each DataTable draw event
    // crud.addFunctionToDataTablesDrawEventQueue('deleteEntry');
</script>
@if (!request()->ajax()) @endpush @endif
