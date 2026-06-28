<form action="{{ $action }}" method="POST" class="space-y-6">
  @csrf

  @if ($method)
    @method($method)
  @endif

  <div class="max-w-2xl">
    <label for="reason" class="jn-label">Just No Reason</label>
    <input
      type="text"
      name="reason"
      id="reason"
      value="{{ old('reason', $noReason?->reason) }}"
      required
      maxlength="512"
      class="jn-input @error('reason') border-red-500 focus:border-red-500 focus:ring-red-500/30 @enderror">

    @error('reason')
      <span class="mt-2 block text-sm text-red-400">{{ $message }}</span>
    @enderror
  </div>

  <div class="flex flex-wrap items-center gap-3">
    <button type="submit" class="jn-btn-primary">
      {{ $submitLabel }}
    </button>

    <a href="{{ route('backoffice.no-reasons.index') }}" class="jn-btn-secondary">
      Cancel
    </a>
  </div>
</form>
