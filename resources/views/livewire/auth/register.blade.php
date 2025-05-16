<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
	public string $name = '';
	public string $email = '';
	public string $password = '';
	public string $password_confirmation = '';

	/**
	 * Handle an incoming registration request.
	 */
	public function register(): void
	{
		$validated = $this->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
			'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
		]);

		$validated['password'] = Hash::make($validated['password']);

		event(new Registered(($user = User::create($validated))));

		Auth::login($user);

		$this->redirectIntended(route('dashboard', absolute: false), navigate: true);
	}
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header title="ایجاد یک حساب" description="برای ایجاد حساب خود ، جزئیات خود را در زیر وارد کنید"/>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')"/>

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
                wire:model="name"
                label="نام"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="نام کامل"
        />

        <!-- Email Address -->
        <flux:input
                wire:model="email"
                label="آدرس ایمیل"
                type="email"
                required
                autocomplete="email"
                placeholder="gmail@gmail.com"
        />

        <!-- Password -->
        <flux:input
                wire:model="password"
                label="رمز عبور"
                type="password"
                required
                autocomplete="new-password"
                placeholder="رمز عبور"
                viewable
        />

        <!-- Confirm Password -->
        <flux:input
                wire:model="password_confirmation"
                label="تأیید رمز عبور"
                type="password"
                required
                autocomplete="new-password"
                placeholder="تأیید رمز عبور"
                viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full cursor-pointer">
                ایجاد حساب
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        در حال حاضر یک حساب کاربری دارید؟
        <flux:link :href="route('login')" wire:navigate.hover>ورود به سیستم</flux:link>
    </div>
</div>