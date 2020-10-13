@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('/admin/company/create') }}" class="btn btn-success btn-sm" title="Add New Company">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <form method="GET" action="{{ url('/admin/company') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>

                    <br />
                    <br />
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Telephone</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Page view</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($company as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->companyName }}</td>
                                    <td>{{ $item->telephone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->pageView ?? 0 }}</td>
                                    <td>
                                        <a href="{{ url('/admin/company/' . $item->id) }}" title="View Company"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/admin/company/' . $item->id . '/edit') }}" title="Edit Company"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        @if ($item->status != $item->getStatusAttribute(1))
                                          <form method="POST" action="{{ route('company.approved' , $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-secondary btn-sm" title="Approved Company" onclick="return confirm(&quot;Confirm approved?&quot;)"> Approve</button>
                                          </form>
                                        @endif
                                        <form method="POST" action="{{ url('/admin/company' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Company" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $company->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
