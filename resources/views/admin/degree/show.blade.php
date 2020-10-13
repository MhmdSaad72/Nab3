@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header"> {{ $degree->title }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/degree') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $degree->id }}</td>
                                </tr>
                                <tr>
                                    <th> Title </th>
                                    <td> {{ $degree->title }} </td>
                                </tr>
                                <tr>
                                    <th> Arabic Title </th>
                                    <td> {{ $degree->arabic_title }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
