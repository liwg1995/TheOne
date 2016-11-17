
@extends('master')
@section('title')
    全部课程
@endsection

@section('content')
<main>
    <div class="container">
    <div class="course-main-title">
        <strong><h4>全部课程</h4></strong>
        <hr/>
    </div>


    <div class="all-course-name">
            <div><span>课程名字:</span><br>
                <div>
                    <ul class="">

                        <li class="course-nav-item ">
                            <a href="" data-id="7" data-ct="fe">HTML/CSS</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="44" data-ct="fe">JavaScript</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="1262" data-ct="fe">CSS3</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="221" data-ct="fe">Html5</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="219" data-ct="fe">jQuery</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="1123" data-ct="fe">AngularJS</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="222" data-ct="fe">Node.js</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="1263" data-ct="fe">Bootstrap</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="1260" data-ct="fe">WebApp</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="1261" data-ct="fe">前端工具</a>
                        </li>
                        <li class="course-nav-item ">
                            <a href="" data-id="1" data-ct="be">PHP</a>
                        </li>


                    </ul>
                </div>

            </div>

        <style>
            .all-course-name ul{
                list-style: none;

            }
            .all-course-name ul li{
                float: left;
                margin-left: 40px;
               line-height: 30px;

            }
            .all-course-name ul li a{
               color: #777;
                text-decoration: none;

            }
            .all-course-name span{

                margin-left: 20px;




            }
            #menu-main li:first-child{
                background-color:rgb(250,0,63) ;
            }
            .dis-page-nav{

            }
        </style>
    </div>
    <div class="all-course clearfix"></div>
<hr>
    <div class="all-course-info text-center">
        <div class="all-course-title text-left">
            <h4>课程信息</h4>



            <hr>
        </div>
        <div class="col-lg-12 visible-lg">
        <div class="row">

            @for($i =0;$i<10;$i++ )
            <div class="col-lg-3 course-feature">
                <a href='{{url("course/showCourseInfo/$i")}}'>
                <img src="{{url('img/banner-1.jpg')}}">
                <h5>HTML+CSS基础课程</h5>
                <p>介绍介绍一大堆多撒点哈看电话卡大家阿克索德哈快的大声讲电话讲啊电话卡圣诞贺卡我就饿啊打卡圣诞节介绍啥的</p>
                </a>
            </div>

           @endfor
        </div>
        </div>
        <div class="col-md-12 visible-md">
            <div class="row">

                @for($i =0;$i<10;$i++ )
                    <div class="col-md-4 course-feature">
                        <a href="http://baidu.com">
                            <img src="{{url('img/banner-1.jpg')}}">
                            <h5>HTML+CSS基础课程</h5>
                            <p>介绍介绍一大堆多撒点哈看电话卡大家阿克索德哈快的大声讲电话讲啊电话卡圣诞贺卡我就饿啊打卡圣诞节介绍啥的</p>
                        </a>
                    </div>

                @endfor
            </div>
        </div>
        <div class="col-xs-12 visible-sm">
            <div class="row">

                @for($i =0;$i<10;$i++ )
                    <div class="col-xs-6 course-feature">
                        <a href="http://baidu.com">
                            <img src="{{url('img/banner-1.jpg')}}">
                            <h5>HTML+CSS基础课程</h5>
                            <p>介绍介绍一大堆多撒点哈看电话卡大家阿克索德哈快的大声讲电话讲啊电话卡圣诞贺卡我就饿啊打卡圣诞节介绍啥的</p>
                        </a>
                    </div>

                @endfor
            </div>
        </div>

        <div class="col-xs-12 visible-xs">
            <div class="row">

                @for($i =0;$i<10;$i++ )
                    <div class="col-xs-12 course-feature">
                        <a href="http://baidu.com">
                            <img src="{{url('img/banner-1.jpg')}}">
                            <h5>HTML+CSS基础课程</h5>
                            <p>介绍介绍一大堆多撒点哈看电话卡大家阿克索德哈快的大声讲电话讲啊电话卡圣诞贺卡我就饿啊打卡圣诞节介绍啥的</p>
                        </a>
                    </div>

                @endfor
            </div>
        </div>



        <div class="dis-page-nav ">
            <nav>
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>


    </div>



    <style>
        .all-course-info img{
            width: 200px;
        }
        .all-course-info p{
            font-size: 13px;
            color: #BBBBBB;
            width: 200px;
            display: inline-block;
        }
        .course-feature:hover img{
            transform:scale(1.1,1.1);
            transition-duration:0.5s;
        }
        .course-feature{
            overflow: hidden;
        }
    </style>
    </div>
</main>
@endsection


