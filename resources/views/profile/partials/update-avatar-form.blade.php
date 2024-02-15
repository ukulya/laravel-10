<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Avatar') }}
        </h2>
        <!--<img src="{{$user->avatar}}" alt="" class="d-none">--><!-- we need to add storage -->
        <img src='{{"/storage/$user->avatar"}}' alt="" class="w-10 h-10 rounded-full">
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add or Update User Avatar.") }}
        </p>
    </header>
    @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <!-- it is called method spoofing - we're trying to trick html - it thinks that it is going to post - but in fact it updates -->
        <!-- html doesnt provide method="patch" The POST method is not supported for route profile. Supported methods: GET, HEAD, PATCH, DELETE.-->
        <!-- it is treating it as get request -->
        <!-- we can either use @method('patch') -->
        <!-- or we can use <input type="hidden" name="_method" value="PUT"> -->
        <!-- this brings us to the 419 error -->
        <!-- CSFR - cross-site request forgery - so that no unauthorized user will submit - laravel checks for this token -->
        <!--  why use enctype ? when form accepts any media - otherwise it keeps saying error on avatar field -->
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
           
        </div>
    </form>
</section>