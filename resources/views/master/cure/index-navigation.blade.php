<nav style='margin-bottom:2mm'>
    
     <ul class="nav nav-pills">

        <li class='{{ strpos(url()->current(), "cure") != null ? "active" : "" }}'>
            <a href="{{ route('cure.index') }}">Obat</a>
        </li>
        <li class='{{ strpos(url()->current(), "bhp") != null ? "active" : "" }}'>
            <a href="{{ route('bhp.index') }}">BHP</a>
        </li>
      </ul> 
  </nav>