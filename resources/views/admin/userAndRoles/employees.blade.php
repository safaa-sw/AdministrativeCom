@extends('admin.layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('homePage.users') }}

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
                                class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('homePage.username') }} </th>
                                        <th>{{ __('homePage.email') }}</th>
                                        <th>{{ __('homePage.department') }}</th>
                                        <th>{{ __('homePage.role') }}</th>
                                        <th hidden></th>
                                        <th hidden></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($users) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($users as $user)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $user->id }}">

                                                <td>{{ $count }}</td>
                                                <td class="row-data">{{ $user->name }}</td>
                                                <td class="row-data">{{ $user->email }} </td>
                                                <td class="row-data">{{ $user->department->name }} </td>
                                                <td class="row-data">{{ $user->role->name }} </td>
                                                <td class="row-data" hidden>{{ $user->department->id }} </td>
                                                <td class="row-data" hidden>{{ $user->role->id }} </td>
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
                                                    <button type="button" class="btn btn-outline-success"
                                                        data-toggle="modal" data-target="#editModal"
                                                        onclick="editBtnClick()">
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
                                            <td colspan="5">{{ __('homePage.no_data') }} </td>
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
                                            <a class="page-link" href="{{ $users->previousPageUrl() }}"
                                                tabindex="-1">{{ __('homePage.previous') }}</a>
                                        </li>
                                        <li class="page-item disabled"></li>
                                        <li class="page-item">
                                            <a class="page-link"
                                                href="{{ $users->nextPageUrl() }}">{{ __('homePage.next') }}</a>
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
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.username') }}
                                </label>
                                <input id="name" type="text" class="form-control" name="name" value=""
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.email') }}
                                </label>
                                <input id="email" type="text" class="form-control" name="email" value=""
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.password') }}
                                </label>
                                <input id="password" type="password" class="form-control" name="password" value=""
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="department" class="col-md-3 col-form-label text-md-right">
                                    {{ __('homePage.department') }}
                                </label>
                                <select class="form-select" name="department" id="department" data-select-search="true"
                                    required>
                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="role" class="col-md-3 col-form-label text-md-right">
                                    {{ __('homePage.role') }}
                                </label>
                                <select class="form-select" name="role" id="role" data-select-search="true"
                                    required>
                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        <br />

                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit"
                                    class="btn btn-primary">{{ __('transaction.trans_save') }}</button>
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
                                <label for="nameShow" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.username') }}
                                </label>
                                <input id="nameShow" type="text" class="form-control" name="nameShow" value=""
                                    autofocus disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="emailShow" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.email') }}
                                </label>
                                <input id="emailShow" type="text" class="form-control" name="emailShow" value=""
                                    autofocus disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="departmentShow" class="col-md-3 col-form-label text-md-right">
                                    {{ __('homePage.department') }}
                                </label>
                                <input id="departmentShow" type="text" class="form-control" name="departmentShow" value=""
                                autofocus disabled>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="roleShow" class="col-md-3 col-form-label text-md-right">
                                    {{ __('homePage.role') }}
                                </label>
                                <input id="roleShow" type="text" class="form-control" name="roleShow" value=""
                                autofocus disabled>              

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
                    <form method="POST" action="{{ route('users.update') }}">
                        @csrf
                        <div class="form-group row">
                            <input id="userId" type="hidden" class="form-control" name="userId"
                                                    value="">
                            <div class="col-md-8">
                                <label for="nameEdit" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.username') }}
                                </label>
                                <input id="nameEdit" type="text" class="form-control" name="nameEdit" value=""
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="emailEdit" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.email') }}
                                </label>
                                <input id="emailEdit" type="text" class="form-control" name="emailEdit" value=""
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="passwordEdit" class="col-md-4 col-form-label text-md-right">
                                    {{ __('homePage.password') }}
                                </label>
                                <input id="passwordEdit" type="password" class="form-control" name="passwordEdit" value=""
                                    autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="departmentEdit" class="col-md-3 col-form-label text-md-right">
                                    {{ __('homePage.department') }}
                                </label>
                                <select class="form-select" name="departmentEdit" id="departmentEdit" data-select-search="true"
                                    required>
                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="roleEdit" class="col-md-3 col-form-label text-md-right">
                                    {{ __('homePage.role') }}
                                </label>
                                <select class="form-select" name="roleEdit" id="roleEdit" data-select-search="true"
                                    required>
                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <br />
                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit"
                                    class="btn btn-primary">{{ __('transaction.trans_save') }}</button>
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
        var rowId = event.target.parentNode.parentNode.id;
        var data = document.getElementById(rowId).querySelectorAll(".row-data");
        $("#nameShow").val(data[0].innerHTML);
        $("#emailShow").val(data[1].innerHTML);
        $("#departmentShow").val(data[2].innerHTML);
        $("#roleShow").val(data[3].innerHTML);
    }

    function editBtnClick() {        
        var rowId = event.target.parentNode.parentNode.id;
        var data = document.getElementById(rowId).querySelectorAll(".row-data");
        $("#userId").val(rowId);
        $("#nameEdit").val(data[0].innerHTML);
        $("#emailEdit").val(data[1].innerHTML);
        $("#departmentEdit").val(data[4].innerHTML);
        $("#roleEdit").val(data[5].innerHTML);
    }
</script>
