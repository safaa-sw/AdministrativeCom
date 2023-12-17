@extends('admin.layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            {{ __('transaction.trans_type') }}

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

                            <table id="transTable"
                                class="table table-bordered table-striped {{ count($transTypes) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('transaction.public_type') }} </th>
                                        <th>{{ __('transaction.private_type') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($transTypes) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($transTypes as $transType)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $transType->id }}">

                                                <td>{{ $count }}</td>
                                                <td class="row-data">{{ $transType->type }}</td>
                                                <td class="row-data">{{ $transType->name }} </td>


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
                                            <td colspan="5">{{__('homePage.no_data')}}  </td>
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
                                            <a class="page-link" href="{{ $transTypes->previousPageUrl() }}"
                                                tabindex="-1">{{__('homePage.previous')}}</a>
                                        </li>
                                        <li class="page-item disabled"></li>
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $transTypes->nextPageUrl() }}">{{__('homePage.next')}}</a>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.add') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('transTypes.store')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="type" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.public_type') }}
                                </label>
                                <select class="form-select" name="type" id="type"
                                data-select-search="true" required>
                                <option value=""> {{ __('transaction.select_choise') }}</option>
                                <option value="{{ __('transaction.inside') }}">{{ __('transaction.inside') }}</option>
                                <option value="{{ __('transaction.incoming') }}">{{ __('transaction.incoming') }}</option>
                                <option value="{{ __('transaction.outgoing') }}">{{ __('transaction.outgoing') }}</option>
                               
                            </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="name" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.private_type') }}
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
        <div class="modal-dialog modal-lg" role="document">
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
                                <label for="typeShow" class="col-md-4 col-form-label text-md-right">
                                    {{ __('transaction.public_type') }}
                                </label>
                                <input type="text" id="typeShow" name="typeShow" class="form-control" disabled>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="nameShow" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.private_type') }}
                                </label>
                                <input type="text" id="nameShow" name="nameShow" class="form-control" disabled>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.update') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('transTypes.update')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input id="typeId" type="hidden" class="form-control" name="typeId"
                                                    value="">
                                <label for="typeEdit" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.public_type') }}
                                </label>
                                <select class="form-select" name="typeEdit" id="typeEdit"
                                data-select-search="true" required>
                                <option value=""> {{ __('transaction.select_choise') }}</option>
                                <option value="{{ __('transaction.inside') }}">{{ __('transaction.inside') }}</option>
                                <option value="{{ __('transaction.incoming') }}">{{ __('transaction.incoming') }}</option>
                                <option value="{{ __('transaction.outgoing') }}">{{ __('transaction.outgoing') }}</option>
                               
                            </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="nameEdit" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.private_type') }}
                                </label>
                                <input id="nameEdit" type="text" class="form-control" name="nameEdit"
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
        $("#typeShow").val(data[0].innerHTML);
        $("#nameShow").val(data[1].innerHTML);
    }
    function editBtnClick() {
        var rowId=event.target.parentNode.parentNode.id;
        var data=document.getElementById(rowId).querySelectorAll(".row-data");
        $("#typeId").val(rowId);
        $("#typeEdit").val(data[0].innerHTML);
        $("#nameEdit").val(data[1].innerHTML);
    }

    
</script>
