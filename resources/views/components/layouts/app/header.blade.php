<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

    <a href="{{ route('home') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0"
       wire:navigate.hover>
        <x-app-logo/>
    </a>

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="user-circle" :href="route('profile')" wire:navigate.hover.hover>
            پروفایل
        </flux:navbar.item>
    </flux:navbar>

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="layout-grid" :href="route('dashboard')" wire:navigate.hover.hover>
            داشبورد
        </flux:navbar.item>
    </flux:navbar>

    <flux:spacer/>

    <div class="hidden lg:flex">
        <flux:button
                x-data="{themes: ['light', 'dark'],index: ['light', 'dark'].indexOf($flux.appearance)}"
                @click="index = (index + 1) % themes.length; $flux.appearance = themes[index]"
                class="cursor-pointer ml-4">
            <template x-if="themes[index] === 'light'">
                <flux:icon.sun/>
            </template>
            <template x-if="themes[index] === 'dark'">
                <flux:icon.moon/>
            </template>
        </flux:button>
    </div>

    <!-- Desktop User Menu -->
    @auth
        <flux:dropdown position="top" align="end">
            <flux:profile
                    class="cursor-pointer"
                    :initials="auth()->user()->initials()"
            />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                            class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator/>

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog"
                                    wire:navigate.hover>
                        تنظیمات
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator/>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                                    class="w-full cursor-pointer">
                        خروج
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    @endauth

    @guest
        <div class="space-x-4 flex">
            <flux:button href="{{ route('register') }}">
                <flux:icon.user-plus/>
            </flux:button>

            <flux:button href="{{ route('login') }}">
                <flux:icon.user-circle/>
            </flux:button>
        </div>
    @endguest
</flux:header>

<!-- Mobile Menu -->
<flux:sidebar stashable sticky
              class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate.hover>
        <x-app-logo/>
    </a>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="user-circle" :href="route('profile')" wire:navigate.hover>
            پروفایل
        </flux:navlist.item>

        <flux:navlist.item icon="layout-grid" :href="route('dashboard')" wire:navigate.hover>
            داشبورد
        </flux:navlist.item>
    </flux:navlist>

    <flux:spacer/>

    <flux:button
            x-data="{themes: ['light', 'dark'],index: ['light', 'dark'].indexOf($flux.appearance)}"
            @click="index = (index + 1) % themes.length; $flux.appearance = themes[index]"
            class="cursor-pointer ml-4">
        <template x-if="themes[index] === 'light'">
            <flux:icon.sun/>
        </template>
        <template x-if="themes[index] === 'dark'">
            <flux:icon.moon/>
        </template>
    </flux:button>
</flux:sidebar>

{{ $slot }}

@fluxScripts
</body>
</html>
