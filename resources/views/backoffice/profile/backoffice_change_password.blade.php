@section('title')
{{ $profileData->name }} Change Password
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<div class="space-y-6">
  <div>
    <h1 class="jn-page-title">{{ $profileData->name }} Change Password</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="flex items-center gap-2 text-sm text-trium-sub">
        <li>
          <a href="{{ route('backoffice.dashboard') }}" class="transition-colors hover:text-trium-400">
            <i class="bx bx-home-alt"></i>
          </a>
        </li>
        <li class="text-trium-sub/50">/</li>
        <li class="text-trium-sub">{{ $profileData->name }} Change Password</li>
      </ol>
    </nav>
  </div>

  <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="lg:col-span-1">
      <div class="jn-card h-full">
        <div class="jn-card-body flex flex-col items-center pt-8 text-center">
          <img
            src="{{ !empty($profileData->photo) ? url('upload/profile_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
            alt="Profile photo"
            class="h-28 w-28 rounded-full border-4 border-trium-400/20 object-cover">

          <div class="mt-4">
            <h2 class="text-xl font-semibold text-trium-text">{{ $profileData->name }}</h2>

            @if(!empty($profileData->username))
            <p class="mt-1 text-sm text-trium-sub">{{ $profileData->username }}</p>
            @endif

            <p class="mt-1 text-sm text-trium-sub">{{ $profileData->email }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="lg:col-span-2">
      <div class="jn-card h-full">
        <div class="jn-card-body">
          <h2 class="mb-6 jn-section-title">Change Password</h2>

          <form action="{{ route('backoffice.password.update') }}" method="post" class="space-y-5">
            @csrf

            <div>
              <label for="old_password" class="jn-label">Old Password</label>
              <input
                type="password"
                name="old_password"
                id="old_password"
                class="jn-input @error('old_password') border-red-500 focus:border-red-500 focus:ring-red-500/30 @enderror">
              @error('old_password')
              <span class="mt-2 block text-sm text-red-400">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label for="new_password" class="jn-label">New Password</label>
              <input
                type="password"
                name="new_password"
                id="new_password"
                class="jn-input @error('new_password') border-red-500 focus:border-red-500 focus:ring-red-500/30 @enderror">
              @error('new_password')
              <span class="mt-2 block text-sm text-red-400">{{ $message }}</span>
              @enderror
            </div>

            <div>
              <label for="new_password_confirmation" class="jn-label">Confirm New Password</label>
              <input
                type="password"
                name="new_password_confirmation"
                id="new_password_confirmation"
                class="jn-input">
            </div>

            <div class="flex flex-wrap items-center gap-3">
              <button type="submit" class="jn-btn-primary">
                Save Changes
              </button>

              <a href="{{ route('backoffice.profile') }}" class="jn-btn-secondary">
                Cancel
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection