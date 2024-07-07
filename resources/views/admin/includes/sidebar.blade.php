<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name; }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

         @can('قائمة الضبط')

        <li class="nav-item has-treeview    {{ ( request()->is('admin/generalSettings*') || request()->is('admin/finance_calender*') || request()->is('admin/branches*') || request()->is('admin/ShiftsTypes*') || request()->is('admin/departements*')  || request()->is('admin/jobs_categories*') || request()->is('admin/Qualifications*') || request()->is('admin/occasions*') || request()->is('admin/Resignations*') || request()->is('admin/Nationalities*') || request()->is('admin/Religions*')) ? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('admin/generalSettings*') || request()->is('admin/finance_calender*') || request()->is('admin/branches*') || request()->is('admin/ShiftsTypes*') || request()->is('admin/departements*') || request()->is('admin/jobs_categories*')  || request()->is('admin/Qualifications*') ||request()->is('admin/occasions*') || request()->is('admin/Resignations*') || request()->is('admin/Nationalities*') || request()->is('admin/Religions*') ) ? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
             قائمة الضبط
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can( 'الضبط العام')
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>الضبط العام</p>
              </a>
            </li>
            @endcan

            @can('السنوات المالية')
            <li class="nav-item">
              <a href="{{ route('finance_calender.index') }}" class="nav-link  {{ (request()->is('admin/finance_calender*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> السنوات المالية</p>
              </a>
            </li>
            @endcan

            @can('قائمة الفروع')
            <li class="nav-item">
              <a href="{{ route('branches.index') }}" class="nav-link  {{ (request()->is('admin/branches*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>  الفروع</p>
              </a>
            </li>
            @endcan

            @can( 'انواع الشيفتات')
            <li class="nav-item">
              <a href="{{ route('ShiftsTypes.index') }}" class="nav-link  {{ (request()->is('admin/ShiftsTypes*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>  انواع الشفتات</p>
              </a>
            </li>
            @endcan

            @can('ادارات الموظفين')
            <li class="nav-item">
              <a href="{{ route('departements.index') }}" class="nav-link  {{ (request()->is('admin/departements*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>   ادارات الموظفين</p>
              </a>
            </li>
             @endcan

             @can(  'وظائف الموظفين')
            <li class="nav-item">
              <a href="{{ route('jobs_categories.index') }}" class="nav-link  {{ (request()->is('admin/jobs_categories*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>     وظائف الموظفين</p>
              </a>
            </li>
            @endcan
           
            @can( 'مؤهلات الموظفين')
            <li class="nav-item">
              <a href="{{ route('Qualifications.index') }}" class="nav-link  {{ (request()->is('admin/Qualifications*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>     مؤهلات الموظفين</p>
              </a>
            </li>
            @endcan

            @can( 'المناسبات الرسمية')
            <li class="nav-item">
              <a href="{{ route('occasions.index') }}" class="nav-link  {{ (request()->is('admin/occasions*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>      المناسبات الرسمية</p>
              </a>
            </li>

            @endcan

            @can(  'انواع ترك العمل')
            <li class="nav-item">
              <a href="{{ route('Resignations.index') }}" class="nav-link  {{ (request()->is('admin/Resignations*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>       أنواع ترك العمل</p>
              </a>
            </li>
            @endcan

            @can( 'انواع الجنسيات')
            <li class="nav-item">
              <a href="{{ route('Nationalities.index') }}" class="nav-link  {{ (request()->is('admin/Nationalities*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>       أنواع الجنسيات</p>
              </a>
            </li>
            @endcan

            @can( 'انواع الديانات')
            <li class="nav-item">
              <a href="{{ route('Religions.index') }}" class="nav-link  {{ (request()->is('admin/Religions*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>       أنواع الديانات</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
            @endcan

        @can('قائمة شئون الموظفين')
        <li class="nav-item has-treeview    {{ ( request()->is('admin/Employees*')) ? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('admin/Employees*')  ) ? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
             قائمة شئون الموظفين
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('بيانات الموظفين')
            <li class="nav-item">
              <a href="{{ route('Employees.index') }}" class="nav-link {{ (request()->is('admin/Employees*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> بيانات الموظفين</p>
              </a>
            </li>
            @endcan

            @can('بيانات موظفين الادارة')
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> بيانات موظفين الادارة</p>
              </a>
            </li>
            @endcan

            @can('انواع الاضافي للراتب')
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> انواع الاضافي للراتب</p>
              </a>
            </li>
            @endcan

            @can('انواع الخصم للراتب')
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> انواع الخصم للراتب</p>
              </a>
            </li>
            @endcan

            @can('انواع البدلات للراتب')
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p> انواع البدلات للراتب</p>
              </a>
            </li>
            @endcan
            
            @can('هواتف الموظفين')
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('admin/generalSettings*'))?'active':'' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>   هواتف الموظفين</p>
              </a>
            </li>
            @endcan

          </ul>
        </li>
         @endcan

         @can(' المستخدمين')
        <li class="nav-item has-treeview    {{ ( request()->is('admin/admins*')) ? 'menu-open':'' }} ">
            <a href="#" class="nav-link {{ ( request()->is('admin/admins*')  ) ? 'active':'' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              المستخدمين
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admins.index') }}" class="nav-link {{ (request()->is('admin/admins*'))?'active':'' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p> بيانات المستخدمين</p>
                </a>
              </li>
          </ul>
        </li>
        @endcan

        @can(' الصلاحيات')

        <li class="nav-item has-treeview {{ (request()->is('admin/Permissions*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('admin/Permissions*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              الصلاحيات
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('permissions.index') }}" class="nav-link {{ (request()->is('admin/Permissions*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>إدارة الصلاحيات</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan


        @can(' المهام')

        <li class="nav-item has-treeview {{ (request()->is('admin/tasks*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ (request()->is('admin/tasks*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-lock"></i>
            <p>
              المهام
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('tasks.index') }}" class="nav-link {{ (request()->is('admin/tasks*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>إدارة المهام</p>
              </a>
            </li>
          </ul>
        </li>
        @endcan

        @can(' المقاولات')

          <li class="nav-item has-treeview {{ (request()->is('admin/contracting*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('admin/contracting*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-lock"></i>
              <p>
              المقاولات
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('contractings.index') }}" class="nav-link {{ (request()->is('admin/contracting*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>إدارة المقاولات</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin() || auth()->user()->isManager())

            @can(' الحضور و الإنصراف')

              <li class="nav-item has-treeview {{ (request()->is('admin/attendances*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('admin/attendances*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-lock"></i>
                  <p>
                  الحضور والإنصراف
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('attendances.index') }}" class="nav-link {{ (request()->is('admin/attendances*')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p> عرض الحضور والإنصراف</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endcan
          @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>