@extends('admin.layouts.app')

@section('content')
    <main class="content">
        <div class="container-fluid p-1">
            <h1 class="h3 mb-3">Dashboard</h1>
            @if (Session::has("message"))
                <div style="background-color: {{Session::get('message')['bg']}}; padding:5px;">
                    <b>{{Session::get('message')['msg']}}</b>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
