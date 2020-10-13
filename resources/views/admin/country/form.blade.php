<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ '* Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($country->title) ? $country->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('arabic_title') ? 'has-error' : ''}}">
    <label for="arabic_title" class="control-label">{{ '* Arabic Title' }}</label>
    <input class="form-control" name="arabic_title" type="text" id="arabic_title" value="{{ isset($country->arabic_title) ? $country->arabic_title : old('arabic_title')}}" >
    {!! $errors->first('arabic_title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('img_url') ? 'has-error' : ''}}">
    <label for="img_url" class="control-label">{{ '* Image' }}</label>
    <input class="form-control" name="img_url" type="file" id="img_url" value="{{ isset($country->img_url) ? $country->img_url : old('img_url')}}" >
    {!! $errors->first('img_url', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('alt') ? 'has-error' : ''}}">
    <label for="alt" class="control-label">{{ '* Alt' }}</label>
    <input class="form-control" name="alt" type="text" id="alt" value="{{ isset($country->alt) ? $country->alt : old('alt')}}" >
    {!! $errors->first('alt', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('imageTitle') ? 'has-error' : ''}}">
    <label for="imageTitle" class="control-label">{{ '* Image title' }}</label>
    <input class="form-control" name="imageTitle" type="text" id="imageTitle" value="{{ isset($country->imageTitle) ? $country->imageTitle : old('imageTitle')}}" >
    {!! $errors->first('imageTitle', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
