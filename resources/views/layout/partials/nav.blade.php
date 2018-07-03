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
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">Users</span>
                </a>            
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    @hasanyrole('admin|project-manager')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="fa fa-fw fa-users"></i>
                            <span class="nav-link-text">List</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Notifications">
                        <a class="nav-link" href="{{ route('notifications.index') }}">
                            <i class="fa fa-fw fa-bell"></i>
                            <span class="nav-link-text">Notifications</span>
                        </a>
                    </li>
                    @endhasanyrole
                </ul>
            </li>
            @endhasanyrole
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
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Requirements">
                        <a class="nav-link" href="{{ route('requirements.index',['type'=>'requirements']) }}">
                            <i class="fa fa-fw fa-list-ul"></i>
                            <span class="nav-link-text">Requirements</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bugs">
                        <a class="nav-link" href="{{ route('bugs.index',['type'=>'bugs']) }}">
                            <i class="fa fa-fw fa-bug"></i>
                            <span class="nav-link-text">Bugs</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Proposals">
                        <a class="nav-link" href="{{ route('proposal.index') }}">
                            <i class="fa fa-fw fa-files-o"></i>
                            <span class="nav-link-text">Proposals</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Detailed Budgets">
                        <a class="nav-link" href="{{ route('budgets.index') }}">
                            <i class="fa fa-fw fa-file-signature"></i>
                            <span class="nav-link-text">Detailed Budgets</span>
                        </a>
                    </li>
                    @endhasanyrole
                    
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payments">
                        <a class="nav-link" href="{{ route('payments.index') }}">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                        <span class="nav-link-text">Payments</span>
                    </a>
                    </li>
                    @endhasanyrole
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
            @hasanyrole('project-manager|client|developer')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Requirements">
                <a class="nav-link" href="{{ route('requirements.index',['type'=>'requirements']) }}">
                    <i class="fa fa-fw fa-list-ul"></i>
                    <span class="nav-link-text">Requirements</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bugs">
                <a class="nav-link" href="{{ route('bugs.index',['type'=>'bugs']) }}">
                    <i class="fa fa-fw fa-bug"></i>
                    <span class="nav-link-text">Bugs</span>
                </a>
            </li>
            @endhasanyrole
            @hasanyrole('client|projectm')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Payments">
                <a class="nav-link" href="{{ route('payments.index') }}">
                    <i class="fa fa-credit-card" aria-hidden="true"></i>
                    <span class="nav-link-text">Payments</span>
                </a>
            </li>
            @endhasanyrole
            @hasanyrole('comercial|admin')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Marketing">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#marketingMenu" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-bullhorn"></i>
                    <span class="nav-link-text">Marketing</span>
                </a>                
                <ul class="sidenav-second-level collapse" id="marketingMenu">
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
                    @hasanyrole('comercial|admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contacts">
                        <a class="nav-link" href="{{ route('contacts.index') }}">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            <span class="nav-link-text">Contacts</span>
                        </a>
                    </li>
                    @endhasanyrole
                </ul>
            </li>
            @endhasanyrole
            @hasanyrole('developer')
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Time entry">
                    <a class="nav-link" href="{{route('timetracking.index')}}">
                        <i class="fa fa-fw fa-hourglass-half"></i>
                        <span class="nav-link-text">Time Entries</span>
                    </a>
                </li>
            @endhasrole
            @hasanyrole('developer')
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Invoice">
                    <a class="nav-link" href="{{route('invoices.index')}}">
                        <i class="fa fa-fw fa-money"></i>
                        <span class="nav-link-text">Invoices</span>
                    </a>
                </li>
            @endhasrole
            @hasanyrole('developer')
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Calendar">
                    <a class="nav-link" href="{{route('calendar.index')}}">
                        <i class="fa fa-fw fa-calendar"></i>
                        <span class="nav-link-text">Calendar</span>
                    </a>
                </li>
            @endhasrole
            @hasanyrole('admin')
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Employees">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#invoicesMenu" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-people-carry"></i>
                    <span class="nav-link-text">Employees</span>
                </a>                
                <ul class="sidenav-second-level collapse" id="invoicesMenu">
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Invoice">
                        <a class="nav-link" href="{{route('invoices.index')}}">
                            <i class="fa fa-fw fa-money"></i>
                            <span class="nav-link-text">Invoices</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Time Entries">
                        <a class="nav-link" href="{{ route('timetracking.index') }}">
                            <i class="fa fa-fw fa-hourglass-half"></i>
                            <span class="nav-link-text">Time Entries</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Calendar">
                        <a class="nav-link" href="{{route('calendar.index')}}">
                            <i class="fa fa-fw fa-calendar"></i>
                            <span class="nav-link-text">Calendar</span>
                        </a>
                    </li>
                    @endhasanyrole
                </ul>
            </li>
            @endhasanyrole

            @hasanyrole('admin')
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#settings_menu" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-cog"></i>
                    <span class="nav-link-text">Settings</span>
                </a>
                
                <ul class="sidenav-second-level collapse" id="settings_menu">
                    
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Catalogs">
                        <a class="nav-link" href="{{ route('catalogs.index') }}">
                            <i class="fa fa-fw fa-bars"></i>
                            <span class="nav-link-text">Catalogs</span>
                        </a>
                    </li>
                </ul>
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
        
        @include('layout.partials.nav-items.messages')
        
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
                    <i class="fa fa-fw fa-sign-out-alt"></i>Logout
                </a>
            </li>
        </ul>
        
    </div>
</nav>