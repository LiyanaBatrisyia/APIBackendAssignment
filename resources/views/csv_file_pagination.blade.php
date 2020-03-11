@extends('home')

@section('csv_data')

    <h1>Users Data</h1>
    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->gender }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->password }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>

    {!! $data->links() !!}
@endsection
