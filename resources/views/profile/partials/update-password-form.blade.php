<div class="card mb-4">
  <div class="card-body">
    <h3 class="card-title">{{ __('Update Password') }}</h3>
    <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    <form method="post" action="{{ route('password.update') }}">
      @csrf
      @method('put')
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputCurrentPassword" class="col-form-label">{{__('Current Password')}}</label>
            <input type="password" name="current_password" id="inputCurrentPassword" class="form-control" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputPassword" class="col-form-label">{{__('New Password')}}</label>
            <input type="password" name="password" id="inputPassword" class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputConfirmPassword" class="col-form-label">{{__('Confirm Password')}}</label>
            <input type="password" name="password_confirmation" id="inputConfirmPassword" class="form-control" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
          </div>
        </div>
      </div>
      <input type="submit" class="btn btn-primary" name="save" value="{{ __('Save Changes') }}" />
      {{-- <input class="btn btn-default" type="reset" value="Cancel" /> --}}
      @if (session('status') === 'password-updated')
        <p
            x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600"
        >{{ __('Saved.') }}</p>
      @endif
    </form>
  </div>
</div>
