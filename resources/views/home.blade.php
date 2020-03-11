@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                        <br>
                        <br>
                        <br>

                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" accept=".csv">
                            <br>
                            <button class="btn btn-success">Import User Data</button>
                            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>
                            <a class="btn btn-dark" href="{{route('trash')}}">Trashed User Data</a>
                        </form>
                        <br>
                        <br>

                    @yield('csv_data')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
