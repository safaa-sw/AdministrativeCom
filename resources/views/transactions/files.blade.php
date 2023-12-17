@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            {{ __('transaction.transaction_files') }}
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
                                class="table table-bordered table-striped {{ count($files) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('transaction.transaction_file_type') }} </th>
                                        <th> {{ __('transaction.transaction_file_user') }} </th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($files) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($files as $file)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $file->id }}">

                                                <td>{{ $count }}</td>
                                                <td>{{ $file->type }} </td>
                                                <td>{{ $file->user->name }} </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td> <a href="{{asset($file->path)}}" class="btn btn-outline-success btn-sm">
                                                                {{ __('transaction.transaction_file_show') }}
                                                            </a></td>
                                                            <td><form action="{{ route('transaction/fileDetach', [$file->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-outline-danger btn-sm">{{ __('transaction.transaction_disconnect') }}</button>

                                                            </form></td>
                                                        </tr>
                                                    </table>
                                                   
                                                    
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

                            <!-- Pagination Start -->

                            <a class="btn btn-dark" href="{{ URL::previous() }}">{{ __('homePage.goback') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

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
                    <form method="POST" action="{{ route('transaction/fileStore', [$id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="type" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.transaction_file_type') }}
                                </label>
                                <select class="form-select" name="type" id="type" data-select-search="true"
                                    required>
                                    <option value="image"> image</option>
                                    <option value="pdf">pdf</option>
                                    <option value="excel">excel</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="path" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.transaction_file_path') }}
                                </label>
                                <input type="file" class="form-control" id="path" name="path">
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
