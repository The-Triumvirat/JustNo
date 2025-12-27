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
              <p class="mb-0 text-secondary">Total Orders</p>
              <h4 class="my-1 text-info">10</h4>
              <p class="mb-0 font-13">+2.5% from last week</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
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
              <p class="mb-0 text-secondary">Total Revenue</p>
              <h4 class="my-1 text-danger">10</h4>
              <p class="mb-0 font-13">+5.4% from last week</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
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
              <p class="mb-0 text-secondary">Pending Orders</p>
              <h4 class="my-1 text-success">10</h4>
              <p class="mb-0 font-13">-4.5% from last week</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2'></i>
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
              <p class="mb-0 text-secondary">Total Customers</p>
              <h4 class="my-1 text-warning">8.4K</h4>
              <p class="mb-0 font-13">+8.4% from last week</p>
            </div>
            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--end row-->

  <div class="row">
    <div class="col-12 col-lg-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <div>
              <h6 class="mb-0">Sales Overview</h6>
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
          <div class="d-flex align-items-center ms-auto font-13 gap-2 mb-3">
            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Sales</span>
            <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Visits</span>
          </div>
          <div class="chart-container-1">
            <canvas id="chart1"></canvas>
          </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">24.15M</h5>
              <small class="mb-0">Overall Visitor <span> <i class="bx bx-up-arrow-alt align-middle"></i> 2.43%</span></small>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">12:38</h5>
              <small class="mb-0">Visitor Duration <span> <i class="bx bx-up-arrow-alt align-middle"></i> 12.65%</span></small>
            </div>
          </div>
          <div class="col">
            <div class="p-3">
              <h5 class="mb-0">639.82</h5>
              <small class="mb-0">Pages/Visit <span> <i class="bx bx-up-arrow-alt align-middle"></i> 5.62%</span></small>
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