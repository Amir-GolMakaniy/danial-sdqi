<?php

use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new class extends Component {
	#[Validate('required|numeric')]
	public $age = null;

	#[Validate('required|numeric')]
	public $height = null;

	#[Validate('required|numeric')]
	public $weight = null;

	public function mount()
	{
		$this->age = isset(auth()->user()->profile->age);
		$this->height = isset(auth()->user()->profile->height);
		$this->weight = isset(auth()->user()->profile->weight);
	}

	public function save()
	{
		$this->validate();

		auth()->user()->Profile()->updateOrCreate($this->all());

		return to_route('dashboard');
	}
}; ?>

<div class="flex flex-col items-center justify-center h-full w-full gap-6">
    <x-auth-header title="اطلاعات خود را وارد کنید" description=""/>

    <form wire:submit="save()" class="flex flex-col gap-6">
        <!-- Age -->
        <flux:input
                wire:model="age"
                label="سن"
                type="number"
                required
                autofocus
                autocomplete="age"
                placeholder="مثال : 18 سال سن"
        />

        <!-- Height -->
        <flux:input
                wire:model="height"
                label="وزن"
                type="number"
                required
                autocomplete="height"
                placeholder="مثال 70 کیلو گرم"
        />

        <!-- Weight -->
        <flux:input
                wire:model="weight"
                label="قد"
                type="number"
                required
                autocomplete="weight"
                placeholder="مثال 170 سانتی متر"
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full cursor-pointer">ذخیره</flux:button>
        </div>
    </form>
</div>