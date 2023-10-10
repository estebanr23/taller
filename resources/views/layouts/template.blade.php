<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSS Assets -->
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

        <!-- Javascript Assets -->
        <script src="{{ asset('assets/js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
        />
        <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
            document.documentElement.classList.add("dark");
        </script>

        <!-- Styles -->
        @livewireStyles
        @stack('css')
    </head>
    <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
        <!-- App preloader-->
        <div
          class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900"
        >
          <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
        </div>
    
        <!-- Page Wrapper -->
        <div
          id="root"
          class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900"
          x-cloak
        >
          <!-- Sidebar -->
          <div class="sidebar print:hidden">
            <!-- Main Sidebar -->
            @include('layouts.main-sidebar')
    
            <!-- Sidebar Panel -->
            {{-- @include('layouts.sidebar-panel') --}}
            @yield('sidebar-panel')
          </div>
    
          <!-- App Header Wrapper-->
          @include('layouts.nav')
    
          <!-- Mobile Searchbar -->
          @include('layouts.mobile-searchbar')
    
          <!-- Right Sidebar -->
          @include('layouts.right-sidebar')
    
          <!-- Main Content Wrapper -->
          @yield('content')

        </div>

        <!-- 
            This is a place for Alpine.js Teleport feature 
            @see https://alpinejs.dev/directives/teleport
          -->

        <div id="x-teleport-target"></div>
        <script>
          window.addEventListener("DOMContentLoaded", () => Alpine.start());
        </script>

        @livewireScripts

        <script>
          Livewire.on('exportOrden', async(order) => {
              const data = {
                  convertTo: "pdf",
                  data: order.order,
                  template: "orden_taller.docx"
              }

              const response = await fetch('https://reportes.cc.gob.ar/carbone', {
                  method: 'POST',
                  headers: {
                      "Content-Type": "application/json",
                  },
                  body: JSON.stringify(data),
              });

              if (!response.ok) {
                  throw new Error(`HTTP error! status: ${response.status}`);
              }

              const fileBlob = await response.blob();
              const file = new Blob([fileBlob], {type: 'application/pdf'});
              const fileURL = URL.createObjectURL(file);
              window.open(fileURL, '_blank');

              window.location.href = "{{ route('ordenes.index') }}";
          });
        </script>

        @stack('js')
      </body>
</html>
