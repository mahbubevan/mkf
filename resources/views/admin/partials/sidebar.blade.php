<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{__('Dashboard')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.user.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.user.list')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Manage Users')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.user.list')}}" class="nav-link @if(request()->routeIs('admin.user.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('All Users')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.employee.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.employee.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Employee Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.employee.list')}}" class="nav-link @if(request()->routeIs('admin.employee.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Employee Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.employee.create')}}" class="nav-link @if(request()->routeIs('admin.employee.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create employee')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Attendance Record')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Salary Records')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.fabric.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.fabric.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Fabric Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.fabric.list')}}" class="nav-link @if(request()->routeIs('admin.fabric.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Fabric Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.fabric.create')}}" class="nav-link @if(request()->routeIs('admin.fabric.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create Record')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.accesories.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.accesories.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Accesories Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.accesories.create')}}" class="nav-link @if(request()->routeIs('admin.accesories.create')) active @endif">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('Create Record')}}</p>
                    </a>
                  </li>
              <li class="nav-item">
                <a href="{{route('admin.accesories.list')}}" class="nav-link @if(request()->routeIs('admin.accesories.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Accesories Details')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.accesories.name')}}" class="nav-link @if(request()->routeIs('admin.accesories.name')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Accesories Stock')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.production.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.production.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Production Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.production.list')}}" class="nav-link @if(request()->routeIs('admin.production.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Production Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.production.create')}}" class="nav-link @if(request()->routeIs('admin.production.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Start New Production')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.stock.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.stock.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Stock Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.stock.list')}}" class="nav-link @if(request()->routeIs('admin.stock.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Stock Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.stock.create')}}" class="nav-link @if(request()->routeIs('admin.stock.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create stock')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.sale.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.sale.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Sale Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.sale.list')}}" class="nav-link @if(request()->routeIs('admin.sale.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Sale Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.sale.create')}}" class="nav-link @if(request()->routeIs('admin.sale.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create Sale')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.inventory.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.inventory.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('Inventory Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.inventory.list')}}" class="nav-link @if(request()->routeIs('admin.inventory.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('Inventory Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.inventory.create')}}" class="nav-link @if(request()->routeIs('admin.inventory.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create Inventory')}}</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview @if(request()->routeIs('admin.external.*')) menu-open @endif">
            <a href="#" class="nav-link @if(request()->routeIs('admin.external.*')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{__('External Management')}}
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.external.expense.list')}}" class="nav-link @if(request()->routeIs('admin.external.expense.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('External expense Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.external.expense.create')}}" class="nav-link @if(request()->routeIs('admin.external.expense.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create external expense')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.external.income.list')}}" class="nav-link @if(request()->routeIs('admin.external.income.list')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> {{__('External income Lists')}} </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.external.income.create')}}" class="nav-link @if(request()->routeIs('admin.external.income.create')) active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{__('Create external income')}}</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.setting.index')}}" class="nav-link @if(request()->routeIs('admin.setting.index')) active @endif">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{__('General Setting')}}
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.company.account')}}" class="nav-link @if(request()->routeIs('admin.company.account')) active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{__('Account')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin.transaction.list')}}" class="nav-link @if(request()->routeIs('admin.transaction.list')) active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{__('Transactions')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
