@section('title')
All Just No Reasons
@endsection

@extends('backoffice.backoffice')
@section('backofficepage')

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="{{ route('backoffice.dashboard') }}"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">All Just No Reasons</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <div class="btn-group">
        <a href="{{ route('backoffice.no-reasons.create') }}" class="btn btn-primary px-5">Add Just No Reasons </a>
      </div>
    </div>
    
  </div>
  <!--end breadcrumb-->

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>Sl</th>
              <th>No Reason</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($noReasons as $key=> $item)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ $item->reason }}</td>
              <td>
                <a href="{{ route('backoffice.no-reasons.edit',$item->id) }}" class="btn btn-info px-5">Edit </a>
                <a href="{{ route('backoffice.no-reasons.destroy',$item->id) }}" class="btn btn-danger px-5" id="delete">Delete </a>
              </td>
            </tr>
            @endforeach

          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

@endsection