@section('title')
Backoffice Dashboard
@endsection

@extends('backoffice.backoffice')
@section('backofficepage')

<div class="page-content">
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-info">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Total Nos</p>
              <h4 class="my-1 text-info">{{ $totalNos }}</h4>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bx-block'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-danger">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Nos Today</p>
              <h4 class="my-1 text-danger">{{ $nosToday }}</h4>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-calendar-check'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-success">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Database</p>
              <h4 class="my-1 {{ $dbOk ? 'text-success' : 'text-danger' }}">
                {{ $dbOk ? 'OK (' . $dbMs . ' ms)' : 'DOWN' }}
              </h4>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-data'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-warning">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Queue Status</p>
              <h4 class="my-1 text-warning">{{ $queueStatus }}</h4>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-add-to-queue'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--end row-->

  <div class="card radius-10">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <div>
          <h6 class="mb-0">Recent Orders</h6>
        </div>
        <div class="dropdown ms-auto">
          <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="javascript:;">Action</a>
            </li>
            <li><a class="dropdown-item" href="javascript:;">Another action</a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
            <th>Course</th>
              <th>Course ID</th>
              <th>Course Price</th>
              <th>Total Price</th>
              <th>Payment type</th>
              <th>Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

            

          </tbody>
        </table>
      </div>
    </div>
  </div>



</div>

@endsection