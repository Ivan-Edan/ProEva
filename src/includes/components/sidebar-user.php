<nav id="sidebar" class="sidebar-user d-flex flex-column text-white">
    <!-- Sidebar Toggle Button for mobile and larger screens -->
    <button class="hamburger-button">&#9776;</button>

    <!-- Sidebar content -->
    <div class="logo-container text-center mt-0">
        <div class="logo-circle mx-auto">
            <img src="images/proeva-logo.svg" alt="ProEva Logo" class="logo">
        </div>
        <span class="logo-text d-block mt-2">ProEva</span>
    </div>

    <!-- Navigation Links -->
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white <?php echo ($page == 'user-home') ? 'active' : ''; ?>" href="index-user.php?page=user-home">
                <img src="images/svg/home.svg" alt="Home Icon" class="nav-icon"> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?php echo ($page == 'user-monitoring') ? 'active' : ''; ?>" href="index-user.php?page=user-monitoring">
                <img src="images/svg/check-circle.svg" alt="Monitoring Icon" class="nav-icon"> Project Monitoring
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?php echo ($page == 'user-reports') ? 'active' : ''; ?>" href="index-user.php?page=user-reports">
                <img src="images/svg/folder.svg" alt="Reports Icon" class="nav-icon"> Reports
            </a>
        </li>
    </ul>

    <!-- Logout Button -->
    <div class="logout-container text-center mt-auto py-3">
        <a class="text-white" href="includes/logout.php"><img src="images/svg/log-out.svg" alt="Logout Icon" class="nav-icon"> Logout</a>
    </div>
</nav>