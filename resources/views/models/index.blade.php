@extends('layouts.template')

@section('sidebar-panel')
  <div class="sidebar-panel">
    <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
    <!-- Sidebar Panel Header -->
      <div class="flex h-18 w-full items-center justify-between pl-4 pr-1">
        <p class="text-base tracking-wider text-slate-800 dark:text-navy-100">
          Dispositivos
        </p>
        <button
          @click="$store.global.isSidebarExpanded = false"
          class="btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden"
        >
          <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
          >
              <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 19l-7-7 7-7"
              />
          </svg>
        </button>
      </div>
      <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>

    <!-- Sidebar Panel Body -->
      <div
        x-data="{expandedItem:null}"
        class="h-[calc(100%-4.5rem)] overflow-x-hidden pb-6"
        x-init="$el._x_simplebar = new SimpleBar($el);"
      >
        <ul class="flex flex-1 flex-col px-4 font-inter">
          <li>
            <a
              x-data="navLink"
              href="{{ route('devices.index') }}"
              :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
              class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out"
            >
              Dispositivos
            </a>
          </li>
          <li>
            <a
              x-data="navLink"
              href="{{ route('devices.type-devices') }}"
              :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
              class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out"
            >
              Tipos Dispositivo
            </a>
          </li>
          <li>
            <a
              x-data="navLink"
              href="{{ route('devices.brands') }}"
              :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
              class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out"
            >
              Marcas
            </a>
          </li>
          <li>
            <a
              x-data="navLink"
              href="{{ route('devices.models') }}"
              :class="isActive ? 'font-medium text-primary dark:text-accent-light' : 'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
              class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out"
            >
              Modelos
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection

@section('content')
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2
            class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl"
        >
            Taller
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                <a
                    class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                    href="#"
                    >Modelos</a
                >
                <svg
                    x-ignore
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                    />
                </svg>
                </li>
                <li>Listado</li>
            </ul>
        </div>

        <livewire:models.model-table />
    </main>

    <livewire:models.model-edit />
    <livewire:models.model-delete />
@endsection

