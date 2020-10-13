@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $category->title }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/category') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <th> Title </th>
                                    <td> {{ $category->title }} </td>
                                </tr>
                                <tr>
                                    <th> Arabic Title </th>
                                    <td> {{ $category->arabic_title }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td> <img src="{{asset('storage/' . $category->img_url)}}" style="width:300px;"> </td>
                                </tr>
                                <tr>
                                    <th> ALt </th>
                                    <td> {{ $category->alt }} </td>
                                </tr>
                                <tr>
                                    <th> Image title </th>
                                    <td> {{ $category->imageTitle }} </td>
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
