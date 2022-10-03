<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
   
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
   
    
    <a class="nav-link" href="/users">
        <i class=" fas fa-users"></i><span>Users</span>
    </a>
    
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>

    <a class="nav-link" href="/departments">
        <i class=" fas fa-user-lock"></i><span>Departments</span>
    </a>

    @role('Admin')
    <a class="nav-link" href="/letter-types">
        <i class=" fas fa-user-lock"></i><span>Letter Category</span>
    </a>
    @endrole

     <a class="nav-link" href="/letters">
        <i class=" fas fa-user-lock"></i><span>Letters</span>
    </a>

     <a class="nav-link" href="/reports">
        <i class=" fas fa-user-lock"></i><span>Reports</span>
    </a>
    
</li>
