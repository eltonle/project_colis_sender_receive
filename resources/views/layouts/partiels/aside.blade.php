<aside class="main-sidebar sidebar-dark-primary elevation-4   main-sidebar-custom">
    <!-- Brand Logo -->
    <a href="#" class="brand-link"
        style="display:flex; justify-content: center; align-items: center; text-decoration: none; color: white; font-weight: bold">
        {{-- <img src="{{ asset('admin/dist/img/tof.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-bold">Express colis</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold">Alexander Pierce</a>
            </div>
            <div>

            </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                <li class="nav-item ">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Dashboard
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                    {{-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive Page</p>
                            </a>
                        </li>
                    </ul> --}}
                </li>
                <li class="nav-item {{ request()->is('customers*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Clients
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}"
                                class="nav-link {{ request()->routeIs('customers.index') || request()->routeIs('customers.create') || request()->routeIs('customers.store') || request()->routeIs('customers.delete')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Listes des clients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers.credit') }}"
                                class="nav-link {{ request()->routeIs('customers.credit')|| request()->routeIs('customers.edit.invoice')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Credit Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers.paid') }}"
                                class="nav-link {{ request()->routeIs('customers.paid')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Payement Client</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers.wise.report') }}"
                                class="nav-link {{ request()->routeIs('customers.wise.report')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Rapport Client</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->is('receives*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Recepteurs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('receives.index') }}" class="nav-link active">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Listes des recepteurs</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->is('invoices*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Gérer la facture
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('invoices.index') }}"
                                class="nav-link {{ request()->routeIs('invoices.index') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir les factures retirer</p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('invoices.pending.list') }}"
                                class="nav-link {{ request()->routeIs('invoices.pending.list')|| request()->routeIs('invoices.create') || request()->routeIs('invoices.store') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir les factures</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('invoices.print.list') }}"
                                class="nav-link {{ request()->routeIs('invoices.print.list') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Imprimer Facture</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('invoices.daily.report') }}"
                                class="nav-link {{ request()->routeIs('invoices.daily.report') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>facture rapport journalier</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item {{ request()->is('clients*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Enregistrer un client
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('clients.index') }}"
                                class="nav-link {{  Request::routeIs('clients.index')|| Request::routeIs('clients.create')|| Request::routeIs('clients.edit')|| Request::routeIs('clients.show') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir les transactions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('clients.printList') }}"
                                class="nav-link {{  Request::routeIs('clients.printList') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Imprimer facture</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item {{ request()->is('units*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Emballages
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}" class="nav-link active">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Listes des emballages</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item {{ request()->is('categories*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link active">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir les categories</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item {{ request()->is('articles*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Articles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('articles.index') }}" class="nav-link active">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir les articles</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}


                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li> --}}

                <li class="nav-item ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>
                            Utilisations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="nav-icon fa fa-power-off"></i>
                                {{-- {{ Auth::user()->name }} --}}Deconnection
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-danger font-weight-bold" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('se deconnecter') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>