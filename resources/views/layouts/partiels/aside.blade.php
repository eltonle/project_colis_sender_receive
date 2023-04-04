<aside class="main-sidebar sidebar-dark-primary elevation-4   main-sidebar-custom">
    <!-- Brand Logo -->
    <a href="#" class="brand-link"
        style="display:flex; justify-content: center; align-items: center; text-decoration: none; color: white; font-weight: bold">
        {{-- <img src="{{ asset('admin/dist/img/tof.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-bold">Express Colis</span>
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
                            Tableau De Bord
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
                    <a href="#" class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Gestion Clients
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}"
                                class="nav-link {{ request()->routeIs('customers.index') || request()->routeIs('customers.store') || request()->routeIs('customers.delete')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Listes des Clients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers.create') }}"
                                class="nav-link {{  request()->routeIs('customers.create') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Ajouter un Client </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('customers.credit') }}"
                                class="nav-link {{ request()->routeIs('customers.credit')|| request()->routeIs('customers.edit.invoice')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir Credit Client</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="{{ route('customers.paid') }}"
                                class="nav-link {{ request()->routeIs('customers.paid')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p> Voir Payement Client</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('customers.wise.report') }}"
                                class="nav-link {{ request()->routeIs('customers.wise.report')? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Rapport Client</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item {{ request()->is('receives*') ? 'menu-open' : '' }}">
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
                </li> --}}

                <li class="nav-item {{ request()->is('invoices*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('invoices*') ? 'active' : '' }}">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Gestion des Expeditions
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
                                class="nav-link {{ request()->routeIs('invoices.pending.list')|| request()->routeIs('invoices.store') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Voir les Expeditions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('invoices.create') }}"
                                class="nav-link {{request()->routeIs('invoices.create') || request()->routeIs('invoices.store') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Ajouter une Expedition</p>
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
                                <p>Rapport Expedition </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ request()->is('units*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('units*') ? 'active' : '' }}">
                        <i class="nav-icon 	fas fa-folder"></i>
                        <p>
                            Gestion des Colis
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}"
                                class="nav-link {{ request()->routeIs('units.index')||request()->routeIs('units.edit')||request()->routeIs('units.delete') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Listes des Colis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            {{-- <a href="{{ route('units.create') }}"
                                class="nav-link {{ request()->routeIs('units.create') ? 'active' : '' }}">
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>Ajouter un Colis</p>
                            </a> --}}
                        <li class="nav-item {{ request()->is('units*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('units*') ? 'active' : '' }}">
                                {{-- <i class="nav-icon 	fas fa-folder"></i> --}}
                                <i class="far fas fa-long-arrow-alt-right"></i>
                                <p>
                                    Colis standard

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('units.index') }}"
                                        class="nav-link {{ request()->routeIs('units.index')||request()->routeIs('units.edit')||request()->routeIs('units.delete') ? 'active' : '' }}">
                                        <i class="far fa-circle"></i>
                                        <p>Listes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('units.create') }}"
                                        class="nav-link {{ request()->routeIs('units.create') ? 'active' : '' }}">
                                        <i class="far fa-circle"></i>
                                        <p>Ajouter </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                </li>
            </ul>
            </li>


            <li class="nav-item {{ request()->is('finances*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('finances*') ? 'active' : '' }}">
                    <i class="nav-icon 	fas fa-folder"></i>
                    <p>
                        Gestion des Finances
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('finances.credit') }}"
                            class="nav-link {{ request()->routeIs('finances.credit')|| request()->routeIs('customers.edit.invoice')? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Voir Credit Client</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('finances.paid') }}"
                            class="nav-link {{ request()->routeIs('finances.paid')? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p> Voir Payement Client</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->is('units*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('units*') ? 'active' : '' }}">
                    <i class="nav-icon 	fas fa-folder"></i>
                    <p>
                        Gestion des Conteneurs
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('units.index') }}"
                            class="nav-link {{ request()->routeIs('units.index')||request()->routeIs('units.edit')||request()->routeIs('units.delete') ? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Listes des Conteneurs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('units.create') }}"
                            class="nav-link {{ request()->routeIs('units.create') ? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Ajouter un Conteneur</p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a href="{{ route('units.chargement') }}"
                        class="nav-link {{ request()->routeIs('units.chargement') ? 'active' : '' }}">
                        <i class="far fas fa-long-arrow-alt-right"></i>
                        <p>charger un Conteneur</p>
                    </a>
                </li>
                </ul>
            </li>
            
        <li class="nav-item {{ request()->is('units*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('units*') ? 'active' : '' }}">
                <i class="nav-icon 	fas fa-folder"></i>
                <p>
                    Gestion des Véhicule
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('vehicule.index') }}"
                        class="nav-link {{ request()->routeIs('vehicule.index')||request()->routeIs('units.edit')||request()->routeIs('units.delete') ? 'active' : '' }}">
                        <i class="far fas fa-long-arrow-alt-right">
                       
                        </i>
                        <p>Listes des véhicule</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vehicule.affectation') }}"
                        class="nav-link {{ request()->routeIs('vehicule.affectation') ? 'active' : '' }}">
                        <i class="far fas fa-long-arrow-alt-right"></i>
                        <p>Listes des affectation véhicule</p>
                    </a>
                </li>
            </ul>
        </li>
            <li class="nav-item {{ request()->is('countries*')||request()->is('states*') ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link {{ request()->is('countries*')|| request()->is('states*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-map-marker-alt"></i>
                    <p>
                        Pays & Villes
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('countries.index') }}"
                            class="nav-link {{ request()->routeIs('countries.index')||request()->routeIs('countries.store')||request()->routeIs('countries.update')||request()->routeIs('countries.delete') ? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Listes des Pays</p>
                        </a>
                        <a href="{{ route('countries.create') }}"
                            class="nav-link {{request()->routeIs('countries.create') ? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Ajouter un Pays</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('states.index') }}"
                            class="nav-link {{ request()->routeIs('states.index')||request()->routeIs('states.store')||request()->routeIs('states.update')||request()->routeIs('states.delete') ? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Listes des Villes</p>
                        </a>
                        <a href="{{ route('states.create') }}"
                            class="nav-link {{request()->routeIs('states.create') ? 'active' : '' }}">
                            <i class="far fas fa-long-arrow-alt-right"></i>
                            <p>Ajouter une Ville</p>
                        </a>
                    </li>
                </ul>
            </li>

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
                            <a class="dropdown-item text-danger font-weight-bold" href="{{ route('logout') }}" onclick="event.preventDefault();
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