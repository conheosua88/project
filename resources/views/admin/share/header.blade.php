 <!-- top navigation -->
 <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
             @if(Auth::check())
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="{{ Auth::user()->image ? Auth::user()->image : '' }}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                 
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="admin/taikhoan"> Tài khoản của bạn</a></li>
                    <li><a href="admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                
                </li> 
              </ul>
              @endif
            </nav>
          </div>
        </div>
        <!-- /top navigation -->