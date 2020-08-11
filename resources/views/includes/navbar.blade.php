<header class="header">
        <div class="container">
                <div class="header-content-wrapper">
                    <div class="logo">
                        <div class="logo-text">
                            <a href="{{route('index')}}">
                                <div class="logo-title">{{$title}}</div>
                            </a>
                        </div>
                    </div>
                   <div class="bg-light clearfix">
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
        </div>
</header>
<!-- 
<nav class="navbar navbar-default navbar-dark bg-dark">
  <a class="navbar-brand" href="{{route('index')}}"> <p class="logo-title display-3">{{$title}}</p></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"></a>
      </li>
    </ul>
    <span class="navbar-text">
        <a href="{{route('login')}}" class="btn btn-block btn-info"> Login</a>
        <a href="{{route('register')}}" class="small em">
          Create new account?
        </a>
    </span>
  </div>
</nav> -->