@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $company->companyName }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/company') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Company Name </th>
                                    <td> {{ $company->companyName }} </td>
                                </tr>
                                <tr>
                                    <th> Telephone </th>
                                    <td> {{ $company->telephone }} </td>
                                </tr>
                                @if ($company->telephone2)
                                  <tr>
                                    <th> Telephone 2 </th>
                                    <td> {{ $company->telephone2 }} </td>
                                  </tr>
                                @endif
                                @if ($company->telephone3)
                                  <tr>
                                    <th> Telephone 3 </th>
                                    <td> {{ $company->telephone3 }} </td>
                                  </tr>
                                @endif
                                @if ($company->fax)
                                  <tr>
                                    <th> Fax </th>
                                    <td> {{ $company->fax }} </td>
                                  </tr>
                                @endif
                                @if ($company->zip)
                                  <tr>
                                    <th> Zip </th>
                                    <td> {{ $company->zip }} </td>
                                  </tr>
                                @endif
                                @if ($company->postBox)
                                  <tr>
                                    <th> Post Box </th>
                                    <td> {{ $company->postBox }} </td>
                                  </tr>
                                @endif
                                <tr>
                                    <th> City </th>
                                    <td> {{ $company->city }} </td>
                                </tr>
                                <tr>
                                    <th> Location </th>
                                    <td> {{ $company->location }} </td>
                                </tr>
                                <tr>
                                    <th> Street </th>
                                    <td> {{ $company->street }} </td>
                                </tr>
                                @if ($company->url )
                                  <tr>
                                    <th> Url </th>
                                    <td> {{ $company->url }} </td>
                                  </tr>
                                @endif
                                <tr>
                                    <th> Career </th>
                                    <td> {{ $company->career }} </td>
                                </tr>
                                <tr>
                                    <th> Email </th>
                                    <td> {{ $company->email }} </td>
                                </tr>
                                @if ($company->logo_path)
                                  <tr>
                                    <th> Logo path </th>
                                    <td> <img src="{{asset('storage/' . $company->logo_path)}}" > </td>
                                  </tr>
                                @endif
                                @if ($company->bio)
                                  <tr>
                                    <th> Bio </th>
                                    <td> {{ $company->bio }} </td>
                                  </tr>
                                @endif
                                @if ($company->pageView)
                                  <tr>
                                    <th> Page view </th>
                                    <td> {{ $company->pageView  }} </td>
                                  </tr>
                                @endif
                                @if ($company->fb)
                                  <tr>
                                    <th> fb </th>
                                    <td> {{ $company->fb }} </td>
                                  </tr>
                                @endif
                                @if ($company->linkedin)
                                  <tr>
                                    <th> linkedin </th>
                                    <td> {{ $company->linkedin }} </td>
                                  </tr>
                                @endif
                                @if ($company->twitter)
                                  <tr>
                                    <th> Twitter </th>
                                    <td> {{ $company->twitter }} </td>
                                  </tr>
                                @endif
                                @if ($company->insta)
                                  <tr>
                                    <th> Insta </th>
                                    <td> {{ $company->insta }} </td>
                                  </tr>
                                @endif
                                <tr>
                                    <th> Status </th>
                                    <td> {{ $company->status }} </td>
                                </tr>
                                <tr>
                                    <th> Featured </th>
                                    <td> {{ $company->featured }} </td>
                                </tr>
                                <tr>
                                    <th> Country </th>
                                    <td> {{ $company->country->title }} </td>
                                </tr>
                                <tr>
                                    <th> Category </th>
                                    <td> {{ $company->category->title }} </td>
                                </tr>
                                <tr>
                                    <th> Degree </th>
                                    <td> {{ $company->degree->title }} </td>
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
