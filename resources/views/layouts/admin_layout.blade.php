<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin panel - @yield('title')</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header class="hero has-background-mint-dark">
            <div class="hero-head">
                <nav class="navbar has-shadow" role="navigation" aria-label="main navigation">
                    <div class="navbar-brand">
                        <a class="navbar-item is--brand">
                            <img class="navbar-brand-logo" src="/images/admin-logo-v2.png" alt="">
                        </a>
                    </div>
                    <div class="navbar-menu navbar-end">
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                <figure class="image is-32x32" style="margin-right: 0.5em">
                                    <img src="/images/admin-photo.png" alt="">
                                </figure>
                                Admin
                            </a>
                            <div class="navbar-dropdown is-hoverable">
                                <a class="navbar-item">
                                    <span class="icon is-small">
                                        <i class="fa fa-power-off"></i>
                                    </span>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <section class="content">
            <div class="wrapper">
                <div class="columns full-height">
                    <div class="column is-2 has-background-yellow-light ">
                        <div class="pl-1">
                            <aside class="menu">
                                <p class="menu-label">
                                    General
                                </p>
                                <ul class="menu-list">
                                    <li><a href="{{ route('homeAdmin') }}" class="hoverable text-glow" id="dashboard">Dashboard</a></li>
                                    <li><a href="{{ route('employeeAdmin') }}" class="hoverable text-glow" id="employee">Employee</a></li>
                                    <li>
                                      <div class="dropdown is-hoverable">
                                        <div class="dropdown-trigger">
                                          <a class="text-glow" aria-haspopup="true" aria-controls="dropdown-menu4">
                                            Accounting
                                          </a>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                          <div class="dropdown-content">
                                            <div class="dropdown-item">
                                              <a href="{{ route('generalAdmin') }}" class="hoverable text-glow" id="employee">General</a>
                                              <a href="{{ route('categoriesAdmin') }}" class="hoverable text-glow" id="employee">Categories</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                    <div class="column is-10 has-background-mint-dark" id="data">
                    @yield('content')
                    </div>
                </div>
            </div>
        </section>
        <script src="{{ URL::asset('./js/app.js') }}"></script>
    </body>
</html>
