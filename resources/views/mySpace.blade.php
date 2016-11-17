@extends('myInfo')
@section('title')
    我的课程
@endsection

@section('content-right')


        <div id="mycourse" class="panel panel-default">
            <div class="panel-heading">
                我的课程
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-sm-4 col-xs-4 col-md-4 col-lg-4 course-block">
                        <a id="{{url("course/showCourseInfo/".$course['id'])}}"  class="mouseover-pointer thumbnail goNext">
                            <img src={{url($course['coursePicture'])}}>
                            <div class="caption text-center">
                                <h3 class="margin-top-10">{{$course['courseName']}}</h3>
                                <p class="font-14">{{$course['courseIntro']}}</p>
                            </div>
                        </a>
                    </div>
                        @endforeach
                        <script>
                            $(function(){
                                $('.goNext').click(function(){
                                    var url = this.id;
                                    window.location.href = url+'/'+$.cookie('studentToken');
                                })
                            })
                        </script>
                </div>
            </div>
        </div>
    <style>
        .myCourse-btn a{
            color:#0e90d2;
        }
    </style>


@endsection


