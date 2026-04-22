@section('title')
All Just No Reasons
@endsection

@extends('backoffice.backoffice')

@section('backofficepage')
<div class="space-y-6">

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
              <td>{{ $key + 1 }}</td>
              <td>{{ $item->reason }}</td>
              <td>
                <div class="flex flex-wrap gap-2">
                  <a href="{{ route('backoffice.no-reasons.edit', $item->id) }}"
                    class="jn-btn-secondary">
                    Edit
                  </a>

                  <a href="{{ route('backoffice.no-reasons.destroy', $item->id) }}"
                    class="jn-btn-danger"
                    id="delete">
                    Delete
                  </a>
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
    </div>
  </div>
</div>
@endsection