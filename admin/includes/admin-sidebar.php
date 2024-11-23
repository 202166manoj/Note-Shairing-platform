<nav>
        <ul class="metismenu" id="menu">
        <li class="<?php if($page=='dashboard') {echo 'active';} ?>"><a href="dashboard.php"><i class="ti-home"></i> <span>Dashboard</span></a></li>

        <li class="<?php if($page=='manage-admin') {echo 'active';} ?>"><a href="manage-admin.php"><i class="fa fa-lock"></i> <span>Manage Admin</span></a></li>

        <li class="<?php if($page=='user') {echo 'active';} ?>"><a href="users.php"><i class="ti-user"></i><span>User Section</span></a></li>
        
        <li class="<?php if($page=='subject') {echo 'active';} ?>"><a href="subjects.php"><i class="ti-book"></i> <span>Subject Section</span></a></li>
        
        <li class="<?php if($page=='manage-notes') {echo 'active';} ?>">
            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-briefcase"></i><span>Notes</span></a>
            <ul class="collapse">
                <li ><a href="cmis.php"><i class=""></i> CMIS</a></li>
                <li ><a href="eltn.php"><i class=""></i> ELTN</a></li>
                <li ><a href="imgt.php"><i class=""></i> IMGT</a></li>
                <li ><a href="math.php"><i class=""></i> MATH & STAT</a></li>
            </ul>
        </li> 

        
                            
    </ul>

    <ul class="metismenu" id="logout-menu">
        <li>
            <a href="logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a>
        </li>
    </ul>
</nav>
