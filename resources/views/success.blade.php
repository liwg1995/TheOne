@extends('master')
@section('title')
    成功页面
@stop
@section('content')
    <div class="container main-success">
        <div class="col-lg-2 success-png" style="background:url({{url('img/success.png')}}); background-size: 150px; background-repeat: no-repeat"></div>
        <div class="col-lg-10 success-info"><span class="position-bottom" style="display: block">操作成功,正在跳转...</span></div>
    </div>
    <script>
        $(function(){
            setTimeout(function(){self.location=document.referrer;},2000);
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



