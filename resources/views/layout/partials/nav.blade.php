<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{URL::to('/')}}">Task4It Manager</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        @role('admin')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Users</span>
                </a>
            </li>
        @endrole
        @hasanyrole('admin|project-manager|client')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Projects">
                <a class="nav-link" href="{{ route('projects.index') }}">
                    <i class="fa fa-fw fa-book"></i>
                    <span class="nav-link-text">Projects</span>
                </a>
            </li>
        @endhasanyrole
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Requirements">
                <a class="nav-link" href="{{ route('requirements.index',['type'=>'requirements']) }}">
                    <i class="fa fa-fw fa-check-square-o"></i>
                    <span class="nav-link-text">Requirements</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bugs">
                <a class="nav-link" href="{{ route('bugs.index',['type'=>'bugs']) }}">
                    <i class="fa fa-fw fa-bug"></i>
                    <span class="nav-link-text">Bugs</span>
                </a>
            </li>

        </ul>

        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler" >
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        </ul>
        <ul class="navbar-nav ml-auto">
        
        @include('layout.partials.nav-items.messages')
        @include('layout.partials.nav-items.avatar')
        {{--  @include('layout.partials.nav-items.search')  --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
        
    </div>
</nav>