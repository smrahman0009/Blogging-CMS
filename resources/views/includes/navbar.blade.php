<header class="header" style="background-color: #298391;">
        <div class="container">
            <div class="row">
                <div class="logo">
                    <div class="logo-text">
                        <a href="{{route('index')}}">
                            <div class="logo-title">{{$title}}</div>
                        </a>
                    </div>
                </div>
                <div class="pull-right">
                    <ul class="primary-menu-menu">
                        <li>
                            <a href="{{route('login')}}" class="">Login</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="small em">
                                Create new account?
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</header>