@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('transaction.tracking') }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaction/trackedSearch') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="number" class="col-md-3 col-form-label text-md-right">
                                            {{ __('transaction.number') }}
                                        </label>
                                        <table>
                                            <tr>
                                                <td><input id="number" type="text" class="form-control" name="number"
                                                    value="" autofocus required></td>
                                                    <td> &nbsp; <button type="submit" class="btn btn-success text-white me-0"> {{ __('transaction.trans_search') }}</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                               
                            </form>
                            <br/>
                            @if ($trackedTrans != null)
                                <table id="transTable"
                                    class="table table-bordered table-striped {{ count($trackedTrans) > 0 ? 'datatable' : '' }} dt-select">
                                    <thead>
                                        <tr>
                                            <th>م</th>
                                            <th>{{ __('transaction.number') }} </th>
                                            <th>{{ __('transaction.subject') }}</th>
                                            <th>{{ __('transaction.transaction_action') }} </th>
                                            <th>{{ __('transaction.user_action') }}</th>
                                            <th> {{ __('transaction.desc_action') }}</th>
                                            <th> {{ __('transaction.date_action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($trackedTrans) > 0)
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach ($trackedTrans as $tracked)
                                                @php
                                                    $count++;
                                                @endphp
                                                <tr id="{{ $tracked->id }}">
                                                    <td>{{ $count }}</td>
                                                    <td>{{ $tracked->transaction->number }}</td>
                                                    <td>{{ $tracked->transaction->subject }}</td>
                                                    <td>{{ $tracked->action->name }}</td>
                                                    <td>{{ $tracked->user->name }}</td>
                                                    <td>{{ $tracked->description }}</td>
                                                    <td>{{ $tracked->date }}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">{{ __('homePage.no_data') }} </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            @endif


                            <br />
                            <br />

                        </div>
                    </div>
                    <div>

                    </div>

                </div>

            </div>

        @endsection
