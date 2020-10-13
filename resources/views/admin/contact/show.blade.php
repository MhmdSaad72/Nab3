@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                {{-- <div class="card-header"> {{ $contact->title }}</div> --}}
                <div class="card-body">

                    <a href="{{ route('contact.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $contact->name }} </td>
                                </tr>
                                <tr>
                                    <th> Email </th>
                                    <td> {{ $contact->email }} </td>
                                </tr>
                                <tr>
                                    <th> Phone </th>
                                    <td> {{ $contact->phone }} </td>
                                </tr>
                                <tr>
                                    <th> Created at </th>
                                    <td> {{ $contact->created_at }} </td>
                                </tr>
                                <tr>
                                    <th> Object </th>
                                    <td> {{ $contact->object }} </td>
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
