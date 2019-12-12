<nav style='margin-bottom:2mm'>
            
     <ul class="nav nav-pills">
        <li class="{{ route('polyclinic.index') == url()->current() ? 'active' : '' }}">
          <a href="{{ route('polyclinic.index') }}">Daftar Pasien</a>
        </li>
        <li class="{{ route('polyclinic.history') == url()->current() ? 'active' : '' }}">
          <a href="{{ route('polyclinic.history') }}">Riwayat Pasien</a>
        </li>
      </ul> 
  </nav>