<section class="mb-5">
    <div class="mb-4">
        <h4 class="fw-bold text-danger">Delete Account</h4>
        <p class="text-muted mb-0">
            Once your account is deleted, all of its resources and data will be permanently removed.
            Before deleting your account, please download any data or information you wish to retain.
        </p>
    </div>

    <!-- Trigger Button -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Delete Account') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">
                        {{ __('Confirm Account Deletion') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>
                        {{ __('Are you sure you want to delete your account?') }}
                    </p>
                    <p class="text-muted">
                        {{ __('This action is irreversible. Please enter your password to confirm.') }}
                    </p>

                    <div class="mb-3">
                        <label for="delete_user_password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" id="delete_user_password" name="password"
                            class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                            placeholder="{{ __('Password') }}" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                </div>
            </form>
        </div>
    </div>
</section>