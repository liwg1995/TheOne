@extends('master')
@section('title')
    错误页面
@stop
@section('content')
    <div class="container-fluid main-success">
        <div class="col-lg-12 success-png text-center">
            <b><span class="font-18">您的身份已过期,请重新登录</span></b>
        </div>

    </div>
    <script>
        $(function(){
            $.removeCookie('studentToken',{ path: '/' });
            setTimeout(function(){self.location="../../../"},2000);
        })
    </script>
    <style>
        .main-success{
            min-height: 800px;
        }
        .success-png{
            height: 200px;

        }
        .font-18{
            font-size: 18px;
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



