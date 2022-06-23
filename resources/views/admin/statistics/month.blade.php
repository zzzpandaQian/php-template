<div class="statistic_result">
    <form class="form-inline">
        <div class="form-group">
            <input type="input" id="filter-month" class="form-control" placeholder="请选择日期">
        </div>
        <div class="form-group">
            <button type="button" id="filter-btn" class="btn btn-primary"><i class="feather icon-search"></i> 筛选</button>
        </div>
        <div class="form-group">
            <a class="btn btn-danger" href=""><i class="feather icon-refresh-cw"></i> 重置</a>
        </div>
    </form>
</div>

<style>
    .statistic_result .form-group {
        margin-left: 10px;
    }

</style>

<script require="@select2,@moment,@bootstrap-datetimepicker">
    $('#filter-month').datetimepicker({
        format: 'YYYY-MM',
        locale: 'zh-cn',
    });
</script>
