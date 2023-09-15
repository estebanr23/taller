<div class="col-span-12">
  <div class="flex items-center justify-between">
    <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
      {{ auth()->user()->role == 'administrador' ? 'Últimas Órdenes' : 'Tus Órdenes Asignadas' }}
    </h2>
    <div class="flex">
      @include('commons.search')

      <x-button-filter-orders :$technicians />
    </div>
  </div>
  <div class="card mt-3">
    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
      <table class="is-hoverable w-full text-left">
        <thead>
          <tr>
            <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Orden
            </th>
            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Fecha Emisión
            </th>
            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Cliente
            </th>
            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Dispositivo
            </th>
            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Falla
            </th>
            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Técnico
            </th>
            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
              Estado Orden
            </th>

            <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <p class="font-medium text-primary dark:text-accent-light">
                  #{{ $order->id }}
                </p>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                @php
                  $date = date_create($order->date_emission)
                @endphp
                <p class="font-medium">{{ date_format($date, 'd.m.Y') }}</p>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <div class="flex items-center space-x-4">
                  <div class="avatar h-9 w-9">
                    <img class="mask is-squircle" src="https://ui-avatars.com/api/?name={{ $order->Customer->name }}" alt="avatar">
                  </div>

                  <div>
                    <span class="font-medium text-slate-700 dark:text-navy-100">
                      {{ $order->Customer->name }}
                    </span>
                    <p class="mt-0.5 text-xs">{{ $order->Customer->area->area_name }}</p>
                  </div>
                </div>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <div class="flex items-center space-x-4">
                  <p class="font-medium">{{ $order->Device->typeDevice->type_name }} - {{ $order->Device->brand->brand_name }} - {{ $order->Device->model->model_name }}</p>
                </div>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <div class="flex items-center space-x-4">
                  <p class="font-medium">{{ $order->problem }}</p>
                </div>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <p class="font-medium">
                  @if ($order->User?->name)
                    <div class="badge bg-info/10 text-info dark:bg-info/15">
                      {{ $order->User->name }}
                    </div>
                  @else
                    <div class="badge bg-error/10 text-error dark:bg-error/15">
                      No Asignado
                    </div>
                  @endif
                </p>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                @if ($order->State->name == 'Solucionado')
                  <div class="badge bg-success/10 text-success dark:bg-success/15">
                @else
                  <div class="badge bg-warning/10 text-warning dark:bg-warning/15">
                @endif
                  {{ $order->State->name }}
                </div>
              </td>
              <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                <button class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                  </svg>
                </button>
              </td>
            </tr>
          @empty
            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
              <td class="whitespace-nowrap px-3 py-3 font-medium text-center text-slate-700 dark:text-navy-100 lg:px-5" colspan="6">
                No se encontraron registros
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    {{ $orders->links() }}
  </div>
</div>
