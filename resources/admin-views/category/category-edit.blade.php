@extends('admin::layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">编辑</h3>
                <div class="box-tools">
                    <div class="btn-group pull-right" style="margin-right: 10px">
                        <a href="{{ route('admin::categorys.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                    </div> <div class="btn-group pull-right" style="margin-right: 10px">
                        <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                    </div>
                </div>
            </div>
            <form id="post-form" class="form-horizontal" action="{{ route('admin::categorys.update', $category->id) }}" method="post" enctype="multipart/form-data" pjax-container>
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="box-body">
                    <div class="fields-group">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">栏目名字</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input type="text" id="title" name="title" value="{{$category->title}}" class="form-control" placeholder="输入 栏目名">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="label" class="col-sm-2 control-label">栏目标签</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                    <input type="text" id="label" name="label" value="{{$category->label}}" class="form-control" placeholder="输入 标签名">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="covers" class="col-sm-2 control-label">栏目图片</label>
                            <div class="col-sm-8">
                                <input type="file" class="image" name="image" id="covers" multiple accept="image/*">
                                <label class="col-sm-3 control-label text-muted">建议使用105*100比例的图片</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="original_price" class="col-sm-2 control-label">排序</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="sort" name="sort" value="{{$category->sort}}" class="form-control " placeholder="输入 排序">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box-footer">
                    <div class="btn-group pull-left">
                        <button type="reset" class="btn btn-warning">重置</button>
                    </div>
                    <div class="btn-group pull-right">
                        <button type="submit" id="submit-btn" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i> 提交">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $('.form-history-back').on('click', function (event) {
            event.preventDefault();
            history.back();
        });

        ///
        var previewConfigs = [];
        var urls = [];
        var j = {};
        j.downloadUrl = "{{  $category->image}}";
        j.key = "{{ $category->id }}";
        previewConfigs.push(j);
        urls.push(j.downloadUrl);


        $(".image").fileinput({
            overwriteInitial: false,
            initialPreviewAsData: true,
            initialPreview: urls,
            browseLabel: "浏览",
            showRemove: false,
            showUpload: false,
            allowedFileTypes: [
                "image"
            ]
        });

        $("#submit-btn").click(function () {
            var $form = $("#post-form");

            $form.bootstrapValidator('validate');
            if ($form.data('bootstrapValidator').isValid()) {
                $form.submit();
            }
        })
    });
</script>
@endsection