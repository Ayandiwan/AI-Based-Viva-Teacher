<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3"
           href="@auth
                    @if(Auth::user()->role == 'admin')
                        {{ route('admin.dashboard') }}
                    @elseif(Auth::user()->role == 'teacher')
                        {{ route('teacher.dashboard') }}
                    @elseif(Auth::user()->role == 'student')
                        {{ route('student.dashboard') }}
                    @else
                        {{ url('/') }}
                    @endif
                 @else
                    {{ url('/') }}
                 @endauth">
            <i class="bi bi-robot"></i> AI Viva Teacher
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Home -->
                <li class="nav-item">

                    @guest
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    @endguest

                    @auth

                        @if(Auth::user()->role == 'admin')
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                Home
                            </a>

                        @elseif(Auth::user()->role == 'teacher')
                            <a class="nav-link" href="{{ route('teacher.dashboard') }}">
                                Home
                            </a>

                        @elseif(Auth::user()->role == 'student')
                            <a class="nav-link" href="{{ route('student.dashboard') }}">
                                Home
                            </a>

                        @endif

                    @endauth

                </li>

              <li class="nav-item">
    <a class="nav-link" href="{{ route('features') }}">
        Features
    </a>
</li>

                <li class="nav-item">
    <a class="nav-link" href="{{ route('about') }}">
        About
    </a>
</li>

             <li class="nav-item">
    <a class="nav-link" href="{{ route('contact') }}">
        Contact
    </a>
</li>

                @guest

                    <li class="nav-item ms-lg-3">
                        <a href="{{ route('login') }}"
                           class="btn btn-outline-light rounded-pill px-4">
                            Login
                        </a>
                    </li>

                    @if(Route::has('register'))
                        <li class="nav-item ms-lg-2">
                            <a href="{{ route('register') }}"
                               class="btn btn-primary rounded-pill px-4">
                                Register
                            </a>
                        </li>
                    @endif

                @endguest

                @auth

                    <li class="nav-item dropdown ms-lg-3">

                        <a class="nav-link dropdown-toggle text-white"
                           href="#"
                           data-bs-toggle="dropdown">

                            <i class="bi bi-person-circle me-2"></i>
                            {{ Auth::user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>

                                @if(Auth::user()->role == 'admin')

                                    <a class="dropdown-item"
                                       href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Dashboard
                                    </a>

                                @elseif(Auth::user()->role == 'teacher')

                                    <a class="dropdown-item"
                                       href="{{ route('teacher.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Dashboard
                                    </a>

                                @elseif(Auth::user()->role == 'student')

                                    <a class="dropdown-item"
                                       href="{{ route('student.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Dashboard
                                    </a>

                                @endif

                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2"></i>
                                    Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST"
                                      action="{{ route('logout') }}">
                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item text-danger">

                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Logout

                                    </button>

                                </form>
                            </li>

                        </ul>

                    </li>

                @endauth

            </ul>

        </div>

    </div>
</nav>  