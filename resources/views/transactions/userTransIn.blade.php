@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('transaction.my_incoming_trans') }}
                        </div>
                        <div class="card-body">
                            <table id="transTable"
                                class="table table-bordered table-striped {{ count($transactions) > 0 ? 'datatable' : '' }} dt-select">
                                <thead>
                                    <tr>
                                        <th>م</th>
                                        <th>{{ __('transaction.number') }} </th>
                                        <th>{{ __('transaction.subject') }}</th>
                                        <th> {{ __('transaction.importance_degree') }}</th>
                                        <th>{{ __('transaction.secret_degree') }} </th>
                                        <th>{{ __('transaction.transaction_referr_from') }} </th>
                                        <th>{{ __('transaction.referr_type') }} </th>
                                        <th>{{ __('transaction.transaction_recieved') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($transactions) > 0)
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($transactions as $transaction)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr id="{{ $transaction->id }}">

                                                <td>{{ $count }}</td>
                                                <td>{{ $transaction->number }}</td>
                                                <td>{{ $transaction->subject }} </td>
                                                <td>{{ $transaction->secret->name }} </td>
                                                <td>{{ $transaction->importance->name }} </td>
                                                <td>{{ $referrFrom[$count-1] }} </td>
                                                <td>{{ $referrType[$count-1] }} </td>
                                                <td>
                                                    <a href="{{route('transaction/recieve',[$transaction->id])}}" class="btn btn-outline-primary">
                                                        {{ __('transaction.transaction_ok') }}
                                                    </a>

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

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
