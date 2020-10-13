<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ '* Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($degree->title) ? $degree->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('arabic_title') ? 'has-error' : ''}}">
    <label for="arabic_title" class="control-label">{{ '* Arabic Title' }}</label>
    <input class="form-control" name="arabic_title" type="text" id="arabic_title" value="{{ isset($degree->arabic_title) ? $degree->arabic_title : old('arabic_title')}}" >
    {!! $errors->first('arabic_title', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
