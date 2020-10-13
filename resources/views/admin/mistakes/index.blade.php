@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form method="GET" action="{{ route('mistake.index') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mistakes as $item)
                                  @if (in_array($item->company_id , $companies_id))
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->company->companyName }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{ url('/admin/mistake/' . $item->id) }}" title="View Mistake"><button class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @if ($item->status != 1 && $item->cancel != 1)
                                              <form method="POST" action="{{ route('mistake.approved' , $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-info btn-sm" title="Approved Mistake" onclick="return confirm(&quot;Confirm approved?&quot;)"> Solve</button>
                                              </form>
                                              <form method="POST" action="{{ route('mistake.cancel' , $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-warning btn-sm" title="Cancel Mistake" onclick="return confirm(&quot;Confirm Cancel?&quot;)"> Cancel</button>
                                              </form>
                                            @else
                                                @if ($item->cancel == 1)
                                                  <strong class="text-warning">Cancelled</strong>
                                                @elseif ($item->status == 1)
                                                  <strong class="text-info">Solved</strong>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                  @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $mistakes->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
