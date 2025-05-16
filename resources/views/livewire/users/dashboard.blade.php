<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {

}; ?>

<div class="flex flex-col items-center justify-center h-full w-full gap-6">
    <x-auth-header title="برنامه تمرینی شما" description=""/>

    <h1 class="text-xl">شنبه : سینه ، پشت بازو ، سرشانه</h1>
    <h1 class="text-xl">دو شنبه : زیر بغل ، عضلات پشت ، جلو بازو</h1>
    <h1 class="text-xl">چهار شنبه : پا ، شکم</h1>
</div>