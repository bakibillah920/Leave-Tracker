<div class="panel-body">
    <input type="hidden" name="id" value="{{$userInfo->id}}">
    <div class="form-group">
        <label for="password" class="control-label"><?= trans('Password') ?> <span class="required">*</span></label>
        <div class="input-group">
            <input type="password" class="form-control password" name="password" id="password" autocomplete="off" />
            <span class="input-group-addon">
                <a href="javascript:void(0);" id="showPassword" ><i class="fas fa-eye"></i></a>
            </span>
        </div>
        <span class="error"></span>
        
    </div>
    <div class="form-group">
        <label for="password" class="control-label"><?= trans('Retype Password') ?> <span class="required">*</span></label>
        <div class="input-group">
            <input type="password" class="form-control password" name="password_confirmation" id="password_confirmation" autocomplete="off" />
            <span class="input-group-addon">
                <a href="javascript:void(0);" id="cshowPassword" ><i class="fas fa-eye"></i></a>
            </span>
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