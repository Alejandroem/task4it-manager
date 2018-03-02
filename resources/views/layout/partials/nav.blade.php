<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{URL::to('/')}}">Task4It Manager</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            @hasanyrole('admin|project-manager')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-user"></i>
                <span class="nav-link-text">Users</span>
            </a>
            @endhasanyrole
            <ul class="sidenav-second-level collapse" id="collapseComponents">
                @hasanyrole('admin|project-manager')
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text">List</span>
                    </a>
                </li>
                @endrole
                @hasanyrole('admin')
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                    <a class="nav-link" href="{{ route('notifications.index') }}">
                        <i class="fa fa-fw fa-bell"></i>
                        <span class="nav-link-text">Notifications</span>
                    </a>
                </li>
                @endrole
            </ul>
            </li>
        @hasanyrole('admin')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Projects">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProjects" data-parent="#collapseProjects">
                    <i class="fa fa-fw fa-book"></i>
                    <span class="nav-link-text">Projects</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseProjects">
                    @hasanyrole('admin|project-manager')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="List">
                        <a class="nav-link" href="{{ route('projects.index') }}">
                            <i class="fa fa-fw fa-file-text"></i>
                            <span class="nav-link-text">List</span>
                        </a>
                    </li>
                    @endrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Proposals">
                        <a class="nav-link" href="{{ route('proposal.index') }}">
                            <i class="fa fa-fw fa-files-o"></i>
                            <span class="nav-link-text">Proposals</span>
                        </a>
                    </li>
                    @endrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Detailed Budgets">
                        <a class="nav-link" href="{{ route('budgets.index') }}">
                            <i class="fa fa-fw fa-file-o"></i>
                            <span class="nav-link-text">Detailed Budgets</span>
                        </a>
                    </li>
                    @endrole
                </ul>
            </li>
        @endhasanyrole
        @hasanyrole('project-manager|client|developer')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Projects">
                <a class="nav-link" href="{{ route('projects.index') }}">
                    <i class="fa fa-fw fa-file-text"></i>
                    <span class="nav-link-text">List</span>
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
            @hasanyrole('admin|client|projectm')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payments">
                <a class="nav-link" href="{{ route('payments.index') }}">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    <span class="nav-link-text">Payments</span>
                </a>
            </li>
            @endhasanyrole
            @hasanyrole('admin')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Packages">
                <a class="nav-link" href="{{ route('packages.create') }}">
                    <i class="fa fa-archive" aria-hidden="true"></i>
                    <span class="nav-link-text">Packages</span>
                </a>
            </li>
            @endhasanyrole
            @hasanyrole('admin')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Enquires">
                <a class="nav-link" href="{{ route('enquires.index') }}">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    <span class="nav-link-text">Enquires</span>
                </a>
            </li>
            @endhasanyrole

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
        @hasanyrole('client')
        @include('layout.partials.nav-items.messages')
        @endhasanyrole
        <div class="nav-item">
            <div class="mr-4 my-2">
                @hasanyrole('client')
                <button class="btn">
                Balance: <span class="badge badge-secondary"><i class="fa fa-usd" aria-hidden="true"></i> {{Auth::User()->balance}}€</span>
                </button>
                @endhasanyrole
            </div>
        </div>
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