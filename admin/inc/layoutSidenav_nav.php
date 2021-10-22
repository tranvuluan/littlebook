<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Thống kê
                </a>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="../admin/danhmucsach.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Danh mục sách
                </a>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooks">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Sách
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseBooks">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="themsach.php">Thêm sách</a>
                        <a class="nav-link" href="dssach.php">Danh sách </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSaleBooks">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Sách khuyến mãi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSaleBooks">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="themkmsach.php">Thêm khuyễn mãi</a>
                        <a class="nav-link" href="dskmsach.php">Danh sách sách được KM</a>
                    </nav>
                </div>
                <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Blog
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseBlogs">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="themblog.php">Thêm blog</a>
                        <a class="nav-link" href="quanlyblog.php">Quản lý blog </a>
                    </nav>
                </div> -->
                <a class="nav-link collapsed" href="tkuser.php" data-toggle="collapse" data-target="#collapseUserAccount">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Quản lý khách hàng
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseUserAccount">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="dsuser.php">Danh sách KH</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="tkuser.php" data-toggle="collapse" data-target="#collapseOrder">
                    <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                    Quản lý đơn hàng
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseOrder">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="dhdangxuly.php">Đơn hàng đang xử lý</a>
                        <a class="nav-link" href="dhdaxuly.php">Đơn hàng đã xử lý</a>
                        <a class="nav-link" href="dhhoantat.php">Đơn hàng đã hoàn tất</a>
                    </nav>
                </div>
            </div>

        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
        </div>
    </nav>
</div>