
@extends('master')
@section('title')
    TheyOne
@endsection

@section('content')
  <main>
      <div class="container">
            <div>
                <h2>{{$section['sectionName']}}</h2>
            </div>
          <div class="col-lg-10 col-xs-12 col-lg-offset-1 video">
              <video id="my-video" class="video-js" controls preload="auto" width="1000" height="500"
                     poster="MY_VIDEO_POSTER.jpg" data-setup="{}">
                  <source src="{{url($section['videoAddress'])}}" type='video/mp4'>
                  <p class="vjs-no-js">
                      您的浏览器不支持此播放器
                      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                  </p>
              </video>

          </div>
          <div class="video-info col-xs-12">
              <div class="col-lg-6 resource" >
                    <h3>资料下载</h3>
                    <hr/>
                  @foreach($resources as $resource)
                      <span>{{$resource['resourceName']}}</span>
                    <a id="{{$resource['resourceAddress']}}" class="downloadFile pull-right mouseover-pointer">下载</a><br>
                      @endforeach
              </div>
              <div class="col-lg-4 col-lg-offset-2 communicate">
                  <div class="min-height-300">
                      <h3>讨论区</h3>
                      <hr/>
                  </div>
                  <div class="form-group">
                      <textarea class="form-control" id="courseIntro" ng-model="course.courseIntro" placeholder="输入讨论内容"></textarea>
                      <button class="btn btn-sm pull-right margin-top-10 btn-info">提交</button>
                  </div>
              </div>

          </div>
      </div>
      <style>
          .video{
              height: 500px;
          }
          .resource{
              min-height: 600px;

          }
          .video-info{
              margin-top: 60px;


          }
          .communicate{

              min-height: 600px;
          }
          .download:hover{
              cursor: pointer;
          }
      </style>
      <script>
          $(function(){
              $('.downloadFile').click(function(){
                  var url = this.id;
                  var urlArr = url.split('/');
                  url = urlArr[urlArr.length-1];
                  window.location.href = '../../../downloadFile/getDownloadFile/'+url+'/'+$.cookie('studentToken');
              })
          })
      </script>
      <script src="http://cdn.bootcss.com/video.js/5.8.0/video.js"></script>
  </main>
@endsection


