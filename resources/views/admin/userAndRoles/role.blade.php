@extends('admin.layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            {{ __('homePage.roles') }}

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

                            <table id="roleTable"
                                class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('homePage.role') }} </th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($roles) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($roles as $role)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $role->id }}">

                                                <td>{{ $count }}</td>
                                                <td class="row-data">{{ $role->name }}</td>
                                              
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
                                            <a class="page-link" href="{{ $roles->previousPageUrl() }}"
                                                tabindex="-1">{{__('homePage.previous')}}</a>
                                        </li>
                                        <li class="page-item disabled"></li>
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $roles->nextPageUrl() }}">{{__('homePage.next')}}</a>
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
                    <form method="POST" action="{{route('roles.store')}}">
                        @csrf
                        
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="role" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.role') }}
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
                                <label for="roleShow" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.role') }}
                                </label>
                                <input class="form-control" type="text" id="roleShow" name="roleShow" disabled>

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
                    <form method="POST" action="{{route('roles.update')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input id="roleId" type="hidden" class="form-control" name="roleId"
                                                    value="">
                                <label for="roleEdit" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.role') }}
                                </label>
                                <input id="roleEdit" type="text" class="form-control" name="roleEdit"
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
        $("#roleShow").val(data[0].innerHTML);
    }
    function editBtnClick() {
        var rowId=event.target.parentNode.parentNode.id;
        var data=document.getElementById(rowId).querySelectorAll(".row-data");
        $("#roleId").val(rowId);
        $("#roleEdit").val(data[0].innerHTML);
       
    }

</script>
