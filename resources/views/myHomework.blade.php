@extends('myInfo')
@section('title')
    我的课程
@endsection

@section('content-right')


    <div id="mycourse" class="panel panel-default">
        <div class="panel-heading">
            我的作业(请选择提交作业的课程)
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 course-block">
                        <a id="{{url("student/allHomework/".$course['id'])}}"
                           class="mouseover-pointer thumbnail goAllHomework">
                            <img src={{url($course['coursePicture'])}}>
                            <div class="caption text-center">
                                <h3 class="margin-top-10">{{$course['courseName']}}</h3>
                                <p class="font-14">{{$course['courseIntro']}}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
                <script>
                    $(function () {
                        $('.goAllHomework').click(function () {
                            var url = this.id;
                            window.location.href = url + '/' + $.cookie('studentToken');
                        })
                    })
                </script>
            </div>
        </div>
    </div>
    <style>
        .myHomework-btn a {
            color: #0e90d2;
        }
    </style>

@endsection


