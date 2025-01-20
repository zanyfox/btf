<div class="card mb-4">
  <div class="card-body">
    <h3 class="card-title">{{ __('Profile') }}</h3>
    <p>{{ __("Update your account's profile information and email address.") }}</p>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
      @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}">
      @csrf
      @method('patch')
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputFirstName" class="col-form-label">{{__('First Name')}}</label>
            <input type="text" name="name" id="inputFirstName" value="{{old('name', $user->name)}}" class="form-control" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="inputEmail" class="col-form-label">{{__('Email')}}</label>
            <input type="email" name="email" id="inputEmail" value="{{old('email', $user->email)}}" class="form-control" required autocomplete="email">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
              <div>
                <p class="text-sm mt-2 text-gray-800">
                  {{ __('Your email address is unverified.') }}
                  <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Click here to re-send the verification email.') }}
                  </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                  <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                  </p>
                @endif
              </div>
            @endif
          </div>
        </div>
      </div>
      <input class="btn btn-primary" type="submit" name="save" value="{{ __('Save Changes') }}" />
      {{-- <input class="btn btn-default" type="reset" value="Cancel" /> --}}
      @if (session('status') === 'profile-updated')
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
