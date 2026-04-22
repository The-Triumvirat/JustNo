@section('title')
Import Just No Reasons
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<div class="space-y-6">

  <div>
    <h1 class="jn-page-title">Import Just No Reasons</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="flex items-center gap-2 text-sm text-trium-sub">
        <li>
          <a href="{{ route('backoffice.dashboard') }}" class="transition-colors hover:text-trium-400">
            <i class="bx bx-home-alt"></i>
          </a>
        </li>
        <li class="text-trium-sub/50">/</li>
        <li>
          <a href="{{ route('backoffice.no-reasons.index') }}" class="transition-colors hover:text-trium-400">
            All Just No Reasons
          </a>
        </li>
        <li class="text-trium-sub/50">/</li>
        <li class="text-trium-sub">Import Just No Reasons</li>
      </ol>
    </nav>
  </div>

  <div class="jn-card">
    <div class="jn-card-body">
      <h2 class="mb-6 jn-section-title">Import Just No Reasons</h2>

      <form
        action="{{ route('backoffice.no-reasons.import.store') }}"
        method="post"
        enctype="multipart/form-data"
        class="space-y-6">
        @csrf

        <div class="max-w-2xl">
          <label for="file" class="jn-label">JSON File Import</label>
          <input
            type="file"
            name="file"
            id="file"
            class="jn-input file:mr-4 file:rounded-md file:border-0 file:bg-trium-400/10 file:px-3 file:py-2 file:text-sm file:font-medium file:text-trium-400 hover:file:bg-trium-400/20">

          @error('file')
          <span class="mt-2 block text-sm text-red-400">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex flex-wrap items-center gap-3">
          <button type="submit" class="jn-btn-primary">
            Upload
          </button>

          <a href="{{ route('backoffice.no-reasons.index') }}" class="jn-btn-secondary">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection