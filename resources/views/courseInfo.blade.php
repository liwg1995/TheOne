
@extends('master')
@section('title')
   TheyOne
@endsection

@section('content')
<main>
    <div class="container-fluid courseInfo-banner" style="background-image: url('{{url($course['coursePicture'])}}')";>
        <div class=" course-banner-title">
            <h2>{{$course['courseName']}}</h2>
            {{--/Users/zeaone/MyProjects//app/storage/uploads/4f7ce11fe75a8411cf5509184ccde80c.jpg--}}
        </div>
        {{--<div class="course-extra text-center pull-left">--}}

           {{--<a class="follow glyphicon glyphicon-heart-empty" id="follow">关注</a>--}}
        {{--</div>--}}
    </div>
    <div class="container courseInfo-main">
        <div class="col-lg-8">
            <div class="row">
                <div class="courseInfo-main-intro">
                    <h4>课程介绍</h4>

                    <p>{{$course['courseIntro']}}</p>
                </div>
                <hr>
                <div>
                    <h4>章节列表</h4>
                        <div class="courseInfo-list">

                            <ul class="am-list admin-sidebar-list" id="collapase-nav-1">
                                @for($i = 0 ;$i<count($chapters);$i++)
                                <li class="am-panel">
                                    <a data-am-collapse='{parent: "#collapase-nav-1", target: "#user-nav{{$i}}"}'>
                                        <i class="am-icon-file am-margin-left-sm"></i> {{$chapters[$i]['chapterName']}} <i class="am-icon-angle-right am-fr am-margin-right"></i>
                                    </a>
                                    <ul class="am-list am-collapse admin-sidebar-sub" id="user-nav{{$i}}">
                                        @foreach($sections[$i] as $section)
                                        <li><a id="{{url("course/watchVideo/".$section['id'])}}" class="goNext"><i class="am-icon-film am-margin-left-sm "></i>{{$section['sectionName']}} </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                    @endfor
                            </ul>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-lg-offset-1">
            <div class="row">
                <h4>本课作业</h4>
                @foreach($homeworks as $homework)
                    <span>{{$homework['homeworkName']}}</span>
                    <a id="{{$homework['homeworkAddress']}}" class="downloadFile pull-right mouseover-pointer">下载</a><br>

            @endforeach
                <hr/>
            </div>
        </div>
    </div>
</main>
    <style>
        #collapase-nav-1 li a{
            color: #000000;
            text-decoration: none;
        }
        .courseInfo-main p{
            line-height: 24px;
        }
        .courseInfo-banner{
            height: 240px;
            background-size: cover;
            background-repeat: no-repeat;

        }
        .courseInfo-main{
            margin-top: 60px;
            min-height: 800px;
        }
        .course-banner-title{
            margin-top: 30px;
            margin-left:60px;
            color: #FFFFFF;
        }
        .course-extra{
           margin-top: 140px;
            margin-left: 60px;
            width: 100px;
        }
        .course-extra a{
          text-decoration: none;
            font-size: 18px;
            line-height: 20px;
            color: #BBBBBB;
        }
        .course-extra a:hover{

            color: rgb(250,0,63) ;
            cursor:pointer;
        }
        .courseInfo-list{
            margin-top: 60px;
        }
        .goNext{
            cursor: pointer;
        }
    </style>
    <script>
        $(function(){
//            $('#follow').click(function(){
//                if($('#follow').hasClass("glyphicon glyphicon-heart-empty")) {
//                    $('#follow').removeClass("glyphicon glyphicon-heart-empty");
//                    $('#follow').addClass("glyphicon glyphicon-heart");
//                    $('#follow').css("color", "rgb(250,0,63)");
//                    $('#follow').text("已关注");
//                }else{
//                    $('#follow').removeClass(" glyphicon glyphicon-heart");
//                    $('#follow').addClass("glyphicon glyphicon-heart-empty");
//                    $('#follow').css("color", "#bbbbbb");
//                    $('#follow').text("关注");
//                }
//            });
        })
    </script>
    <script>
        $(function(){
            $('.goNext').click(function(){
                var url = this.id;
                window.location.href = url+'/'+$.cookie('studentToken');
            })
            $('.downloadFile').click(function(){
                var url = this.id;
                var urlArr = url.split('/');
                url = urlArr[urlArr.length-1];
                window.location.href = '../../../downloadFile/getDownloadFile/'+url+'/'+$.cookie('studentToken');
            })
        })
    </script>
@endsection


