@extends('layouts.app')

@section('trash_data')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Trashed Data</h1>
                        <table class="table table-bordered table-stripped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Deleted At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trash as $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->gender }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->password }}</td>
                                    <td>{{ $row->deleted_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
