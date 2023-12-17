@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            {{ __('transaction.transaction_connect') }}
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
                                class="table table-bordered table-striped {{ count($connectedTrans) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('transaction.number') }} </th>
                                        <th>{{ __('transaction.subject') }}</th>
                                        <th> {{ __('transaction.transaction_connect_type') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($connectedTrans) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($connectedTrans as $connected)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $connected->id }}">

                                                <td>{{ $count }}</td>
                                                @if ($connected->transaction1->id == $id)
                                                    <td>{{ $connected->transaction2->number }}</td>
                                                    <td>{{ $connected->transaction2->subject }} </td>
                                                @else
                                                    <td>{{ $connected->transaction1->number }}</td>
                                                    <td>{{ $connected->transaction1->subject }} </td>
                                                @endif


                                                <td>{{ $connected->connect_type }} </td>
                                                <td>
                                                    <form action="{{ route('transaction/disconnect', [$connected->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('transaction.transaction_disconnect') }}</button>
    
                                                  </form>
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

                            <a class="btn btn-dark" href="{{URL::previous()}}">{{__('homePage.goback')}}</a>
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
                    <form method="POST" action="{{route('transaction/connectedStore',[$id])}}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="transNumber" class="col-md-8 col-form-label text-md-right">
                                    {{ __('transaction.transaction_connect_number') }}
                                </label>
                                <select class="form-select" name="transNumber" id="transNumber" data-select-search="true"
                                    required>
                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                    @foreach ($transactions as $transaction)
                                    <option value="{{$transaction->id}}"@if ($transaction->id==$id)
                                       hidden 
                                    @endif> {{ $transaction->number }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="connectType" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.transaction_connect_type') }}
                                </label>
                                <select class="form-select" name="connectType" id="connectType" data-select-search="true"
                                    required>
                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                    <option value="{{ __('transaction.connect_type1') }}">
                                        {{ __('transaction.connect_type1') }}</option>
                                    <option value="{{ __('transaction.connect_type2') }}">
                                        {{ __('transaction.connect_type2') }}</option>
                                    <option value="{{ __('transaction.connect_type3') }}">
                                        {{ __('transaction.connect_type3') }}</option>

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
