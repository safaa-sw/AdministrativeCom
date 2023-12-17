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
                                    <h5> {{ __('homePage.transaction_inside') }}</h5>

                                </div>
                                <div class="card-body">

                                    <form method="POST" action="{{route('transactions.update',[$transaction->id])}}">
                                        @csrf
                                        @method('put')

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="number" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.number') }}
                                                </label>
                                                <input id="number" type="text" class="form-control" name="number"
                                                    value="{{$transaction->number}}" autofocus disabled>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="subject" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.subject') }}
                                                </label>

                                                <input id="subject" type="text" class="form-control" name="subject"
                                                    value="{{$transaction->subject}}" autofocus required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="type" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.trans_type') }}
                                                </label>
                                                <select class="form-select" name="type" id="type"
                                                    data-select-search="true" required>
                                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                                    @foreach ($transTypes as $types)
                                                        <option value="{{ $types->id }}" @if ($transaction->trans_type_id==$types->id) selected @endif>{{ $types->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-md-6">
                                                <label for="status" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.trans_status') }}
                                                </label>
                                                <select class="form-select" name="status" id="status"
                                                    data-select-search="true" required>
                                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                                    @foreach ($transStatus as $status)
                                                        <option value="{{ $status->id }}" @if ($transaction->trans_status_id==$status->id) selected @endif>{{ $status->status }}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="trans_user" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.trans_user') }}
                                                </label>
                                                <input id="trans_user" type="text" class="form-control" name="trans_user"
                                                    value="{{auth()->user()->name}}" autofocus disabled>

                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="trans_depart" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.trans_depart') }}
                                                </label>
                                                <select class="form-select" name="trans_depart" id="trans_depart"
                                                    data-select-search="true" required>
                                                    <option value=""> {{ __('transaction.select_choise') }}</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}" @if ($transaction->type->inside_management==$department->id) selected @endif>{{ $department->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="secret" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.secret_degree') }}
                                                </label>
                                                <select class="form-select" name="secret" id="secret"
                                                data-select-search="true" required>
                                                <option value=""> {{ __('transaction.select_choise') }}</option>
                                                @foreach ($secrets as $secret)
                                                    <option value="{{ $secret->id }}" @if ($transaction->secret_id==$secret->id) selected @endif>{{ $secret->name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="importance" class="col-md-3 col-form-label text-md-right">
                                                    {{ __('transaction.importance_degree') }}
                                                </label>
                                                <select class="form-select" name="importance" id="importance"
                                                data-select-search="true" required>
                                                <option value=""> {{ __('transaction.select_choise') }}</option>
                                                @foreach ($importances as $importance)
                                                    <option value="{{ $importance->id }}" @if ($transaction->importance_id==$importance->id) selected @endif>{{ $importance->name }}</option>
                                                @endforeach
                                            </select>

                                            </div>
                                        </div>


                                        <br />

                                        <div class="form-group row">

                                            <div class="col-md-12 offset-md-5">
                                                <button type="submit" class="btn btn-primary" id="submitbtn"
                                                    value="Submit">{{ __('transaction.trans_save') }}
                                                </button>

                                                <a class="btn btn-dark" href="{{URL::previous()}}">{{__('homePage.goback')}}</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
