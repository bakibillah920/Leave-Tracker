<div class="panel-body">
    <input type="hidden" name="id" value="{{$userInfo->id}}">
    <div class="form-group">
        <label for="name" class="control-label"><?= trans('Name') ?> <span class="required">*</span></label>
        <div class="input-group" style="width: 100%">
            <input type="text" class="form-control" name="name" value="{!! $userInfo->name !!} "autocomplete="off" />
        </div>
        <span class="error"></span>
    </div>
    <div class="form-group">
        <label for="email" class="control-label"><?= trans('Email') ?> <span class="required">*</span></label>
        <div class="input-group" style="width: 100%">
            <input type="email" class="form-control" name="email" value="{!! $userInfo->email !!} "autocomplete="off" />
        </div>
        <span class="error"></span>
    </div>
</div>
<footer class="panel-footer">
    <div class="text-right">
        <button type="submit" class="btn btn-default mr-xs" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing"><?= trans('Update') ?></button>
        <button class="btn btn-default modal-dismiss"><?= trans('Close') ?></button>
    </div>
</footer>