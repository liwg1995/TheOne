@extends('master')
@section('title')
    全部课程
@endsection

@section('content')
    <div class="min-height-800">
        <div class="container margin-top-10">
            <div class="margin-bottom-20"><h2>我的空间</h2></div>
            <div id="myinfo" class="panel panel-default">
                <div class="panel-heading">
                    <span>我的信息<span class="pull-right mouseover-pointer"><a>修改密码</a></span></span>

                </div>
                <div class="panel-body">
                    <p>姓名：<span id="studentName"></span></p>
                    <p>班级：<span id="className"></span></p>
                    <hr/>
                    <span>页面导航</span>
                    <hr/>
                    <div class="margin-left-20">
                        <p class="mouseover-pointer mySpace-button myCourse-btn"><a class="">我的课程</a></p>
                    </div>
                    <div class="margin-left-20">
                        <p class="mouseover-pointer homework myHomework-btn"><a>提交作业</a></p>
                    </div>
                    <div class="panel-heading"></div>
                    <div class="text-center hidden">
                        <button type="button" class="btn btn-primary">
                            未读消息
                            <span class="badge">3</span>
                        </button>
                        <button type="button" class="btn btn-success">
                            待交作业
                            <span class="badge">2</span>
                        </button>
                    </div>
                    <hr class="hidden"/>
                    <div class="list-group hidden">
                        <a href="#" class="list-group-item">样式一<span class="pull-right">&gt;</span></a>
                        <a href="#" class="list-group-item">样式一<span class="pull-right">&gt;</span></a>
                        <a href="#" class="list-group-item">样式一<span class="pull-right">&gt;</span></a>
                    </div>

                </div>
            </div>
            @yield('content-right')
        </div>
        <script>
            $(function () {
                var stuInfo = [];
                var url = '../../../../../student/getStudentInfo' + '/' + $.cookie('studentToken');
                $.ajax(url,
                        {
                            type: 'POST',
                            contentType: 'application/json',
                            data: '',
                            dataType: 'json',

                        }).done(function (data) {
                            if (data.status == 'OK') {
                                stuInfo = data.content;
                                $('#studentName').text(stuInfo.studentName);
                                $('#className').text(stuInfo.className);
                            } else {
                                alert("未登陆");
                                location.href = "/";

                            }
                        }
                );


                $('.homework').click(function () {
                    location.href = "../../../../../student/myHomework/" + $.cookie('studentToken');
                })
                $('.mySpace-button').click(function () {
                    if ($.cookie('studentToken')) {
                        location.href = "../../../student/mySpace/" + $.cookie('studentToken');
                    } else {
                        alert("请登录");

                    }
                });
            })
        </script>

    </div>

@endsection


