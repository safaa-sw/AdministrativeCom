@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="card">
                                <div class="card-header">
                                    <h5> {{ __('transaction.transaction_show') }} </h5>

                                </div>
                                <div class="card-body">
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-striped">
                                            <th colspan="2">{{ __('transaction.transaction_info') }}</th>
                                            <tr>
                                                <th>{{ __('transaction.number') }}</th>
                                                <td>{{ $transaction->number }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('transaction.subject') }}</th>
                                                <td>{{ $transaction->subject }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('transaction.importance_degree') }}</th>
                                                <td>{{ $transaction->importance->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('transaction.secret_degree') }}</th>
                                                <td>{{ $transaction->secret->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('transaction.trans_type') }}</th>
                                                <td>{{ $transaction->transType->type }} -
                                                    {{ $transaction->transType->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('transaction.trans_status') }}</th>
                                                <td>{{ $transaction->transStatus->status }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br />
                                    <div class="col-md-6">
                                        <table id="transTable"
                                            class="table table-bordered table-striped {{ count($connectedTrans) > 0 ? 'datatable' : '' }} dt-select">
                                            <thead>
                                                <th colspan="4">{{ __('transaction.transaction_connected') }}</th>
                                                <tr>
                                                    <th>م</th>
                                                    <th>{{ __('transaction.number') }} </th>
                                                    <th>{{ __('transaction.subject') }}</th>
                                                    <th> {{ __('transaction.transaction_connect_type') }}</th>
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
                                                            @if ($connected->transaction1->id == $transaction->id)
                                                                <td>{{ $connected->transaction2->number }}</td>
                                                                <td>{{ $connected->transaction2->subject }} </td>
                                                            @else
                                                                <td>{{ $connected->transaction1->number }}</td>
                                                                <td>{{ $connected->transaction1->subject }} </td>
                                                            @endif


                                                            <td>{{ $connected->connect_type }} </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">{{ __('homePage.no_data') }} </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                    <br />
                                    <div class="col-md-6">
                                        <table id="transTable"
                                            class="table table-bordered table-striped {{ count($files) > 0 ? 'datatable' : '' }} dt-select">
                                            <thead>
                                                <th colspan="3">{{ __('transaction.transaction_files') }}</th>
                                                <tr>
                                                    <th>م</th>
                                                    <th>{{ __('transaction.transaction_file_type') }} </th>
                                                    <th>{{ __('transaction.transaction_file_user') }} </th>
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

                                                            <td>{{ $file->type }}</td>
                                                            <td>{{ $file->user->name }} </td>
                                                            <td> <a href="{{asset($file->path)}}" class="btn btn-outline-success btn-sm">
                                                                {{ __('transaction.transaction_file_show') }}
                                                            </a></td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">{{ __('homePage.no_data') }} </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>

                                    <a class="btn btn-dark" href="{{URL::previous()}}">{{__('homePage.goback')}}</a>

                                </div>
                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
