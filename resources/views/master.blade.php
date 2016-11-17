<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"content="">
    <meta name="description"content="">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.5.0/css/amazeui.min.css">
    <script src=" http://cdn.amazeui.org/amazeui/2.5.0/js/amazeui.min.js"></script>
    <script src=" http://cdn.amazeui.org/amazeui/2.5.0/js/amazeui.ie8polyfill.min.js"></script>
    <script src=" http://cdn.amazeui.org/amazeui/2.5.0/js/amazeui.widgets.helper.min.js"></script>
    <script src="http://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="http://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>



    <script src="//cdn.bootcss.com/jquery-ui-bootstrap/0.5pre/assets/js/bootstrap.min.js"></script>
    <link href="//cdn.bootcss.com/jquery-ui-bootstrap/0.5pre/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery-ui-bootstrap/0.5pre/js/jquery-ui-1.9.2.custom.min.js"></script>

    <style type="text/css" rel="css/style.css"></style>
    <link href="http://cdn.bootcss.com/video.js/5.8.0/alt/video-js-cdn.css" rel="stylesheet">

    <!-- If you'd like to support IE8 -->
    <script src="http://cdn.bootcss.com/video.js/5.8.0/ie8/videojs-ie8.js"></script>

    <script language="JavaScript" src="{{url('js/student.js')}}"></script>
    <style>
            .li-active{

                background-color: RGB(246,61,102);

            }
    </style>

</head>
<body>
<div class="body-cover">
<nav class="navbar  navbar-border navbar-backgrnd navbar-padding-margin">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" id="btn-xs" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                <span class="icon-bar" ></span>
                <span class="icon-bar" ></span>
                <span class="icon-bar" ></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}" id="logo">
                <img src="{{url('img/theyonelogo-black.png')}}" >
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav " id="menu-main">

                {{--<li class=""><a href="{{url('course/showALLCourse')}}" id="allCourse"> 课程</a></li>--}}
                {{--<li class=""><a href="" > 测试</a></li>--}}
                {{--<li><a href="#" > 登录</a></li>--}}


            </ul>

            <ul class="nav navbar-nav navbar-right hidden-xs menu">
                <li><a href="#" id="mySpace-button">我的空间</a></li>
                <li><a href="#" id="login-button" > 登录</a></li>
                <li ><a class="hidden" href="#" id="logout-button" >退出</a></li>



            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div id="login-register" class="visible-lg">

    <div class="login-register-main" style="display: none">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist"style="border: none;" >
            <li role="presentation" class="active" ><a href="#home" aria-controls="home" role="tab" data-toggle="tab" >登录</a></li>
            <li id="close-loginPage" style='background-image: url({{url('img/close.png')}})' class="col-xs-2"></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" tyle="border: none">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="container">
                <div class="row">
                <div class="col-lg-4" >

                <form class="form-horizontal">

                <div class="form-group">

                <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" placeholder="用户名" >
                </div>
                </div>
                <div class="form-group">
                <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="密码">
                </div>
                </div>

                <hr>
                <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                <a tabindex="0" class="btn  btn-danger btn-md" role="button" data-toggle="popover" data-trigger="focus"
                title="您填写的信息有误" id="submit">提交</a>

                </div>
                </div>

                </form>

                </div>



                </div>
                </div>

            </div>

        </div>

    </div>
    <style>

    </style>

<script>
    $(function(){

        $('#login-button').click(function(){
            $('.login-register-main').show();
            $('#login-register').css("border","1px solid #BBBBBB");
            $('.nav-tabs li').eq(1).removeClass('active');
            $('.nav-tabs li a').eq(0).trigger("click");
            $('.nav-tabs li').eq(0).addClass('active');

        });
        $('#close-loginPage').click(function(){
            $('.login-register-main').hide();
            $('#login-register').css("border","none");
        });

        //登陆
        $('#submit').click(function(){
            var studentNum ;
            var password;
            var data;
            studentNum = $('#username').val();
            password = $('#password').val();
            data = {
                studentNum:studentNum,
                password:password
            }
            var a = JSON.stringify(data);

            $.ajax('../../../../../../../../../api/login/studentLogin',
                    {
                        type: 'POST',
                        contentType: 'application/json',
                        data: a,
                        dataType: 'json',

                    }).done(function (data) {
                        if(data.status=='OK'){
                            $.cookie('studentToken',data.content.token , {expires: 1, path:'/'});
                            location.href = "../student/mySpace/"+$.cookie('studentToken');

                        }else{
                            alert("用户名或者密码填错了");
                        }
                    }
            );
        });
        //退出
        $('#logout-button').click(function(){

            var studentTokenData = {
                studentToken:$.cookie('studentToken')
            }
            var studentToken = JSON.stringify(studentTokenData);

            $.ajax('../../../../../api/login/studentLogout',
                    {
                        type: 'POST',
                        contentType: 'application/json',
                        data: studentToken,
                        dataType: 'json',

                    }).done(function (data) {
                        if(data.status=='OK'){
                            location.href = "/";
                        }else{

                            alert("未登陆");

                        }
                    }
            );
            $.removeCookie('studentToken',{ path: '/' });

        });


        //mySpace
        $('#mySpace-button').click(function(){
            if($.cookie('studentToken')){
                location.href = "../../../student/mySpace/"+$.cookie('studentToken');
            }else{
                alert("请登录");
            }
        });
    })
</script>
</div>






@yield('content')

<footer class="footer">
    <div class="container col-md-12 text-center" id="foot-container">
        codeByZeaone
    </div>
</footer>
<style>

</style>
</div>
</body>
</html>
