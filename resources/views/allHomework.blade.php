@extends('myInfo')
@section('title')
    我的课程
@endsection

@section('content-right')


    <div id="mycourse" class="panel panel-default">
        <div class="panel-heading">
            所有作业
        </div>
        <div class="panel-body">
            <div class="row margin-left-20">
                <div class="row">
                <div class="text-left"><b class="text-danger text-center font-16">未提交的作业</b></div><hr />
                <table class="table ">
                    <tr>
                        <th>作业名称</th>
                        <th>下载</th>
                        <th>截止日期</th>
                        <th>是否提交</th>
                        <th>得分</th>
                        <th>评语</th>
                        <th>操作</th>
                    </tr>
                    @foreach($homeworks as $homework)
                        @if($homework['expiredTime']>= \Carbon\Carbon::now()&&$homework['isSubmit']=="否")
                        <tr>
                            <td>{{$homework['homeworkName']}}</td>
                            <td><a id="{{$homework['homeworkAddress']}}" class="mouseover-pointer downloadFile">下载</a></td>
                            <td>{{$homework['expiredTime']}}</td>
                            <td>{{$homework['isSubmit']}}</td>
                            <td>{{$homework['score']}}</td>
                            <td>{{$homework['comment']}}</td>
                            <td class="mouseover-pointer">
                                <a class="btn btn-info dialog_link_subHomework" id="{{$homework['id']}}">提交作业</a></td>
                        </tr>
                        @endif
                    @endforeach
                </table>
                </div>
                <hr />
                <div class="row">
                    <div class="text-left"><b class="text-danger text-center font-16">已提交的作业</b></div><hr />
                    <table class="table ">
                        <tr>
                            <th>作业名称</th>

                            <th >截止日期</th>
                            <th>是否提交</th>
                            <th>操作</th>
                        </tr>
                        @foreach($homeworks as $homework)
                            @if($homework['isSubmit']=='是')
                                <tr>
                                    <td>{{$homework['homeworkName']}}</td>
                                    <td>{{$homework['expiredTime']}}</td>
                                    <td>{{$homework['isSubmit']}}</td>
                                    <td class="mouseover-pointer">
                                        <a class="btn btn-info dialog_link_subHomework" id="{{$homework['id']}}">重新提交</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
                <hr />
                <div class="row">
                    <div class="text-left"><b class="text-danger text-center font-16">过期的作业</b></div><hr />
                    <table class="table ">
                        <tr>
                            <th>作业名称</th>

                            <th >截止日期</th>
                            <th>是否提交</th>
                        </tr>
                        @foreach($homeworks as $homework)
                            @if($homework['expiredTime'] <= \Carbon\Carbon::now()&&$homework['isSubmit']=='否')
                                <tr>
                                    <td>{{$homework['homeworkName']}}</td>
                                    <td>{{$homework['expiredTime']}}</td>
                                    <td>{{$homework['isSubmit']}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>

                <script>
                    $(function () {
                        $('#form_homework').attr('action', '../../../../upload/submitHomework/' + $.cookie('studentToken'));
                        $('.dialog_link_subHomework').click(function () {
                            $('#dialog_homework').addClass('show');
                            $('#dialog_homework').removeClass('hidden');
                            $('#homework_id').val($(this).attr('id'));
                        });
                        $('#homework-cancel').click(function () {
                            $('#dialog_homework').addClass('hidden');
                            $('#dialog_homework').removeClass('show');
                        })
                        $('.downloadFile').click(function(){
                            var url = this.id;
                            var urlArr = url.split('/');
                            url = urlArr[urlArr.length-1];
                            window.location.href = '../../../downloadFile/getDownloadFile/'+url+'/'+$.cookie('studentToken');
                        })
                    })
                </script>
            </div>
        </div>
    </div>


    <div id="dialog_homework" class="text-center hidden">
        <form enctype="multipart/form-data" action="" method="post" id="form_homework">
            <div class="form-group text-center margin-top-20">
                <label for="exampleInputFile">请选择要提交的作业</label><br>
                <span for="exampleInputFile">(只能提交压缩文件)</span>
                <hr>
                <input type="hidden" value="" name="homework_id" id="homework_id"/>
                <input type="file" name="myHomework" id="file" class="margin-left-100 margin-top-10">
            </div>
            <hr>
            <div class="margin-top-20">
                <button type="submit" class="btn btn-info" id="homework-submit">提交</button>
                <button type="button" class="btn btn-default" id="homework-cancel">取消</button>
            </div>
        </form>
    </div>
    <style>
        .myHomework-btn a {
            color: #0e90d2;
        }
        .font-16{
            font-size: 18px;
        }
        #dialog_homework {
            width: 450px;
            height: 240px;
            border: 1px solid black;

            background-color: white;
            position: fixed;
            left: 600px;
            top: 200px;
            border-radius: 5px;
            z-index: 10001;
        }

    </style>

@endsection


