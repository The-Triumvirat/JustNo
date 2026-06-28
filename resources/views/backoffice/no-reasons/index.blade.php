@section('title')
All Just No Reasons
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<div
  x-data="{ deleteUrl: null, deleteReason: '', deleteTrigger: null }"
  @keydown.escape.window="
    if (deleteUrl) {
      deleteUrl = null;
      $nextTick(() => deleteTrigger?.focus());
    }
  "
  class="space-y-6">

  <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
    <div>
      <h1 class="jn-page-title">All Just No Reasons</h1>
      <nav aria-label="breadcrumb" class="mt-2">
        <ol class="flex items-center gap-2 text-sm text-trium-sub">
          <li>
            <a href="{{ route('backoffice.dashboard') }}" class="transition-colors hover:text-trium-400">
              <i class="bx bx-home-alt"></i>
            </a>
          </li>
          <li class="text-trium-sub/50">/</li>
          <li class="text-trium-sub">All Just No Reasons</li>
        </ol>
      </nav>
    </div>

    <div class="flex flex-wrap gap-3">
      <a href="{{ route('backoffice.no-reasons.export') }}" class="jn-btn-danger">
        Export
      </a>

      <a href="{{ route('backoffice.no-reasons.import.no.reasons') }}" class="jn-btn-secondary">
        Import
      </a>

      <a href="{{ route('backoffice.no-reasons.create') }}" class="jn-btn-primary">
        Add Just No Reason
      </a>
    </div>
  </div>

  <div class="jn-card">
    <div class="jn-card-body">
      <form
        action="{{ route('backoffice.no-reasons.index') }}"
        method="GET"
        class="mb-6 grid gap-4 border-b border-trium-border pb-6 md:grid-cols-2 xl:grid-cols-[minmax(16rem,1fr)_14rem_9rem_auto] xl:items-end">
        <div>
          <label for="search" class="jn-label">Search</label>
          <input
            type="search"
            name="search"
            id="search"
            value="{{ $search }}"
            placeholder="Search reasons"
            class="jn-input">
        </div>

        <div>
          <label for="sort" class="jn-label">Sort by</label>
          <select name="sort" id="sort" class="jn-select">
            <option value="alpha" @selected($sort === 'alpha')>A to Z</option>
            <option value="alpha_desc" @selected($sort === 'alpha_desc')>Z to A</option>
            <option value="newest" @selected($sort === 'newest')>Newest first</option>
            <option value="oldest" @selected($sort === 'oldest')>Oldest first</option>
          </select>
        </div>

        <div>
          <label for="per_page" class="jn-label">Per page</label>
          <select name="per_page" id="per_page" class="jn-select">
            @foreach ([25, 50, 100] as $size)
              <option value="{{ $size }}" @selected($perPage === $size)>{{ $size }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex flex-wrap gap-3">
          <button type="submit" class="jn-btn-primary">
            <i class="bx bx-search" aria-hidden="true"></i>
            Apply
          </button>

          @if ($search !== '' || $sort !== 'oldest' || $perPage !== 25)
            <a href="{{ route('backoffice.no-reasons.index') }}" class="jn-btn-secondary">
              <i class="bx bx-reset" aria-hidden="true"></i>
              Reset
            </a>
          @endif
        </div>
      </form>

      <div class="mb-4 flex flex-wrap items-center justify-between gap-2 text-sm text-trium-sub">
        <p>
          {{ $noReasons->total() }} {{ Str::plural('reason', $noReasons->total()) }} found
        </p>

        @if ($noReasons->total() > 0)
          <p>
            Showing {{ $noReasons->firstItem() }}–{{ $noReasons->lastItem() }}
          </p>
        @endif
      </div>

      <div class="jn-table-wrap">
        <table id="example" class="jn-table">
          <thead>
            <tr>
              <th>Sl</th>
              <th>No Reason</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($noReasons as $key => $item)
            <tr>
              <td>{{ $noReasons->firstItem() + $key }}</td>
              <td>{{ $item->reason }}</td>
              <td>
                <div class="flex flex-wrap gap-2">
                  <a href="{{ route('backoffice.no-reasons.edit', $item->id) }}"
                    class="jn-btn-secondary">
                    Edit
                  </a>

                  <button
                    type="button"
                    class="jn-btn-danger"
                    data-delete-url="{{ route('backoffice.no-reasons.destroy', $item->id) }}"
                    data-delete-reason="{{ $item->reason }}"
                    @click="
                      deleteUrl = $event.currentTarget.dataset.deleteUrl;
                      deleteReason = $event.currentTarget.dataset.deleteReason;
                      deleteTrigger = $event.currentTarget;
                      $nextTick(() => $refs.cancelDelete.focus());
                    ">
                    Delete
                  </button>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="px-6 py-10 text-center italic text-trium-sub">
                No reasons found.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if ($noReasons->hasPages())
        <div class="mt-6 border-t border-trium-border pt-6">
          {{ $noReasons->links() }}
        </div>
      @endif
    </div>
  </div>

  <div
    x-cloak
    x-show="deleteUrl"
    x-transition.opacity
    @click.self="
      deleteUrl = null;
      $nextTick(() => deleteTrigger?.focus());
    "
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 p-4"
    role="presentation">
    <div
      x-show="deleteUrl"
      x-transition
      role="dialog"
      aria-modal="true"
      aria-labelledby="delete-reason-title"
      aria-describedby="delete-reason-description"
      class="w-full max-w-md rounded-lg border border-trium-border bg-trium-bg2 p-6 shadow-2xl">
      <div class="flex items-start gap-4">
        <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-red-500/15 text-red-400">
          <i class="bx bx-trash text-xl" aria-hidden="true"></i>
        </div>

        <div class="min-w-0">
          <h2 id="delete-reason-title" class="jn-section-title">Delete reason?</h2>
          <p id="delete-reason-description" class="mt-2 text-sm text-trium-sub">
            This action cannot be undone.
          </p>
          <p class="mt-3 break-words text-sm font-medium text-trium-text" x-text="deleteReason"></p>
        </div>
      </div>

      <form :action="deleteUrl ?? ''" method="POST" class="mt-6 flex justify-end gap-3">
        @csrf
        @method('DELETE')

        <button
          x-ref="cancelDelete"
          type="button"
          class="jn-btn-secondary"
          @click="
            deleteUrl = null;
            $nextTick(() => deleteTrigger?.focus());
          ">
          Cancel
        </button>
        <button type="submit" class="jn-btn-danger">
          Delete
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
