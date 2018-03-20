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


                <form action="{{route('admin.action.update')}}" id="discount-save-form" method="post"
                      class="form-horizontal"
                      role="form">
                    {!! csrf_field() !!}
                    {{ method_field('PATCH') }}
                    <input type="hidden" value="{{$action->id}}" name="id"/>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label for="name" class="control-label col-md-4">نام فعالیت</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="{{old('name',$action->name)}}"
                                       name="name" id="name"/>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <label for="slug" class="control-label col-md-4">نامک فعالیت</label>
                            <div class="col-md-8">

                                <input type="text" class="form-control" value="{{old('slug',$action->slug)}}"
                                       name="slug" id="slug"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">

                            <label for="score" class="control-label col-md-4">امتیاز </label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" value="{{old('score',$action->score)}}"
                                       name="score" id="score"/>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <label for="description" class="control-label col-md-4">توضیحات</label>
                            <div class="col-md-8">
                                <textarea type="number" class="form-control"
                                          name="description"
                                          id="description">{{old('description', $action->description)}}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-4 text-left" for="status">فعالیت فعال نشود؟</label>
                        <div class="col-md-5">

                            <input type="checkbox" @if(old('status',false) || $action->status == 0) checked
                                   @endif name="status" id="status"
                                   value='0'>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light text-center">
                            <i class="fa fa-send m-r-5"></i>
                            <span>ذخیره تغییرات</span>
                        </button>

                        <a href="{{route('admin.action.index')}}">
                            <button type="button" class="btn btn-danger waves-effect waves-light text-center">
                                <span>بازگشت</span>
                            </button>
                        </a>
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection
