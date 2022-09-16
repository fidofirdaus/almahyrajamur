<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url(/assets/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            {{-- <div class="profile-img"> <img src="{{ asset('assets/images/users/2.jpg') }}" alt="user" /> </div> --}}
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name }}<span class="caret"></span></a>
                <div class="dropdown-menu animated flipInY">
                    {{-- <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a> --}}
                    <div class="dropdown-divider"></div> 
                    {{-- <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> --}}
                    <a href="{{ route('logout') }}" class="dropdown-item" 
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>
                            {{ __('Logout') }}
                    </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">FITUR</li>
                <li>
                    <a href="{{ URL('/admin') }}" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                @if (Auth::user()->role == 'Pengepul')
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-bar-chart-o"></i><span class="hide-menu">Data Panen</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/panen') }}">Data Harian</a></li>
                        <li><a href="{{ URL('/panenKeseluruhan') }}">Data Keseluruhan</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Data Penjualan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/penjualanHarian') }}">Data Harian</a></li>
                        <li><a href="{{ URL('/penjualanKeseluruhan') }}">Data Keseluruhan</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu">Data Pengeluaran</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/pengeluaranHarian') }}">Data Harian</a></li>
                        <li><a href="{{ URL('/pengeluaranKeseluruhan') }}">Data Keseluruhan</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Laporan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/laporanPembelian') }}">Pembelian/Kulak </a></li>
                        {{-- <li><a href="index2.html">Penjualan Keseluruhan</a></li>
                        <li><a href="index2.html">Laporan Keuntungan</a></li> --}}
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Data Pengguna</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/petani') }}">Data Petani</a></li>
                        <li><a href="{{ URL('/pembeli') }}">Data Pembeli</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-line-chart"></i><span class="hide-menu">Data Harga</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/hargaBeli') }}">Harga Beli</a></li>
                        <li><a href="{{ URL('/hargaJual') }}">Harga Jual</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu">Data Rekap</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ URL('/indexRekapPanen') }}">Rekap Panen Petani</a></li>
                    </ul>
                </li>
                @else
                <li>
                    <a href="{{ URL('/panen') }}" aria-expanded="false"><i class="fa fa-bar-chart-o"></i><span class="hide-menu">Data Panen</span></a>
                </li>
                @endif
                @if (Auth::user()->role == 'admin')
                {{-- <li>
                    <a href="{{ route('tiket.form') }}" aria-expanded="false"><i class="fa fa-bar-chart-o"></i><span class="hide-menu">Laporan Penjualan</span></a>
                </li>
                <li>
                    <a href="{{ route('tiket.formApprove') }}" aria-expanded="false"><i class="fa fa-check"></i><span class="hide-menu">Verifikasi Laporan</span></a>
                </li>
                <li>
                    <a href="{{ route('penutupan.index') }}" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Laporan Penutupan</span></a>
                </li> --}}
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <a href="{{ route('logout') }}" class="link" data-toggle="tooltip" title="Logout" 
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="mdi mdi-power"></i>
        </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
    </div>
    <!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->