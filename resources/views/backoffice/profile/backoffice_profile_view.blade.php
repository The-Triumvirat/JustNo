@section('title')
{{ $profileData->name }} User Profile
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<div class="space-y-6">
  <div>
    <h1 class="jn-page-title">{{ $profileData->name }} User Profile</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="flex items-center gap-2 text-sm text-trium-sub">
        <li>
          <a href="{{ route('backoffice.dashboard') }}" class="transition-colors hover:text-trium-400">
            <i class="bx bx-home-alt"></i>
          </a>
        </li>
        <li class="text-trium-sub/50">/</li>
        <li class="text-trium-sub">{{ $profileData->name }} User Profile</li>
      </ol>
    </nav>
  </div>

  <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-1">
      <div class="jn-card h-full">
        <div class="jn-card-body">
          <div class="flex flex-col items-center text-center">
            <img
              src="{{ !empty($profileData->photo) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
              alt="Profile photo"
              class="h-28 w-28 rounded-full border-4 border-trium-400/20 object-cover">
            <div class="mt-4">
              <h2 class="text-xl font-semibold text-trium-text">{{ $profileData->name }}</h2>
              <p class="mt-1 text-sm text-trium-sub">{{ $profileData->email }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="lg:col-span-2">
      <div class="jn-card h-full">
        <div class="jn-card-body">
          <form action="{{ route('backoffice.profile.store') }}" method="post" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
              <label class="jn-label" for="name">Name</label>
              <input type="text" id="name" name="name" class="jn-input" value="{{ old('name', $profileData->name) }}">
            </div>

            <div>
              <label class="jn-label" for="email">Email</label>
              <input type="email" id="email" name="email" class="jn-input" value="{{ old('email', $profileData->email) }}">
            </div>

            <div>
              <label class="jn-label" for="phone">Phone</label>
              <input type="text" id="phone" name="phone" class="jn-input" value="{{ old('phone', $profileData->phone) }}">
            </div>

            <div>
              <label class="jn-label" for="address">Address</label>
              <input type="text" id="address" name="address" class="jn-input" value="{{ old('address', $profileData->address) }}">
            </div>

            <div>
              <label class="jn-label" for="image">Photo</label>
              <input
                id="image"
                name="photo"
                type="file"
                class="jn-input file:mr-4 file:rounded-md file:border-0 file:bg-trium-400/10 file:px-3 file:py-2 file:text-sm file:font-medium file:text-trium-400 hover:file:bg-trium-400/20">
            </div>

            <div>
              <p class="jn-label">Preview</p>
              <img
                id="showImage"
                src="{{ !empty($profileData->photo) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                alt="Preview"
                class="h-20 w-20 rounded-full border-4 border-trium-400/20 object-cover">
            </div>

            <div class="flex gap-3">
              <button type="submit" class="jn-btn-primary">Save Changes</button>
              <a href="{{ route('backoffice.dashboard') }}" class="jn-btn-secondary">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('image')?.addEventListener('change', function(event) {
    const file = event.target.files?.[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('showImage').src = e.target.result;
    };
    reader.readAsDataURL(file);
  });
</script>
@endsection