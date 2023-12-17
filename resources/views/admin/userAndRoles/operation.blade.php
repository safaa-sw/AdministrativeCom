@extends('admin.layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            {{ __('homePage.operations') }}

                        </div>
                        <div class="card-body">
                            <div>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#addModal">
                                    <svg class="svg-action">
                                        <use
                                            xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-plus') }}">
                                        </use>
                                    </svg>
                                    {{ __('transaction.add') }}
                                </button>
                            </div>



                            <br />

                            <table id="operationTable"
                                class="table table-bordered table-striped {{ count($operations) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('homePage.operation') }} </th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($operations) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($operations as $operation)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $operation->id }}">

                                                <td>{{ $count }}</td>
                                                <td class="row-data">{{ $operation->name }}</td>
                                              
                                                <td>
                                                    <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                        data-target="#showModal" id="showButton" onclick="showBtnClick()">
                                                        <svg class="svg-action">
                                                            <use
                                                                xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-zoom-in') }}">
                                                            </use>
                                                        </svg>
                                                        {{ __('transaction.show') }}
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                        data-target="#editModal" onclick="editBtnClick()">
                                                        <svg class="svg-action">
                                                            <use
                                                                xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-pencil') }}">
                                                            </use>
                                                        </svg>
                                                        {{ __('transaction.update') }}
                                                    </button>
                                                   
                                                   
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">{{__('homePage.no_data')}}     </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <br />
                            <br />
                            <!-- Pagination Start -->
                            <div class="col-md-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $operations->previousPageUrl() }}"
                                                tabindex="-1">{{__('homePage.previous')}}</a>
                                        </li>
                                        <li class="page-item disabled"></li>
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $operations->nextPageUrl() }}">{{__('homePage.next')}}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- Pagination Start -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--------- Modals Sections ------------------------------------->
    <!-- add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.add') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('operation.store')}}">
                        @csrf
                        
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="operation" class="col-md-5 col-form-label text-md-right">
                                    {{ __('homePage.operation') }}
                                </label>
                                <input id="name" type="text" class="form-control" name="name"
                                                    value="" autofocus required>
                            </div>
                        </div>

                        <br />

                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">{{ __('transaction.trans_save') }}</button>
                                <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">{{ __('transaction.close') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>

    <!-------show modal -->
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.show') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="operationShow" class="col-md-5 col-form-label text-md-right">
                                    {{ __('homePage.operation') }}
                                </label>
                                <input class="form-control" type="text" id="operationShow" name="operationShow" disabled>

                            </div>
                        </div>
                        <br />

                        <div class="form-group row">
                            <div class="col-md-8">
                               
                                <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">{{ __('transaction.close') }}</button>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>

    <!-------edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.update') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('operation.update')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input id="operationId" type="hidden" class="form-control" name="operationId"
                                                    value="">
                                <label for="operationEdit" class="col-md-5 col-form-label text-md-right">
                                    {{ __('homePage.operation') }}
                                </label>
                                <input id="operationEdit" type="text" class="form-control" name="operationEdit"
                                                    value="" autofocus required>
                            </div>
                        </div>
                        
                        <br />

                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">{{ __('transaction.trans_save') }}</button>
                                <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">{{ __('transaction.close') }}</button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    function showBtnClick() {
        var rowId=event.target.parentNode.parentNode.id;
        var data=document.getElementById(rowId).querySelectorAll(".row-data");
        $("#operationShow").val(data[0].innerHTML);
    }
    function editBtnClick() {
        var rowId=event.target.parentNode.parentNode.id;
        var data=document.getElementById(rowId).querySelectorAll(".row-data");
        $("#operationId").val(rowId);
        $("#operationEdit").val(data[0].innerHTML);
       
    }

</script>