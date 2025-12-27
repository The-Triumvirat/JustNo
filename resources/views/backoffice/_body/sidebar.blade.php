<div class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{ asset('backoffice/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">Just No</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">

    <li>
      <a href="{{ route('backoffice.dashboard') }}">
        <div class="parent-icon"><i class='bx bx-home-alt'></i>
        </div>
        <div class="menu-title">Dashboard</div>
      </a>
    </li>

    <li>
      <a href="/">
        <div class="parent-icon"><i class='bx bx-first-page'></i>
        </div>
        <div class="menu-title">Zur Homepage</div>
      </a>
    </li>

    <li class="menu-label">Your Backoffice</li>
    <li>
      <a href="{{ route('backoffice.no-reasons.index') }}">
        <div class="parent-icon"><i class='bx bx-block'></i>
        </div>
        <div class="menu-title">No Reasons</div>
      </a>
      <ul>
        <li> <a href="{{ route('backoffice.no-reasons.index') }}"><i class='bx bx-radio-circle'></i>All No Reasons</a>
        </li>
        <li> <a href="{{ route('backoffice.no-reasons.create') }}"><i class='bx bx-radio-circle'></i>Add No Reasons</a>
        </li>
      </ul>
    </li>

    <li class="menu-label">Additional services</li>

    <li>
      <a href="https://themeforest.net/user/codervent" target="_blank">
        <div class="parent-icon"><i class="bx bx-support"></i>
        </div>
        <div class="menu-title">Support</div>
      </a>
    </li>
  </ul>
  <!--end navigation-->
</div>