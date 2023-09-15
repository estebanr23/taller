<div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
  <div>
    <div class="flex items-center justify-between">
      <h2
        class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
      >
        Listado de Tipos de Dispositivos
      </h2>
      <div class="flex gap-2">
        @include('commons.search')

        <div class="inline-flex">
          <livewire:type-devices.type-devices-create />
          <div @notification.window="$notification({text:$event.detail.message,variant:'success',position:'center-top'})"></div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div
        class="is-scrollbar-hidden min-w-full overflow-x-auto"
        x-data="pages.tables.initExample1"
      >
        <table class="is-hoverable w-full text-left">
          <thead>
            <tr>
              <th
                class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Id
              </th>
              <th
                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Nombre
              </th>
              <th
                class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
              >
                Acciones
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($typeDevices as $typeDevice)
              <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $typeDevice->id }}</td>
                <td class="whitespace-nowrap px-3 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">{{ $typeDevice->type_name }}</td>
                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                  <span>
                    <div class="flex justify-start space-x-2">
                      <button 
                        x-tooltip.info="'Editar'"
                        wire:click="$emitTo('type-devices.type-devices-edit', 'edit', {{ $typeDevice->id }})" 
                        class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                      >
                        <i class="fa fa-edit"></i>
                      </button>
                    </div>
                  </span>
                </td>
              </tr>
            @empty
              <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                <td class="whitespace-nowrap px-3 py-3 font-medium text-center text-slate-700 dark:text-navy-100 lg:px-5" colspan="3">
                  No se encontraron registros
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
  
      {{ $typeDevices->links() }}
    </div>
  </div>
</div>

