@section('title')
Add Just No Reasons
@endsection

@extends('backoffice.backoffice')
@section('backofficepage')
<script src="{{ asset('backoffice/custom/js/jquery364.min.js') }}"></script>

<div class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="{{ route('backoffice.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item"><a href="{{ route('backoffice.no-reasons.index') }}">All Just No Reasons</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Just No Reasons</li>
        </ol>
      </nav>
    </div>

  </div>
  <!--end breadcrumb-->

  <div class="card">
    <div class="card-body p-4">
      <h5 class="mb-4">Import Just No Reasons</h5>
      <form class="row g-3" action="#" method="post" enctype="multipart/form-data">
                @csrf

                <div class="col-md-6">
                  <label for="input1" class="form-label">JSON File Import</label>
                  <input type="file" name="import_file" class="form-control">
                </div>

                <div class="col-md-12">
                  <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Upload</button>

                  </div>
                </div>
        </form>
    </div>
  </div>
</div>


@endsection
