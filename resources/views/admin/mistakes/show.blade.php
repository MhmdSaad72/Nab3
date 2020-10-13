@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                {{-- <div class="card-header"> {{ $mistake->title }}</div> --}}
                <div class="card-body">

                    <a href="{{ url('/admin/mistakes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $mistake->name }} </td>
                                </tr>
                                <tr>
                                    <th> Email </th>
                                    <td> {{ $mistake->email }} </td>
                                </tr>
                                <tr>
                                    <th> Phone </th>
                                    <td> {{ $mistake->phone }} </td>
                                </tr>
                                <tr>
                                    <th> Company </th>
                                    <td> {{ $mistake->company->companyName }} </td>
                                </tr>
                                <tr>
                                    <th> Object </th>
                                    <td> {{ $mistake->object }} </td>
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
