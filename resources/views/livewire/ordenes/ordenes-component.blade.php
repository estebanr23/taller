<div>
    <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
        <!-- Index Table -->
        <div>
            <div class="flex items-center justify-between">
                <h2
                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100"
                >
                    Listado de Órdenes
                </h2>

                <select class="w-72" x-init="$el._tom = new Tom($el, { create: false, sortField: { field: 'text', direction: 'desc' } })" wire:model="created_order">
                    <option value="Taller" selected>Orden de Taller</option>
                    <option value="Domicilio" >Orden a Domicilio</option>
                </select>

                <div class="flex gap-2">
                    {{-- Buscador --}}
                    @include('commons.search')

                    <div class="inline-flex">
                        {{--  Orden --}}
                        <button wire:click="crear" class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Agregar
                        </button>
                    </div>

                </div>

            </div>
            @if (session('message'))
            {{ dd($message,  $class) }}
                <div x-data="{show: true}"  x-show="show" x-init="setTimeout(() => show = false, 3000)" class="{{ session('class') }}">
                    <span>{{ session('message') }}</span>
                </div>
            @endif
            {{-- Tabla usuario --}}

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
                                #
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Falla
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Cliente
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Fecha Emision
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Fecha Entrega
                            </th>
                            <th
                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Tipo
                            </th>
                            <th
                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Estado
                            </th>
                            <th
                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Tecnico
                            </th>
                            <th
                                class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                            >
                                Acciones
                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ordenes as $orden)
                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $orden->id }}</td>
                                <td class="whitespace-nowrap px-3 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">{{ $orden->problem }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $orden->Customer->name . ' ' . $orden->Customer->lastname}} </td>
                                @php
                                    $date = date_create($orden->date_emission);
                                @endphp
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ date_format($date, "d.m.Y") }}</td>
                                @php
                                    $date = date_create($orden->date_delivery);
                                @endphp
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ date_format($date, "d.m.Y") }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $orden->type_order }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $orden->State->name }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">{{ $orden->User->name }}</td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <span>
                                        <div class="flex justify-start space-x-2">
                                            <button 
                                                x-tooltip.primary="'Ver más'"
                                                wire:click="$emitTo('ordenes.ordenes-ver', 'ver', {{$orden->id}})" 
                                                class="btn h-8 w-8 p-0 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25"
                                            >
                                                <i class="fa fa-eye" ></i>
                                            </button>



                                            @if ($user->role=='administrador')
                                                <button 
                                                    x-tooltip.info="'Editar'"
                                                    wire:click="$emitTo('ordenes.ordenes-edit', 'editar', {{$orden->id}})" 
                                                    class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                @if($orden->user_id==null)
                                                    <button 
                                                        x-tooltip.warning="'Asignar Técnico'"
                                                        wire:click="$emitTo('ordenes.ordenes-asignar', 'asignar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-warning hover:bg-warning/20 focus:bg-warning/20 active:bg-warning/25"
                                                    >
                                                        <i class="fa fa-user" ></i>
                                                    </button> 
                                                @endif

                                                {{-- @if ($orden->State->id != 5) --}}
                                                    <button 
                                                        x-tooltip.success="'Finalizar Orden'"
                                                        wire:click="$emitTo('ordenes.ordenes-finalizar', 'finalizar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                                                    >
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                {{-- @endif --}}
                                            @endif

                                            @if ($user->role=='tecnico')
                                                @if($orden->State->id!=4 && $orden->State->id!=5 && $orden->user_id==$user->id)
                                                    <button 
                                                        x-tooltip.info="'Editar'"
                                                        wire:click="$emitTo('ordenes.ordenes-edit', 'editar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                                                    >
                                                        <i class="fa fa-edit"></i>
                                                    </button>

                                                    <button 
                                                        x-tooltip.success="'Finalizar Orden'"
                                                        wire:click="$emitTo('ordenes.ordenes-finalizar', 'finalizar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                                                    >
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                @endif
                                            @endif

                                            @if ($orden->State->id == 5 && $orden->created_order == 'Taller')
                                                <button
                                                    x-tooltip.error="'Reporte Finalización'"
                                                    wire:click="$emitTo('ordenes.ordenes-finalizar', 'exportOrdenEntrega', {{$orden}})" 
                                                    class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"
                                                >
                                                    <i class="fa fa-file-pdf"></i>
                                                </button>                                            
                                            @endif

                                            {{-- @if ($orden->State->id!=4 && $orden->State->id!=5)
                                                @if($user->role=='administrador' && $orden->user_id==null)
                                                    <button 
                                                        x-tooltip.warning="'Asignar Técnico'"
                                                        wire:click="$emitTo('ordenes.ordenes-asignar', 'asignar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-warning hover:bg-warning/20 focus:bg-warning/20 active:bg-warning/25"
                                                    >
                                                        <i class="fa fa-user" ></i>
                                                    </button>
                                                @endif
                                                    <button 
                                                        x-tooltip.info="'Editar'"
                                                        wire:click="$emitTo('ordenes.ordenes-edit', 'editar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
                                                    >
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                @if ($orden->user_id!=null)
                                                    <button 
                                                        x-tooltip.success="'Finalizar Orden'"
                                                        wire:click="$emitTo('ordenes.ordenes-finalizar', 'finalizar', {{$orden->id}})" 
                                                        class="btn h-8 w-8 p-0 text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25"
                                                    >
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                @endif
                                            @endif

                                            @if ($orden->State->id == 5)
                                                <button
                                                    x-tooltip.error="'Reporte Finalización'"
                                                    wire:click="$emitTo('ordenes.ordenes-finalizar', 'exportOrdenEntrega', {{$orden}})" 
                                                    class="btn h-8 w-8 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25"
                                                >
                                                    <i class="fa fa-file-pdf"></i>
                                                </button>
                                            @endif --}}

                                        </div>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                <td class="whitespace-nowrap px-3 py-3 font-medium text-center text-slate-700 dark:text-navy-100 lg:px-5 w-full" colspan="8">
                                    No se encontraron registros coincidentes para lo que buscas
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $ordenes->links() }}
                <livewire:ordenes.ordenes-asignar/>
                <livewire:ordenes.ordenes-edit/>
                <livewire:ordenes.ordenes-finalizar/>
                <livewire:ordenes.ordenes-ver/>
            </div>
        </div>
    </div>
</div>
