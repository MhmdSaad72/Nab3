@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Create New Company</div>
                <div class="card-body">
                    <a href="{{ url('/admin/company') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />


                    <form method="POST" action="{{ url('/admin/company') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('admin.company.form', ['formMode' => 'create'])

                        <div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
                            <label for="country_id" class="control-label">* Country</label>
                            <select name="country_id" class="form-control" id="country_id">
                                <option value="" selected disabled>Select country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$country->id == old('country_id') ? 'selected': ''}}>{{$country->title}}</option>
                                @endforeach

                            </select>
                            {!! $errors->first('country_id', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                            <label for="category_id" class="control-label">* Category</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="" selected disabled>Select category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == old('category_id') ? 'selected': ''}}>{{$category->title}}</option>
                                @endforeach

                            </select>
                            {!! $errors->first('category_id', '<p class="help-block text-danger">:message</p>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('degree_id') ? 'has-error' : ''}}">
                            <label for="degree_id" class="control-label">* Degree</label>
                            <select name="degree_id" class="form-control" id="degree_id">
                                <option value="" selected disabled>Select degree</option>
                                @foreach($degrees as $degree)
                                <option value="{{$degree->id}}" {{$degree->id == old('degree_id') ? 'selected': ''}}>{{$degree->title}}</option>
                                @endforeach

                            </select>
                            {!! $errors->first('degree_id', '<p class="help-block text-danger">:message</p>') !!}
                        </div>


                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="{{ 'Create' }}">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
