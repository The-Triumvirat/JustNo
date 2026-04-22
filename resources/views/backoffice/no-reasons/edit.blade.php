@section('title')
Edit Just No Reasons
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<script src="{{ asset('backoffice/custom/js/jquery364.min.js') }}"></script>

<div class="space-y-6">

  <div>
    <h1 class="jn-page-title">Edit Just No Reasons</h1>
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
        <li class="text-trium-sub">Edit Just No Reasons</li>
      </ol>
    </nav>
  </div>

  <div class="jn-card">
    <div class="jn-card-body">
      <h2 class="mb-6 jn-section-title">Edit Just No Reasons</h2>

      <form
        id="myForm"
        action="{{ route('backoffice.no-reasons.update', $noReason->id) }}"
        method="post"
        class="space-y-6">
        @csrf

        <input type="hidden" name="id" value="{{ $noReason->id }}">

        <div class="max-w-2xl">
          <label for="reason" class="jn-label">Just No Reason</label>
          <input
            type="text"
            name="reason"
            id="reason"
            value="{{ old('reason', $noReason->reason) }}"
            class="jn-input @error('reason') border-red-500 focus:border-red-500 focus:ring-red-500/30 @enderror">

          @error('reason')
          <span class="mt-2 block text-sm text-red-400">{{ $message }}</span>
          @enderror
        </div>

        <div class="flex flex-wrap items-center gap-3">
          <button type="submit" class="jn-btn-primary">
            Save Changes
          </button>

          <a href="{{ route('backoffice.no-reasons.index') }}" class="jn-btn-secondary">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#myForm').validate({
      rules: {
        reason: {
          required: true,
        },
      },
      messages: {
        reason: {
          required: 'Please Enter Just No Reason',
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('mt-2 block text-sm text-red-400');
        element.closest('div').append(error);
      },
      highlight: function(element) {
        $(element).addClass('border-red-500 focus:border-red-500 focus:ring-red-500/30');
      },
      unhighlight: function(element) {
        $(element).removeClass('border-red-500 focus:border-red-500 focus:ring-red-500/30');
      },
    });
  });
</script>
@endsection