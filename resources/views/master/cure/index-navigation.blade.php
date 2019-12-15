<nav style='margin-bottom:2mm'>
    
     <ul class="nav nav-pills">

        <li class='{{ strpos(url()->current(), "cure") != null ? "active" : "" }}'>
            <a href="{{ route('cure.index') }}">Obat</a>
        </li>
      </ul> 
  </nav>