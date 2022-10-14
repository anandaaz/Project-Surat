<li class="side-menus {{ (request()->is('/')) ? 'active' : ''}}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li>


<li class="side-menus {{ (request()->is('users*')) ? 'active' : ''}}">
    <a class="nav-link" href="/users">
        <i class=" fas fa-users"></i><span>Users</span>
    </a>
</li>

<li class="side-menus {{ (request()->is('roles*')) ? 'active' : ''}}">
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
</li>

<li class="side-menus {{ (request()->is('departments*')) ? 'active' : ''}}">
    <a class="nav-link" href="/departments">
        <i class=" fas fa-user-lock"></i><span>Departments</span>
    </a>
</li>

<li class="side-menus {{ (request()->is('letter-types*')) ? 'active' : ''}}">
    @role('Admin')
    <a class="nav-link" href="/letter-types">
        <i class=" fas fa-user-lock"></i><span>Jenis Form</span>
    </a>
    @endrole
</li>

<li class="dropdown {{ (request()->is('letters*')) ? 'active' : ''}}" >
    <a href="/" class="nav-link has-dropdown"><i class="fas fa-th"></i><span>Form Masuk</span></a>
    <ul class="dropdown-menu p-1">
        <li class="{{ (request()->is('letters/izin-meninggalkan-pekerjaan*')) ? 'active' : ''}}">
            <hr/>
            <a class="nav-link" href="{{ route('letters.izin-meninggalkan-pekerjaan.index') }}">
            Izin Meninggalkan Pekerjaan
            </a>
            <hr/>
        </li>
        <li class="{{ (request()->is('letters/cuti*')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('letters.cuti.index') }}">
            Cuti/Izin Khusus
            </a>
         <hr/>
        </li>
        <li class="{{ (request()->is('letters/pertukaran-hari-kerja*')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('letters.pertukaran-hari-kerja.index') }}">
                Pertukaran Hari Kerja
            </a>
         <hr/>
        </li>
        <li class="{{ (request()->is('letters/permohonan-saldo-cuti-pengganti*')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('letters.permohonan-saldo-cuti-pengganti.index') }}">
            Permohonan Saldo Cuti Pengganti
            </a>
         <hr/>
        </li>

        <li class="{{ (request()->is('letters/penyimpangan-kehadiran*')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('letters.penyimpangan-kehadiran.index') }}">
            Penyimpangan Kehadiran
            </a>
         <hr/>
        </li>
        <li class="{{ (request()->is('letters/perintah-kerja-lembur*')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('letters.perintah-kerja-lembur.index') }}">
            Perintah Kerja Lembur
            </a>
        </li>
    </ul>
</li>

<li class="side-menus {{ (request()->is('reports*')) ? 'active' : ''}}" >
    <a class="nav-link" href="{{ route('reports.filter', [0,0]) }}">
        <i class=" fas fa-user-lock"></i><span>Reports</span>
    </a>
</li>
