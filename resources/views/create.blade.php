@extends('base::layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/editor/css/editormd.css') }}">
@endpush

@section('content')
    <form class="form-horizontal form-bordered" method="post" action="{{ route('pages.store') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">基本信息</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label">页面标题</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="title"
                                       title="title"
                                       class="form-control"
                                       autocomplete="off"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">别名</label>
                            <div class="col-md-6">
                                <input type="text"
                                       name="slug"
                                       title="slug"
                                       class="form-control"
                                       autocomplete="off"
                                >
                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-2 control-label">页面内容</label>
                            <div class="col-md-10">
                                <div id="editormd"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">页面模版</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" name="template" class="form-control"/>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">排序</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" name="order" title="order" class="form-control" value="0"/>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">保存</h3>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-primary">确认保存</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script src="{{ asset('vendor/core/plugins/editor/editormd.js') }}"></script>
@endpush

@push('js')
<script>
    let editor = editormd({
        id: "editormd",
        height: 640,
        toolbarAutoFixed: false,
        path: "/vendor/core/plugins/editor/lib/",
        saveHTMLToTextarea: true,
    });
</script>
@endpush