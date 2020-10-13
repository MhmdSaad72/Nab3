@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit {{ $company->companyName }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/company') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />


                        <form method="POST" action="{{ url('/admin/company/' . $company->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.company.form', ['formMode' => 'edit'])

                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                                <label for="category_id" class="control-label">* Category</label>
                                <select name="category_id" class="form-control" id="category_id" >
                                  <option value="" selected disabled>Select category</option>
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}"{{$category->id == $company->category_id ? 'selected': ''}}>{{$category->title}}</option>
                                  @endforeach

                            </select>
                                {!! $errors->first('category_id', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('degree_id') ? 'has-error' : ''}}">
                                <label for="degree_id" class="control-label">* Degree</label>
                                <select name="degree_id" class="form-control" id="degree_id" >
                                  <option value="" selected disabled>Select degree</option>
                                  @foreach($degrees as $degree)
                                    <option value="{{$degree->id}}"{{$degree->id == $company->degree_id ? 'selected': ''}}>{{$degree->title}}</option>
                                  @endforeach

                            </select>
                                {!! $errors->first('degree_id', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
                                <label for="country_id" class="control-label">* Country</label>
                                <select name="country_id" class="form-control" id="country_id" >
                                  <option value="" selected disabled>Select country</option>
                                  @foreach($countries as $country)
                                    <option value="{{$country->id}}"{{$country->id == $company->country_id ? 'selected': ''}}>{{$country->title}}</option>
                                  @endforeach

                            </select>
                                {!! $errors->first('country_id', '<p class="help-block text-danger">:message</p>') !!}
                            </div>

                            <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                <label for="status" class="control-label">{{ 'Status' }}</label>
                                <div class="radio">
                                <label><input name="status" type="radio" value="1" @if(isset($company) && $company->getStatusAttribute(1) == $company->status) checked @endif> Yes</label>
                            </div>
                            <div class="radio">
                                <label><input name="status" type="radio" value="0" @if(isset($company) && $company->getStatusAttribute(0) == $company->status) checked @endif> No</label>
                            </div>
                                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="form-group {{ $errors->has('featured') ? 'has-error' : ''}}">
                                <label for="featured" class="control-label">{{ 'Featured' }}</label>
                                <div class="radio">
                                <label><input name="featured" type="radio" value="1" @if(isset($company) && $company->getFeaturedAttribute(1) == $company->featured) checked @endif> Yes</label>
                            </div>
                            <div class="radio">
                                <label><input name="featured" type="radio" value="0" @if(isset($company) && $company->getFeaturedAttribute(0) == $company->featured) checked @endif> No</label>
                            </div>
                                {!! $errors->first('featured', '<p class="help-block">:message</p>') !!}
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="{{ 'Update'  }}">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
