<section>
    <div class="mb-4">
        <h4 class="fw-bold">Profile Information</h4>
        <p class="text-muted mb-0">
            Update your account's profile information and email address.
        </p>
    </div>

    {{-- Verification form (hidden, triggered by the button) --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}" class="d-none">
        @csrf
    </form>

    {{-- Profile update form --}}
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small">
                        {{ __('Your email address is unverified.') }}
                        <button type="submit" form="send-verification" class="btn btn-link p-0 align-baseline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success small">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        {{-- Submit --}}
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div class="text-success small" id="save-alert">
                    {{ __('Saved.') }}
                </div>

                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('save-alert');
                        if (alert) alert.style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>