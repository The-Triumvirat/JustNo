@section('title')
Edit Just No Reasons
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
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

      @include('backoffice.no-reasons.partials.form', [
        'action' => route('backoffice.no-reasons.update', $noReason),
        'method' => 'PATCH',
        'noReason' => $noReason,
        'submitLabel' => 'Save Changes',
      ])
    </div>
  </div>
</div>
@endsection
