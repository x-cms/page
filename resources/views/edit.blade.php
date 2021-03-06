@extends('base::layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/core/plugins/editor/css/editormd.css') }}">
@endpush

@section('content')
    <form class="form-horizontal form-bordered" method="post" action="{{ route('pages.update', ['id' => $page->id]) }}">
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
                                       value="{{ $page->title }}"
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
                                       value="{{ $page->slug }}"
                                >
                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-2 control-label">页面内容</label>
                            <div class="col-md-10">
                                <div id="editormd">
                                    <textarea class="editormd-html-textarea" name="editormd-html-code">{{ $page->content }}</textarea>
                                </div>
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
                        <select name="template" class="form-control select2">
                            <option value="">请选择...</option>
                            @foreach($templates as $key => $template)
                                <option value="{{ $key }}" {{ $page->template == $key ? 'selected' : '' }}>{{ $template }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">排序</h3>
                    </div>
                    <div class="box-body">
                        <input type="text" name="order" title="order" class="form-control" value="{{ $page->order }}"/>
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
<script src="//cdn.bootcss.com/select2/4.0.3/js/select2.min.js"></script>
<script src="//cdn.bootcss.com/select2/4.0.3/js/i18n/zh-CN.js"></script>
@endpush

@push('js')
<script>
    $('select').select2({
        language: "zh-CN"
    });

    let editor = editormd({
        id: "editormd",
        height: 640,
        toolbarAutoFixed: false,
        path: "/vendor/core/plugins/editor/lib/",
        saveHTMLToTextarea: true,
        htmlDecode : true
    });
</script>
@endpush