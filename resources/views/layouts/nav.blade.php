<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('/') }}">和東資訊教學網</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ route('index') }}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">儀表統計</span>
                </a>
            </li>
            @if (auth()->check())
                @if(auth()->user()->group_id == 1)
                    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Setting">
                        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseSetting" data-parent="#exampleAccordion">
                            <i class="fa fa-fw fa-cogs"></i>
                            <span class="nav-link-text">系統管理</span>
                        </a>
                        <ul class="sidenav-second-level collapse" id="collapseSetting">
                            <li>
                                <a href="{{ route('admin.account.index') }}">帳號管理</a>
                            </li>
                            <li>
                                <a href="register.html">訊息管理</a>
                            </li>
                            <li>
                                <a href="register.html">公告管理</a>
                            </li>
                            <li>
                                <a href="register.html">作業管理</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">打字管理</a>
                            </li>
                            <li>
                                <a href="blank.html">其他管理</a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Post">
                <a class="nav-link" href="index.html">
                    <i class="fa fa-fw fa-bullhorn"></i>
                    <span class="nav-link-text">公告系統</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Work">
                <a class="nav-link" href="index.html">
                    <i class="fa fa-fw fa-file-text-o"></i>
                    <span class="nav-link-text">學生作業</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                <a class="nav-link" href="#">
                    <i class="fa fa-fw fa-link"></i>
                    <span class="nav-link-text">好站連結</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
                <a class="nav-link" href="charts.html">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Charts</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                <a class="nav-link" href="tables.html">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Tables</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Components</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="navbar.html">Navbar</a>
                    </li>
                    <li>
                        <a href="{{ asset('sb_admin/cards.html') }}">Cards</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Example Pages</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                    <li>
                        <a href="login.html">Login Page</a>
                    </li>
                    <li>
                        <a href="register.html">Registration Page</a>
                    </li>
                    <li>
                        <a href="forgot-password.html">Forgot Password Page</a>
                    </li>
                    <li>
                        <a href="blank.html">Blank Page</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-sitemap"></i>
                    <span class="nav-link-text">Menu Levels</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti">
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                        <ul class="sidenav-third-level collapse" id="collapseMulti2">
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @if(auth()->check())
            <li class="nav-item">
                <img src="{{ asset('img/avatar.jpg') }}" width="40" height="30" class="rounded-circle">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="hi()"> Hi
                    <i class="fa fa-fw fa-user-circle-o"></i>{{ auth()->user()->name }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                    <span class="d-lg-none">訊息
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
                    <span class="indicator text-danger d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="d-lg-none">任務
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
                    <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">New Alerts:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all alerts</a>
                </div>
            </li>
            @endif
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for...">
                        <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
            </li>

                @if (auth()->check())
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#personalModal">
                        <i class="fa fa-fw fa-cog"></i>個人資訊</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>登出</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('login') }}">
                        <i class="fa fa-fw fa-sign-in"></i>登入</a>
                </li>
                @endif
            </li>
        </ul>
    </div>
</nav>
@if(auth()->check())
    <script>
        var i=0;
        function hi()
        {
            i++;
            alert('Hi, {{ auth()->user()->name }}, 你按了'+ i +'下');
        }
    </script>
@endif

<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">你真的要離開了?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">如果真的，請在底下選擇"登出"</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                <a href="{{ route('logout') }}" class="btn btn-primary"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">登出</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>

@if(auth()->check())
<!-- Personal INFO Modal-->
    <div class="modal fade" id="personalModal" tabindex="-1" role="dialog" aria-labelledby="personalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personalModalLabel">
                    {{ auth()->user()->name }}( {{ auth()->user()->username }} )-{{ auth()->user()->group->name }}{{ auth()->user()->year_class_num }}
                    @if(auth()->user()->sex == 1)
                        <img src="{{ asset('img/male.png') }}" width="24">
                    @elseif(auth()->user()->sex == 2)
                        <img src="{{ asset('img/female.png') }}" width="24">
                    @elseif(auth()->user()->sex == "")
                        <img src="{{ asset('img/user.png') }}" width="24">
                    @endif
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'admin.account.store', 'method' => 'POST','name'=>'form1','id'=>'personal_info','onsubmit'=>'return false;']) }}
                <div><i class="fa fa-dot-circle-o"></i> 圖像：
                    <input type="file" name="avatar" id="avatar_input">
                    <img id="avatar_review" class="rounded-circle" src="{{ asset('img/avatar.jpg') }}" alt="你的圖像" width="60" height="60" />
                </div>
                <br>
                <div>
                    <i class="fa fa-dot-circle-o"></i> 密碼：
                    {{ Form::password('old_password', ['id' => 'old_password1', 'class' => 'form-control','placeholder' => '舊密碼','required'=>'required']) }}
                    {{ Form::password('password1', ['id' => 'password1', 'class' => 'form-control','placeholder' => '新密碼','required'=>'required']) }}
                    {{ Form::password('password2', ['id' => 'password2', 'class' => 'form-control','placeholder' => '再一次新密碼','required'=>'required','onchange'=>'checkpwd()']) }}
                </div>
                <br>
                <div>
                    <i class="fa fa-dot-circle-o"></i> 暱稱：
                    {{ Form::text('nickname', auth()->user()->nickname, ['id' => 'nickname', 'class' => 'form-control', 'placeholder' => '暱稱']) }}
                </div>
                <br>
                <div>
                    <i class="fa fa-dot-circle-o"></i> 電子郵件：
                    {{ Form::email('email', null,['class' => 'form-control','placeholder' => '例：example.gmail.com']) }}
                </div>
                <br>
                <div>
                    <i class="fa fa-dot-circle-o"></i> 個人網站：
                    {{ Form::text('website', null, ['id' => 'website', 'class' => 'form-control', 'placeholder' => '例：http://www.example.com.tw( 含 http:// 或 https://)']) }}
                </div>
                <script>
                    function p_checkpwd()
                    {
                        with(document.all){
                            if(password1.value!=password2.value)
                            {
                                bbalert('兩次密碼不同！');
                                password1.value = "";
                                password2.value = "";
                            }
                        }
                    }
                    function p_checkpwd2()
                    {
                        with(document.all) {
                            if (password1.value == "" | password2.value == "") {
                                bbalert('密碼不得為空值！');
                                password1.value = "";
                                password2.value = "";
                                return false;
                            }else if(name.value == ""){
                                bbalert('姓名不得為空值！');
                            }else{
                                bbconfirm('store_account','你確定要新增嗎？');
                            }
                        }
                    }
                    function readURL(input) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                $('#avatar_review').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#avatar_input").change(function() {
                        readURL(this);
                    });
                </script>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                <button class="btn btn-success" type="button" data-dismiss="modal">儲存</button>
            </div>
        </div>
    </div>
</div>
@endif