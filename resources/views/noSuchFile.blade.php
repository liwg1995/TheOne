@extends('master')
@section('title')
    错误页面
@stop
@section('content')
    <div class="container main-success">
        <div class="col-lg-12 success-info"><span class="position-bottom" style="display: block">这次作业还没有同学上交,暂时不能打包下载</span></div>
    </div>
    <script>
        $(function(){
            setTimeout(function(){window.history.back();},1200);
        })
    </script>
    <style>
        .main-success{
            min-height: 800px;
        }
        .success-png{
            height: 200px;

        }
        .success-info{
            font-size: 30px;
            font-weight: 700;

        }
        .position-bottom{
            position: relative;
            top: 0px;
            line-height: 240px;
        }
    </style>
@endsection



