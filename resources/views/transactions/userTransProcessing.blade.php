@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('homePage.user_processing') }}

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
                                        <th>{{ __('transaction.referr_type') }} </th>
                                        <th></th>
                                        <th>{{ __('transaction.transaction_processed') }}</th>
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
                                                <td class="row-data">{{ $transaction->number }}</td>
                                                <td class="row-data">{{ $transaction->subject }} </td>
                                                <td class="row-data">{{ $transaction->secret->name }} </td>
                                                <td class="row-data">{{ $transaction->importance->name }} </td>
                                                <td class="row-data">{{ $referrType[$count - 1] }} </td>
                                                <td>
                                                    <!--
                                                                <a href="#">
                                                                    <svg class="svg-action">
                                                                        <use xlink:href="{{ asset('template/vendors/@coreui/icons/svg/free.svg#cil-search') }}"></use>
                                                                    </svg>
                                                                </a>
                                                            -->

                                                    <a href="{{ route('transactions.edit', [$transaction->id]) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        {{ __('transaction.transaction_update') }}
                                                    </a>
                                                    <a href="{{route('transaction/file',[$transaction->id])}}" class="btn btn-outline-dark btn-sm">
                                                        {{ __('transaction.transaction_files') }}
                                                    </a>
                                                    <a href="{{ route('transaction/connected', [$transaction->id]) }}"
                                                        class="btn btn-outline-info btn-sm">
                                                        {{ __('transaction.transaction_connect') }}
                                                    </a>
                                                    <button type="button" class="btn btn-outline-warning btn-sm"
                                                        data-toggle="modal" data-target="#transReferrModal"
                                                        onclick="referrBtnClick()">
                                                        {{ __('transaction.transaction_referr') }}
                                                    </button>
                                                    <a href="{{ route('transactions.show', [$transaction->id]) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        {{ __('transaction.transaction_show') }}
                                                    </a>
                                                    <button type="button" class="btn btn-outline-success btn-sm"
                                                        data-toggle="modal" data-target="#opinionModal"
                                                        onclick="opinionBtnClick()">
                                                        {{ __('transaction.transaction_opinion') }}
                                                    </button>
                                                    <a href="{{route('transaction/close',[$transaction->id])}}" class="btn btn-outline-danger btn-sm">
                                                        {{ __('transaction.transaction_close') }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('transaction/processed', [$transaction->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        {{ __('transaction.transaction_ok') }}</a>

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


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!--------- Modals Sections ------------------------------------->
    <!-- transaction refer Modal -->
    <div class="modal fade" id="transReferrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.transaction_referr') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transaction/referr') }}">
                        @csrf
                        <div class="form-group row">

                            <div class="col-md-8">
                                <input id="transId" type="hidden" class="form-control" name="transId" value="">
                                <label for="to_user" class="col-md-5 col-form-label text-md-right">
                                    {{ __('transaction.transaction_referr_base') }}
                                </label>
                                <select class="dropdown-menu" multiple name="to_user_base[]" id="to_user_base"
                                    data-select-search="true">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if ($user->id==auth()->user()->id) hidden @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-8">
                                <label for="to_user" class="col-md-5 col-form-label text-md-right">
                                    {{ __('transaction.transaction_referr_image') }}
                                </label>
                                <select class="dropdown-menu" multiple name="to_user_image[]" id="to_user_image"
                                    data-select-search="true">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if ($user->id==auth()->user()->id) hidden @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <label for="" id="errorDiv" style="color: red; font-size:13px;"></label>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="description" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.notes') }}
                                </label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                            </div>
                        </div>

                        <br />

                        <div class="form-group row">
                            <div class="col-md-8">
                                <button type="submit" id="submitbtn"
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
    <!-------------------------------------------------------------------------------------------------------------->

    <!-- transaction opinion Modal -->
    <div class="modal fade" id="opinionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('transaction.transaction_opinion') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('transaction/giveOpinion') }}">
                        @csrf
                       
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input id="transID" type="hidden" class="form-control" name="transID" value="">
                                <label for="description" class="col-md-3 col-form-label text-md-right">
                                    {{ __('transaction.transaction_opinion') }}
                                </label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
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

<!--------------------------------------------------------------------------------------->

@section('javascript')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            $("#to_user_base").multiselect();
            $("#to_user_image").multiselect();
            $("#errorDiv").hide();

        });

        function referrBtnClick() {
            var rowId = event.target.parentNode.parentNode.id;
            var data = document.getElementById(rowId).querySelectorAll(".row-data");
            $("#transId").val(rowId);
        }

        function opinionBtnClick() {
            var rowId = event.target.parentNode.parentNode.id;
            var data = document.getElementById(rowId).querySelectorAll(".row-data");
            $("#transID").val(rowId);
        }

        $("#submitbtn").click(function() {

            if (($("#to_user_base").val().length == 0) && ($("#to_user_image").val().length == 0)) {
                $("#errorDiv").show();
                $("#errorDiv").html("يجب أن تختار طريقة على الأقل");
                return false;
            } else {
                $("#errorDiv").hide();
                return true;
            }
        });
    </script>
@endsection
