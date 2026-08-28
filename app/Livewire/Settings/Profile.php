<?php

namespace App\Livewire\Settings;

use App\Concerns\ProfileValidationRules;
use Flux\Flux;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Profile settings')]
class Profile extends Component
{
    use ProfileValidationRules, WithFileUploads;

    public string $name = '';

    public string $email = '';

    public string $libraryName = '';

    public string $libraryCode = '';

    public string $country = '';

    public string $openingTime = '';

    public string $closingTime = '';

    public bool $sundayOpen = true;

    public string $currency = 'INR';

    public $libraryLogo = null;

    public string $currentLogo = '';
    public string $libraryStatus = 'active';


    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();
        $library = $user->library;

        $this->name = $user->name;
        $this->email = $user->email;

        if ($library) {
            $this->libraryName = $library->name ?? '';
            $this->libraryCode = $library->code ?? '';
            $this->country = $library->country ?? '';
            $this->openingTime = $library->opening_time ?? '';
            $this->closingTime = $library->closing_time ?? '';
            $this->sundayOpen = (bool) ($library->sunday_open ?? true);
            $this->currency = $library->currency ?? 'INR';
            $this->currentLogo = $library->logo ?? '';
            $this->libraryStatus = $library->status ?? 'active';
        }
    }

    /**
     * Update user profile information.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate(
            $this->profileRules($user->id)
        );

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        Flux::toast(
            variant: 'success',
            text: __('Profile updated.')
        );
    }

    /**
     * Update library information.
     */
    public function updateLibraryInformation(): void
    {
        $validated = $this->validate([
            'libraryName' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'openingTime' => ['required'],
            'closingTime' => ['required'],
            'sundayOpen' => ['boolean'],
            'currency' => ['required', 'string', 'max:10'],
            'libraryLogo' => ['nullable', 'image', 'max:2048'],
        ]);

        $library = Auth::user()->library;

        if (! $library) {
            Flux::toast(
                variant: 'danger',
                text: __('Library not found.')
            );

            return;
        }

        if ($this->libraryLogo) {
            if ($library->logo) {
                Storage::disk('public')->delete($library->logo);
            }

            $validated['logo'] = $this->libraryLogo->store(
                'libraries',
                'public'
            );
        }

        $library->update([
            'name' => $validated['libraryName'],
            'country' => $validated['country'] ?? null,
            'opening_time' => $validated['openingTime'],
            'closing_time' => $validated['closingTime'],
            'sunday_open' => $validated['sundayOpen'],
            'currency' => $validated['currency'],
            'logo' => $validated['logo'] ?? $library->logo,
        ]);

        $this->libraryLogo = null;

        Flux::toast(
            variant: 'success',
            text: __('Library settings updated.')
        );
    }

    /**
     * Send an email verification notification.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(
                default: route('dashboard', absolute: false)
            );

            return;
        }

        $user->sendEmailVerificationNotification();

        Flux::toast(
            text: __('A new verification link has been sent to your email address.')
        );
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        $user = Auth::user();

        return $user instanceof MustVerifyEmail
            && ! $user->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        $user = Auth::user();

        return ! $user instanceof MustVerifyEmail
            || $user->hasVerifiedEmail();
    }
}