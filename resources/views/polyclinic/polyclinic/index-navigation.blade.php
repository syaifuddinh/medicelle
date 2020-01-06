<nav style='margin-bottom:2mm'>
            
     <ul class="nav nav-pills">
        <li class="{{ strpos(url()->current(), 'history') == null ? 'active' : '' }}">
          <a href="{{ route( $flag . '.index') }}">Daftar Pasien</a>
        </li>
        <li class="{{ strpos(url()->current(), 'history') != null ? 'active' : '' }}">
          <a href="{{ route( $flag . '.history') }}">Riwayat Pasien</a>
        </li>
      </ul> 
  </nav>