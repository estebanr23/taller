@extends('layouts.template')

@section('content')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
          <div class="card col-span-12">
            <div class="mt-3 flex flex-col justify-between px-4 sm:flex-row sm:items-center sm:px-5">
              <div class="flex flex-1 items-center justify-between space-x-2 sm:flex-initial">
                <h2 class="text-sm+ font-medium tracking-wide text-slate-700 dark:text-navy-100">
                  {{ auth()->user()->role == 'administrador' ? 'Visión General' : 'Bienvenid@ '.auth()->user()->username }}
                </h2>
              </div>
              @if (auth()->user()->role == 'administrador')
                <div class="hidden space-x-2 sm:flex" x-data="{activeTab:'tabYearly'}">
                  <button @click="activeTab = 'tabMonthly'" class="btn h-8 rounded-full text-xs font-medium hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 hover:text-slate-800 focus:text-slate-800 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 dark:hover:text-navy-100 dark:focus:text-navy-100" :class="activeTab === 'tabMonthly' ? 'bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light' : 'hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 hover:text-slate-800 focus:text-slate-800 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 dark:hover:text-navy-100 dark:focus:text-navy-100'">
                    Mes
                  </button>
                  <button @click="activeTab = 'tabYearly'" class="btn h-8 rounded-full text-xs+ font-medium bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light" :class="activeTab === 'tabYearly' ? 'bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light' : 'hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 hover:text-slate-800 focus:text-slate-800 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 dark:hover:text-navy-100 dark:focus:text-navy-100'">
                    Año
                  </button>
                </div>
              @endif
            </div>

            @if (auth()->user()->role == 'administrador')
              <div class="mt-4 grid grid-cols-2 gap-3 px-4 sm:mt-5 sm:grid-cols-4 sm:gap-5 sm:px-5 lg:mt-6">
                <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
                  <div class="flex justify-between space-x-1">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                      {{ $count_orders }}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info icon icon-tabler icon-tabler-report-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                      <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                      <path d="M9 17v-5"></path>
                      <path d="M12 17v-1"></path>
                      <path d="M15 17v-3"></path>
                  </svg>
                  </div>
                  <p class="mt-1 text-xs+">Órdenes</p>
                </div>
                <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
                  <div class="flex justify-between">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                      {{ $countOrdersCompleted }}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                  </div>
                  <p class="mt-1 text-xs+">Completadas</p>
                </div>
                <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
                  <div class="flex justify-between">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                      {{ $countOrdersPending }}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <p class="mt-1 text-xs+">Pendientes</p>
                </div>
                <div class="rounded-lg bg-slate-100 p-4 dark:bg-navy-600">
                    <div class="flex justify-between">
                      <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        {{ $countOrdersWithoutAssign }}
                      </p>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error icon icon-tabler icon-tabler-user-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>
                        <path d="M22 22l-5 -5"></path>
                        <path d="M17 22l5 -5"></path>
                      </svg>
                    </div>
                    <p class="mt-1 text-xs+">Sin asignar</p>
                  </div>
              </div>
            @endif

            <div class="mt-2"></div>
          </div>
          <livewire:dashboard.dashboard>
        </div>
      </main>
@endsection



