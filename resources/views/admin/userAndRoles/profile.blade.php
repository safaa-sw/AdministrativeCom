@extends('layouts.app')

@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            {{ __('homePage.profile') }}
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('profile.store',[Auth::user()->id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">
                                            {{ __('homePage.username') }}
                                        </label>
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{Auth::user()->name}}" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">
                                            {{ __('homePage.email') }}
                                        </label>
                                        <input id="email" type="text" class="form-control" name="email"
                                            value="{{Auth::user()->email}}" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">
                                            {{ __('homePage.password') }}
                                        </label>
                                        <input id="password" type="password" class="form-control" name="password"
                                            value="{{Auth::user()->password}}" autofocus required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="address" class="col-md-4 col-form-label text-md-right">
                                            {{ __('homePage.address') }}
                                        </label>
                                        <input id="address" type="text" class="form-control" name="address"
                                        @if ($profile!=null) value="{{$profile->address}}" @else  value="" @endif
                                        autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label for="image" class="col-md-4 col-form-label text-md-right">
                                            {{ __('homePage.profileImage') }}
                                        </label>

                                        <input type="file" class="form-control" id="image" name="image">
                                        @if ($profile!=null)  
                                        <img src="{{URL::asset($profile->image)}}" alt="" class="img-tumbnail" width="200"
                                            height="200"> 
                                        @endif        
                                    </div>

                                </div>
                        </div>


                        <br />
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary">{{ __('transaction.trans_save') }}</button>
                                <a href="{{route('transaction')}}" class="btn btn-danger">{{ __('transaction.close') }}</a>
                            </div>
                        </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection

<script></script>
