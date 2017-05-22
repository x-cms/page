@extends('base::layouts.master')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/core/plugins/grid/dlshouwen.grid.css') }}"/>
@endpush

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <div class="pull-left">
                <a class="btn btn-block btn-success" href="{{ route('pages.create') }}">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;新增
                </a>
            </div>
            <div class="pull-right">
                <form class="search-dtGrid-form" action="">
                    <div class="form-group">
                        <input type="text" id="keyword" name="keyword" class="form-control"
                               placeholder="" autocomplete="off">
                        <a href="javascript:;" class="btn btn-search"><i class="fa fa-search"></i></a>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-body no-padding">
            <div id="gridContainer"></div>
        </div>
        <div class="box-footer">
            <div id="gridToolBarContainer" class="grid-toolbar-container"></div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/core/js/confirm.js') }}"></script>
<script src="{{ asset('vendor/core/plugins/grid/dlshouwen.grid.js') }}"></script>
<script src="{{ asset('vendor/core/plugins/grid/i18n/zh-cn.js') }}"></script>
@endpush

@push('js')
<script>
    let dtGridColumns = [
        {id: 'title', title: '页面标题', fastQuery: true},
        {id: 'template', title: '页面模版'},
        {id: 'order', title: '排序'},
        {
            id: 'operation', title: '管理操作', resolution: function (value, record, column, grid, dataNo, columnNo) {
            return "<a href='pages/edit/" + record.id + "' class='btn btn-sm btn-warning m-r-5'><i class='fa fa-edit'></i>&nbsp;编辑&nbsp;</a>" +
                "<a href='javascript:;' class='btn btn-sm btn-danger' onclick='operateHandle.del(" + record.id + ")'><i class='fa fa-trash-o'></i>&nbsp;删除&nbsp;</a>";
        }
        }
    ];

    let dtGridOption = {
        lang: 'zh-cn',
        loadAll: true,
        loadURL: '{{ route('pages.index') }}',
        columns: dtGridColumns,
        tools: 'refresh|fastQuery',
    };

    let operateHandle = function () {
        function _del(id) {
            var tpl = '您确定要删除该角色吗?'
            $.Confirm({
                url: '/admin/pages/' + id,
                method: 'DELETE',
                data: {
                    Id: id
                },
                content: tpl
            });
        }

        return {
            del: _del
        }
    }();

    let grid = $.fn.dtGrid.init(dtGridOption);

    $(function () {
        grid.load();
    });
</script>
@endpush