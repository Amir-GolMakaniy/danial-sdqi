<?php

use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {

}; ?>

<div class="flex flex-col items-center justify-center h-full w-full gap-6">
    <x-auth-header title="برای دریافت برنامه تمرینی وارد حساب خود شوید" description=""/>

    <flux:link href="{{ route('login') }}">ورود</flux:link>
</div>