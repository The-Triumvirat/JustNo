@section('title')
{{ $profileData->name }} User Profile
@endsection

@extends('backoffice.backoffice')
@section('backofficepage')
<div class="page-content">
  <script src="{{ asset('backoffice/custom/js/jquery364.min.js') }}"></script>
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User Profile</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="{{ route('backoffice.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $profileData->name }} User Profile</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--end breadcrumb-->
  <div class="container">
    <div class="main-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="{{ (!empty($profileData->photo)) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                <div class="mt-3">
                  <h4>{{ $profileData->name }}</h4>
                  <p class="text-secondary mb-1">{{ $profileData->email }}</p>
                </div>
              </div>

              <hr class="my-4" />
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card">
            <form action="{{ route('backoffice.profile.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0"> Name</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="text" name="name" class="form-control" value="{{ $profileData->name }}" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="email" name="email" class="form-control" value="{{ $profileData->email }}" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Phone</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="text" name="phone" class="form-control" value="{{ $profileData->phone }}" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Address </h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="text" name="address" class="form-control" value="{{ $profileData->address }}" />
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Photo </h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input class="form-control" name="photo" type="file" id="image">
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-3">
                    <h6 class="mb-0"> </h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <img id="showImage" src="{{ (!empty($profileData->photo)) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9 text-secondary">
                    <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                  </div>
                </div>
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#image').change(function(e) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#showImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });
</script>
@endsection