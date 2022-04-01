<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item @if (Request::segment(1) == '') active @endif">
      <a class="nav-link active" href="{{ route('dashboard.index') }}">
        <i class="ti-home mr-3 mb-1"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'pasien') active @endif">
      <a class="nav-link" href="{{ route('pasien.index') }}">
        <i class="ti-car mr-3 mb-1"></i>
        <span class="menu-title">Pasien</span>
      </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'dokter') active @endif">
      <a class="nav-link" href="{{ route('dokter.index') }}">
        <i class="ti-info-alt mr-3 mb-1"></i>
        <span class="menu-title">Dokter</span>
      </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'poliklinik') active @endif">
      <a class="nav-link" href="{{ route('poliklinik.index') }}">
        <i class="ti-user mr-3 mb-1"></i>
        <span class="menu-title">Poliklinik</span>
      </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'obat') active @endif">
      <a class="nav-link" href="{{ route('obat.index') }}">
        <i class="ti-receipt mr-3 mb-1"></i>
        <span class="menu-title">Obat</span>
      </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'kartu') active @endif">
      <a class="nav-link" href="{{ route('kartu.index') }}">
        <i class="ti-receipt mr-3 mb-1"></i>
        <span class="menu-title">Kartu Pasien</span>
      </a>
    </li>
    <li class="nav-item @if (Request::segment(1) == 'rekam_medis') active @endif">
      <a class="nav-link" href="{{ route('rekam_medis.index') }}">
        <i class="ti-receipt mr-3 mb-1"></i>
        <span class="menu-title">Rekam Medis</span>
      </a>
    </li>
  </ul>
</nav>
