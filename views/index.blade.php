@extends("admin.layout.layout")
@section("title",'مدیریت فعالیت ها')


@section('content')

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon  glyphicon-arrow-down"></i>
                <span>افزودن فعالیت جدید</span>
            </div>
            <div class="panel-body">


                <form action="{{route('admin.action.store')}}" id="discount-save-form" method="post"
                      class="form-horizontal"
                      role="form">
                    {!! csrf_field() !!}


                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="name" class="control-label col-md-4">نام فعالیت</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{old('name')}}"
                                       name="name" id="name"/>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <label for="slug" class="control-label col-md-4">نامک فعالیت</label>
                            <div class="col-md-8">

                                <input type="text" class="form-control" value="{{old('slug')}}"
                                       name="slug" id="slug"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">

                            <label for="score" class="control-label col-md-4">امتیاز </label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" value="{{old('score')}}"
                                       name="score" id="score"/>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <label for="description" class="control-label col-md-4">توضیحات</label>
                            <div class="col-md-8">
                                <textarea type="number" class="form-control"
                                          name="description" id="description">{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-4 text-left" for="status">فعالیت فعال نشود؟</label>
                        <div class="col-md-5">

                            <input type="checkbox" @if(old('status',false)) checked @endif name="status" id="status"
                                   value='0'>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light text-center">
                            <i class="fa fa-send m-r-5"></i>
                            <span>ثبت</span>
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class=""></i>
                <span>لیست فعالیت ها</span>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <div class="col-xs-10">
                        <input class="form-control" id="system-search" name="q" placeholder="جستجو">
                    </div>


                </div>
                <br><br>
                <div class="form-group">
                    <table class="table table-list-search food-table-custom text-center">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">نام فعالیت</th>
                            <th class="text-center">نامک فعالیت</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">امتیاز</th>
                            <th class="text-center"> تاریخ ساخت</th>
                            <th class="text-center">تاریخ آخرین تغییر</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center"> عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($actions as $key => $action)
                            <tr>
                                <td>{{($key+1)}}</td>
                                <td>
                                    {{$action->name}}
                                </td>
                                <td>
                                    <span>{!!  $action->slug!!}</span>
                                </td>

                                <td>
                                    <span>{{$action->description}}</span>
                                </td>
                                <td>
                                    <span>{!!  $action->getScore()!!}</span>
                                </td>
                                <td>
                                    <span>{{$action->getCreatedAt()}}</span>
                                </td>
                                <td>
                                    <span>{{$action->getUpdatedAt()}}</span>
                                </td>
                                <td>
                                    {!! $action->getStatus() !!}
                                </td>
                                <td>
                                    {!! $action->getAction() !!}
                                    &nbsp;&nbsp;
                                    <a href="{{route('admin.action.edit',$action->id)}}">
                                        <i class='glyphicon glyphicon-pencil text-primary' style='cursor: pointer'
                                           data-toggle='tooltip' data-placement='top' data-original-title='ویرایش'> </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="statusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="panel panel-color panel-custom">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="panel-title text-center"  id="modal_title"></h2>
                </div>
                <div class="panel-body"  id="modal_message">

                </div>
                <div class="modal-footer">
                    <div class="form-group text-right">
                        <form action="{{route('admin.action.change.status')}}" method="post" id="_form">
                            {{csrf_field()}}
                            <input type="hidden" value="" id="action_id" name="action_id" />
                            <input type="hidden" value="" id="_status" name="status" />
                            <button type="submit" data-action="add"
                                    class="btn btn-danger">
                                <span id="modal_btn_text"></span>
                            </button>
                            <button type="button" data-dismiss="modal" class=" btn btn-white">
                                <span>بازگشت</span>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div><!-- /.modal-dialog -->
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var activeSystemClass = $('.list-group-item.active');
            $('#system-search').keyup(function () {
                var that = this;
                var tableBody = $('.table-list-search tbody');
                var tableRowsClass = $('.table-list-search tbody tr');
                $('.search-sf').remove();
                tableRowsClass.each(function (i, val) {
                    var rowText = $(val).text().toLowerCase();
                    var inputText = $(that).val().toLowerCase();
                    if (rowText.indexOf(inputText) == -1) {
                        tableRowsClass.eq(i).hide();
                    }
                    else {
                        $('.search-sf').remove();
                        tableRowsClass.eq(i).show();
                    }
                });
                if (tableRowsClass.children(':visible').length == 0) {
                    tableBody.append('<tr class="search-sf"><td colspan="6">نتیجه ای یافت نشد!</td></tr>');
                }
            });
        });
    </script>
    <script type="application/javascript">

        $(document).ready(function () {
//            $("#discount-save-form").submit(function () {
//                return false;
//
//            })//todo:complete this

            $('i[name=action]').click(function () {


                if ($(this).data('status') == 0) {

                    $('#modal_title').html("غیر فعال کردن");
                    $('#modal_message').html("مطمئنید می خواهید این فعالیت را غیر فعال کنید؟");
                    $('#modal_btn_text').html("غیر فعال کردن");
                } else if ($(this).data('status') == 1) {

                    $('#modal_message').html("مطمئنید می خواهید این فعالیت را فعال کنید؟");
                    $('#modal_title').html(" فعال کردن");
                    $('#modal_btn_text').html("فعال کردن");

                }

                $('#_status').val($(this).data('status'));
                $('#action_id').val($(this).data('id'));
                $('#statusModal').modal('show');

            });
        });

    </script>
@endsection