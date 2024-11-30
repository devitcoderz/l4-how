@extends('user.layouts.app')

@section('content')
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Change Password</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            <form action="{{route('user.change-password.submit')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input value="{{old('current_password')}}" class="form-control form-control-lg" type="password" name="current_password" placeholder="Enter current password" />
                                    @if ($errors->has('current_password'))
                                    <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirm your password" />
                                    @if ($errors->has('password_confirmation '))
                                    <span class="text-danger">{{ $errors->first('password_confirmation ') }}</span>
                                    @endif
                                </div>
                                
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
@endsection