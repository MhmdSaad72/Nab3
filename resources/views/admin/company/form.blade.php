<div class="form-group {{ $errors->has('companyName') ? 'has-error' : ''}}">
    <label for="companyName" class="control-label">{{ '* Company Name' }}</label>
    <input class="form-control" name="companyName" type="text" id="companyName" value="{{ isset($company->companyName) ? $company->companyName : old('companyName')}}" >
    {!! $errors->first('companyName', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telephone') ? 'has-error' : ''}}">
    <label for="telephone" class="control-label">{{ '* Telephone' }}</label>
    <input class="form-control" name="telephone" type="text" id="telephone" value="{{ isset($company->telephone) ? $company->telephone : old('telephone')}}" >
    {!! $errors->first('telephone', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telephone2') ? 'has-error' : ''}}">
    <label for="telephone2" class="control-label">{{ 'Telephone-2' }}</label>
    <input class="form-control" name="telephone2" type="text" id="telephone2" value="{{ isset($company->telephone2) ? $company->telephone2 : old('telephone2')}}" >
    {!! $errors->first('telephone2', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('telephone3') ? 'has-error' : ''}}">
    <label for="telephone3" class="control-label">{{ 'Telephone-3' }}</label>
    <input class="form-control" name="telephone3" type="text" id="telephone3" value="{{ isset($company->telephone3) ? $company->telephone3 : old('telephone3')}}" >
    {!! $errors->first('telephone3', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fax') ? 'has-error' : ''}}">
    <label for="fax" class="control-label">{{ 'Fax' }}</label>
    <input class="form-control" name="fax" type="text" id="fax" value="{{ isset($company->fax) ? $company->fax : old('fax')}}" >
    {!! $errors->first('fax', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zip') ? 'has-error' : ''}}">
    <label for="zip" class="control-label">{{ 'Zip Code' }}</label>
    <input class="form-control" name="zip" type="text" id="zip" value="{{ isset($company->zip) ? $company->zip : old('zip')}}" >
    {!! $errors->first('zip', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('postBox') ? 'has-error' : ''}}">
    <label for="postBox" class="control-label">{{ 'Postbox' }}</label>
    <input class="form-control" name="postBox" type="text" id="postBox" value="{{ isset($company->postBox) ? $company->postBox : old('postBox')}}" >
    {!! $errors->first('postBox', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="control-label">{{ '* City' }}</label>
    <input class="form-control" name="city" type="text" id="city" value="{{ isset($company->city) ? $company->city : old('city')}}" >
    {!! $errors->first('city', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
    <label for="location" class="control-label">{{ '* Location' }}</label>
    <input class="form-control" name="location" type="text" id="location" value="{{ isset($company->location) ? $company->location : old('location')}}" >
    {!! $errors->first('location', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('street') ? 'has-error' : ''}}">
    <label for="street" class="control-label">{{ '* Street' }}</label>
    <input class="form-control" name="street" type="text" id="street" value="{{ isset($company->street) ? $company->street : old('street')}}" >
    {!! $errors->first('street', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
    <label for="url" class="control-label">{{ 'Url' }}</label>
    <input class="form-control" name="url" type="text" id="url" value="{{ isset($company->url) ? $company->url : old('url')}}" >
    {!! $errors->first('url', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('career') ? 'has-error' : ''}}">
    <label for="career" class="control-label">{{ '* Career' }}</label>
    <input class="form-control" name="career" type="text" id="career" value="{{ isset($company->career) ? $company->career : old('career')}}" >
    {!! $errors->first('career', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ '* Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($company->email) ? $company->email : old('email')}}" >
    {!! $errors->first('email', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('logo_path') ? 'has-error' : ''}}">
    <label for="logo_path" class="control-label">{{ 'Logo Path' }}</label>
    <input class="form-control" name="logo_path" type="file" id="logo_path" value="{{ isset($company->logo_path) ? $company->logo_path : old('logo_path')}}" >
    {!! $errors->first('logo_path', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bio') ? 'has-error' : ''}}">
    <label for="bio" class="control-label">{{ 'Bio' }}</label>
    <textarea class="form-control" rows="5" name="bio" type="textarea" id="bio" >{{ isset($company->bio) ? $company->bio : old('bio')}}</textarea>
    {!! $errors->first('bio', '<p class="help-block text-danger">:message</p>') !!}
</div>
{{-- <div class="form-group {{ $errors->has('pageView') ? 'has-error' : ''}}">
    <label for="pageView" class="control-label">{{ '* Pageview' }}</label>
    <input class="form-control" name="pageView" type="number" id="pageView" value="{{ isset($company->pageView) ? $company->pageView : old('pageView')}}" >
    {!! $errors->first('pageView', '<p class="help-block text-danger">:message</p>') !!}
</div> --}}
<div class="form-group {{ $errors->has('fb') ? 'has-error' : ''}}">
    <label for="fb" class="control-label">{{ 'Facebook' }}</label>
    <input class="form-control" name="fb" type="text" id="fb" value="{{ isset($company->fb) ? $company->fb : old('fb')}}" >
    {!! $errors->first('fb', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('linkedin') ? 'has-error' : ''}}">
    <label for="linkedin" class="control-label">{{ 'Linkedin' }}</label>
    <input class="form-control" name="linkedin" type="text" id="linkedin" value="{{ isset($company->linkedin) ? $company->linkedin : old('linkedin')}}" >
    {!! $errors->first('linkedin', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
    <label for="twitter" class="control-label">{{ 'Twitter' }}</label>
    <input class="form-control" name="twitter" type="text" id="twitter" value="{{ isset($company->twitter) ? $company->twitter : old('twitter')}}" >
    {!! $errors->first('twitter', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('insta') ? 'has-error' : ''}}">
    <label for="insta" class="control-label">{{ 'Instagram' }}</label>
    <input class="form-control" name="insta" type="text" id="insta" value="{{ isset($company->insta) ? $company->insta : old('insta')}}" >
    {!! $errors->first('insta', '<p class="help-block text-danger">:message</p>') !!}
</div>
