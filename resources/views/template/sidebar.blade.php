<div class="nav" id="sidebar">
    <div class="toggler">
        <div class="logo">
            @isset($navbars->image)
                <img src="{{ asset($navbars->image) }}" alt="">
                <span>{{ $navbars->name }}</span>
            @endisset
        </div>
        <div class="box">
            <input type="checkbox" name="toggle" id="toggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <nav class="sidebar">
        <div class="clock">
            <span id="datetime"></span>
            <span id="clock"></span>
        </div>
        <div class="link-group">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-house"></i><span>
                    Dashboard</span></a>
            <div class="data-master-dropdown">
                <button class="nav-link" id="open-master"><i class="fa-solid fa-list"></i><span>Data
                        Master</span></button>
                <div class="master-menu" id="master-menu">
                    <a href="{{ route('management.drone') }}" class="drop-link"><span>Drone</span></a>
                    <a href="{{ route('management.user') }}" class="drop-link"><span>User</span></a>
                    <a href="{{ route('management.security') }}" class="drop-link"><span>Security</span></a>
                    <a href="{{ route('management.legend') }}" class="drop-link"><span>Legends</span></a>
                </div>
            </div>
            <div class="data-master-dropdown">
                <button class="nav-link" id="open-report"><i class="fa-solid fa-book"></i><span>Report</span></button>
                <div class="master-menu" id="report-menu">
                    <a href="{{ route('logs.user') }}" class="drop-link"><span>User Log</span></a>
                    <a href="{{ route('logs.drone') }}" class="drop-link"><span>Drone Log</span></a>
                    <a href="{{ route('logs.security') }}" class="drop-link"><span>Security Log</span></a>
                </div>
            </div>
            <a href="{{ route('setting') }}" class="nav-link"><i class="fa-solid fa-gear"></i><span> Setting</span></a>
        </div>
        <div class="profile">
            <a href="{{ route('user.setting') }}" class="profile-link"><i
                    class="fa-solid fa-user"></i><span>Profile</span></a>
            <a href="{{ route('user.logout') }}" class="profile-link"><i
                    class="fa-solid fa-right-from-bracket"></i><span>Log
                    Out</span></a>
        </div>
    </nav>
</div>
<script>
    document.getElementById('open-master').addEventListener('click', function() {
        localStorage.setItem('toggled', 'enabled')
        document.getElementById('master-menu').classList.toggle('open');
        if (document.getElementById('master-menu').classList.contains('open')) {
            document.getElementById('open-master').classList.add('on')
        } else {
            document.getElementById('open-master').classList.remove('on')
        }
        if (!document.getElementById('sidebar').classList.contains('expand')) {
            document.getElementById('sidebar').classList.add('expand');
            document.getElementById('toggle').checked = true;
        }
        if (document.getElementById('report-menu').classList.contains('open')) {
            document.getElementById('open-report').classList.remove('on');
            document.getElementById('report-menu').classList.remove('open');
            document.getElementById('toggle').checked = true;
        }
    });

    document.getElementById('open-report').addEventListener('click', function() {
        localStorage.setItem('toggled', 'enabled')
        document.getElementById('report-menu').classList.toggle('open');
        if (document.getElementById('report-menu').classList.contains('open')) {
            document.getElementById('open-report').classList.add('on');
        } else {
            document.getElementById('open-report').classList.remove('on');
        }
        if (!document.getElementById('sidebar').classList.contains('expand')) {
            document.getElementById('sidebar').classList.add('expand');
            document.getElementById('toggle').checked = true;
        }
        if (document.getElementById('master-menu').classList.contains('open')) {
            document.getElementById('open-master').classList.remove('on')
            document.getElementById('master-menu').classList.remove('open');
            document.getElementById('toggle').checked = true;
        }
    });


    display_ct()

    function display_c() {
        var refresh = 300;
        mytime = setTimeout('display_ct()', refresh)
    }

    function display_ct() {
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        var x = new Date()
        var y = x.getFullYear();
        var m = monthNames[x.getMonth()];
        var d = ("00" + x.getDate()).slice(-2);
        var h = ("00" + x.getHours()).slice(-2);
        var i = ("00" + x.getMinutes()).slice(-2);
        var s = ("00" + x.getSeconds()).slice(-2);
        document.getElementById('clock').innerHTML = h + ":" + i + ":" + s;
        document.getElementById('datetime').innerHTML = d + " " + m + " " + y;

        display_c();
    }

    let toggled = localStorage.getItem('toggled');

    const enableSidebar = () => {
        document.getElementById('sidebar').classList.add('expand')
        localStorage.setItem('toggled', 'enabled')
    };
    const disableSidebar = () => {
        document.getElementById('sidebar').classList.remove('expand')
        localStorage.setItem('toggled', null)
    }

    if (toggled === 'enabled') {
        enableSidebar()
        document.getElementById('toggle').checked = true;
    } else {
        disableSidebar()
        document.getElementById('toggle').checked = false;
    }

    document.getElementById('toggle').addEventListener('click', function() {
        toggled = localStorage.getItem('toggled')
        if (toggled !== 'enabled') {
            enableSidebar()
        } else {
            disableSidebar()
        }
        if (!document.getElementById('sidebar').classList.contains('expand')) {
            document.getElementById('master-menu').classList.remove('open')
            document.getElementById('open-master').classList.remove('on')
            document.getElementById('open-report').classList.remove('on')
            document.getElementById('report-menu').classList.remove('open')
        }
    });
</script>
