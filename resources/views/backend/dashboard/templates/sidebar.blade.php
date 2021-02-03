<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{Session::get('nama_akun')}}</span>
            <span class="text-secondary text-small">
                @if(Session::get('level') == 'Admin')
                    Pengurus Pusat
                @elseif(Session::get('level') == 'DPC')
                    Korwil
                @elseif(Session::get('level') == 'PAC')
                    Korcam
                @endif
            </span>
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('dashboard')}}">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      @if(Session::has('level') && Session::get('level') == 'Super Admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#menu-setting-halaman" aria-expanded="false" aria-controls="menu-setting-halaman">
          <span class="menu-title">Setting Halaman</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-settings-box menu-icon"></i>
        </a>
        <div class="collapse" id="menu-setting-halaman">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('setting-pages/web-profile')}}">Edit Home</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('setting-pages/banner')}}">Banner</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('setting-pages/galeri')}}">Galeri</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('setting-pages/berita')}}">Berita</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('setting-pages/web-profile/informasi-web')}}">Informasi Web</a></li>
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{url('anggota')}}">
          <span class="menu-title">Anggota</span>
          <i class="mdi mdi-account-multiple menu-icon"></i>
        </a>
      </li>
      @if(Session::has('level') && Session::get('level') == 'Super Admin')
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#pengurus" aria-expanded="false" aria-controls="pengurus">
          <span class="menu-title">Pengurus</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-worker menu-icon"></i>
        </a>
        <div class="collapse" id="pengurus">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('pengurus/dpp')}}">Pengurus Pusat</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('pengurus/dpc')}}">Korwil</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('pengurus/pac')}}">Korcam</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#akun" aria-expanded="false" aria-controls="akun">
          <span class="menu-title">Akun</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
        <div class="collapse" id="akun">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('dpp')}}">Pengurus Pusat</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('dpc')}}">Korwil</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('pac')}}">Korcam</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
          <span class="menu-title">Setting</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-settings menu-icon"></i>
        </a>
        <div class="collapse" id="settings">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('jabatan')}}">Divisi</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('sub-jabatan')}}">Jabatan</a></li>
          </ul>
        </div>
      </li>
      @endif
    </ul>
  </nav>