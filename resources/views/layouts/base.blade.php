<x-app-layout>
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- @livewire('navigation-menu') --}}
        @livewire('navigation')

        <!-- Page Heading -->
        {{-- @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}



        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    <script>
        const isDarkModeEnabled = document.body.classList.contains('dark');
        if (localStorage.getItem('darkMode') == null) {
            localStorage.setItem('darkMode', isDarkModeEnabled);
        } else {
            const darkMode = JSON.parse(localStorage.getItem('darkMode'));
            if (!darkMode) {
                document.body.classList.remove('dark');
                localStorage.setItem('darkMode', false);
            }
        }

        const changeDarkModeButton = document.querySelector('#changeDarkModeButton');
        if (changeDarkModeButton) {
            changeDarkModeButton.onclick = () => {
                document.body.classList.toggle('dark');
                const currentDarkModeStatus = JSON.parse(localStorage.getItem('darkMode'));
                const isDarkModeEnabled = document.body.classList.contains('dark');
                localStorage.setItem('darkMode', isDarkModeEnabled);
            }
        }
    </script>

    @livewireScripts
</x-app-layout>