<div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
    <div class="col-span-12 sm:col-span-8">
        <div @notification.window="$notification({text:$event.detail.message,variant:'success',position:'center-top'})"></div>
        @if ($ClienteForm)
            <div class="card p-4 sm:p-5">
                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                    Cliente
                </p>
                <div class="mt-4 space-y-4">
                    <div class="relative flex -space-x-px">
                        <input
                            class="form-input peer w-full rounded-l-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Ingresar DNI..."
                            type="text"
                            value="{{ $DNI }}"
                            wire:model="DNI"
                        />

                        <div
                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                        >
                            <i class="fas fa-id-card"></i>
                        </div>

                        <button
                            wire:click="buscar"
                            class="btn rounded-l-none bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >
                            Buscar
                        </button>
                    </div>

                    @if ($DatosCliente)
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span> Nombre</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    value="{{ $nombre_cliente }}" wire:model="nombre_cliente" id="nombre_cliente"
                                    placeholder="Nombre" type="text" />
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="far fa-user text-base"></i>
                                </span>
                            </span>
                            @error('nombre_cliente')<div class="text-error">{{ $message }}</div>@enderror
                        </label>
                        <label class="block">
                            <span> Apellido</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    value="{{ $apellido_cliente }}" wire:model="apellido_cliente" id="apellido_cliente"
                                    placeholder="Apellido" type="text" />
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="far fa-user text-base"></i>
                                </span>
                            </span>
                            @error('apellido_cliente')<div class="text-error">{{ $message }}</div>@enderror
                        </label>

                        <label class="block">
                            <span> Telefono</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="(999) 999-9999" type="text" value="{{ $telefono }}"
                                    wire:model="telefono" id="telefono"
                                    x-input-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}" />
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fa fa-phone"></i>
                                </span>
                            </span>
                            @error('telefono')<div class="text-error">{{ $message }}</div>@enderror
                        </label>
                        <label class="block">
                            <span>Legajo</span>
                            <div class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Legajo" type="text" value="{{ $legajo }}" wire:model="legajo"
                                    id="legajo" />
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="fas fa-file"></i>
                                </span>
                            </div>
                            @error('legajo')<div class="text-error">{{ $message }}</div>@enderror
                        </label>

                        <label class="block">
                            <span>Secretaria:</span>
                            <select
                            class="mt-1.5 w-full"
                            x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                            wire:model="secretary_id"
                            {{-- wire:change="buscar_area" --}}
                            >
                                <option value="" disabled>-- Seleccionar secretaria --</option>
                                @foreach ($secretaries as $secretary)
                                    <option value="{{ $secretary->id }}">{{ $secretary->secretary_name }}</option>
                                @endforeach
                            </select>
                            @error('secretary_id') <span class="text-error">{{ $message }}</span> @enderror
                        </label>

                        @if (!$showNewAreaInput)
                            <label class="block">
                                <span>Area:</span>
                                <div class="flex justify-between align-middle gap-2">
                                    <select
                                    class="mt-1.5 w-full"
                                    x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                                    wire:model="area_id"
                                    >
                                        <option value="" disabled>-- Seleccionar área --</option>
                                        @if ($areas)  
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <button
                                    class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                                    wire:click="toggleNewAreaInput"
                                    x-tooltip.light="'Ingresar nueva área'"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>
                                    </button>
                                </div>
                                @error('area_id') <span class="text-error">{{ $message }}</span> @enderror
                            </label>
                        @else
                            <label class="block">
                                <span>Area:</span>
                                <div class="flex justify-between align-middle gap-2">
                                    <input wire:model="area_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre del nuevo modelo" type="text">
                                    <button
                                    class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                                    wire:click="storeNewArea"
                                    x-tooltip.light="'Registrar área'"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                    </button>
                                    <button
                                    class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                                    wire:click="toggleNewAreaInput"
                                    x-tooltip.light="'Volver a listado de áreas'"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M18 6l-12 12"></path>
                                        <path d="M6 6l12 12"></path>
                                    </svg>
                                    </button>
                                </div>
                                @if($errors->has('area_name'))
                                    <span class="text-error">{{ $errors->first('area_name') }}</span>
                                @endif
                            </label>
                        @endif
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button wire:click="ShowEquipo"
                            class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>Siguiente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        @endif

        @if ($EquipoForm)
            <div class="card p-4 sm:p-5">
                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                    Equipos
                </p>
                <div class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class=block>
                            <span>Numero de serie</span>
                            <div class="flex justify-between align-middle gap-2">


                            <input
                            class="mt-1.5 form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                            placeholder="Ingresar Numero de serie"
                            type="text"
                            value="{{ $serial_number }}"
                            wire:model="serial_number"
                        />

                        <button
                            wire:click="Buscar_Serial"
                            class="btn rounded-l bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            Buscar
                        </button>
                    </div>
                        </label>
                    @if (!$showNewTypeInput)
                    <label class="block">
                      <span>Tipo:</span>
                      <div class="flex justify-between align-middle gap-2">
                        <select
                          class="mt-1.5 w-full"
                          x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                          wire:model="type_device_id"
                        >
                            <option value="" disabled>-- Seleccionar un tipo --</option>
                          @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                          @endforeach
                        </select>
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                          wire:click="toggleNewTypeInput"
                          x-tooltip.light="'Ingresar nuevo tipo'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                          </svg>
                        </button>
                      </div>
                      @error('type_device_id') <span class="text-error">{{ $message }}</span> @enderror
                    </label>
                    @else
                    <label class="block">
                      <span>Tipo Dispositivo:</span>
                      <div class="flex justify-between align-middle gap-2">
                        <input wire:model.defer="type_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre para el nuevo tipo de dispositivo" type="text">
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                          wire:click="storeNewType"
                          x-tooltip.light="'Registrar tipo'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                          </svg>
                        </button>
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                          wire:click="toggleNewTypeInput"
                          x-tooltip.light="'Volver a listado de tipos'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M18 6l-12 12"></path>
                            <path d="M6 6l12 12"></path>
                          </svg>
                        </button>
                      </div>
                      @if($errors->has('type_name'))
                        <span class="text-error">{{ $errors->first('type_name') }}</span>
                      @endif
                    </label>
                    @endif

                    @if (!$showNewBrandInput)
                    <label class="block">
                      <span>Marca:</span>
                      <div class="flex justify-between align-middle gap-2">
                        <select
                          class="mt-1.5 w-full"
                          x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                          wire:model="brand_id"
                        >
                            <option value="" disabled>-- Seleccionar una marca --</option>
                          @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                          @endforeach
                        </select>
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                          wire:click="toggleNewBrandInput"
                          x-tooltip.light="'Ingresar nueva marca'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                          </svg>
                        </button>
                      </div>
                      @error('brand_id') <span class="text-error">{{ $message }}</span> @enderror
                    </label>
                    @else
                    <label class="block">
                      <span>Marca:</span>
                      <div class="flex justify-between align-middle gap-2">
                        <input wire:model.defer="brand_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre para la nueva marca" type="text">
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                          wire:click="storeNewBrand"
                          x-tooltip.light="'Registrar marca'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                          </svg>
                        </button>
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                          wire:click="toggleNewBrandInput"
                          x-tooltip.light="'Volver a listado de marcas'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M18 6l-12 12"></path>
                            <path d="M6 6l12 12"></path>
                          </svg>
                        </button>
                      </div>
                      @if($errors->has('brand_name'))
                        <span class="text-error">{{ $errors->first('brand_name') }}</span>
                      @endif
                    </label>
                    @endif

                    @if (!$showNewModelInput)
                    <label class="block">
                      <span>Modelo:</span>
                      <div class="flex justify-between align-middle gap-2">
                        <select
                          class="mt-1.5 w-full"
                          x-init="$el._tom = new Tom($el,{create: false,sortField: {field: 'text',direction: 'asc'}})"
                          wire:model="model_id"
                        >
                            <option value="" disabled>-- Seleccionar un modelo --</option>
                          @foreach ($models as $model)
                            <option value="{{ $model->id }}">{{ $model->model_name }}</option>
                          @endforeach
                        </select>
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-primary p-0 font-medium text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/50 focus:bg-primary-focus focus:shadow-lg focus:shadow-primary/50 active:bg-primary-focus/90"
                          wire:click="toggleNewModelInput"
                          x-tooltip.light="'Ingresar nuevo modelo'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                          </svg>
                        </button>
                      </div>
                      @error('model_id') <span class="text-error">{{ $message }}</span> @enderror
                    </label>
                    @else
                    <label class="block">
                      <span>Modelo:</span>
                      <div class="flex justify-between align-middle gap-2">
                        <input wire:model.defer="model_name" class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Ingrese el nombre del nuevo modelo" type="text">
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-success p-0 font-medium text-white hover:bg-success-focus hover:shadow-lg hover:shadow-success/50 focus:bg-success-focus focus:shadow-lg focus:shadow-success/50 active:bg-success-focus/90"
                          wire:click="storeNewModel"
                          x-tooltip.light="'Registrar modelo'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                          </svg>
                        </button>
                        <button
                          class="btn h-9 w-9 mt-1.5 bg-error p-0 font-medium text-white hover:bg-error-focus hover:shadow-lg hover:shadow-error/50 focus:bg-error-focus focus:shadow-lg focus:shadow-error/50 active:bg-error-focus/90"
                          wire:click="toggleNewModelInput"
                          x-tooltip.light="'Volver a listado de modelos'"
                        >
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M18 6l-12 12"></path>
                            <path d="M6 6l12 12"></path>
                          </svg>
                        </button>
                      </div>
                      @if($errors->has('model_name'))
                        <span class="text-error">{{ $errors->first('model_name') }}</span>
                      @endif
                    </label>
                    @endif

                </div>
                    {{-- <label class="block sm:col-span-6">
                        <span>Falla</span>
                        <textarea rows="4" placeholder="" wire:model="falla"
                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </textarea>
                        @error('falla') <span class="text-error">{{ $message }}</span> @enderror
                    </label> --}}

                    <label class="block">
                        <span>Falla</span>
                        <textarea rows="4" placeholder="" wire:model="falla"
                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </textarea>
                        @error('falla') <span class="text-error">{{ $message }}</span> @enderror
                    </label>

                    {{-- <label class="block">
                        <span>Informe cliente</span>
                        <textarea rows="4" placeholder="" wire:model="informe_cliente"
                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </textarea>
                        @error('informe_cliente') <span class="text-error">{{ $message }}</span> @enderror
                    </label>
                    <label class="block">
                        <span>Informe Tecnico</span>
                        <textarea rows="4" placeholder="" wire:model="informe_tecnico"
                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </textarea>
                    </label> --}}

                    <label class="block">
                        <span>Accesorios</span>
                        <textarea rows="4" placeholder="" wire:model="accesorios"
                            class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </textarea>
                        @error('accesorios') <span class="text-error">{{ $message }}</span> @enderror
                    </label>

                    <div class="flex justify-end space-x-2">
                        <button wire:click="ShowCliente"
                            class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Anterior</span>
                        </button>
                        <button
                            wire:click="ShowTecnico"class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>Siguiente</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if ($TecnicoForm)
            <div class="card p-4 sm:p-5">
                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                    Tecnico
                </p>
                <div class="mt-4 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                        <label class="block sm:col-span-6">
                            <span> Receptor</span>
                            <span class="relative mt-1.5 flex">
                                <input
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    value="{{ auth()->user()->name }}"
                                    type="text" disabled/>
                                <span
                                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                    <i class="far fa-user text-base"></i>
                                </span>
                            </span>
                        </label>

                        @if(auth()->user()->role == 'administrador')
                            <label class="block sm:col-span-6">
                                <span>Seleccione el tecnico:</span>
                                <div class="flex justify-between align-middle gap-2">
                                    <select class="mt-1.5 w-full" x-init="$el._tom = new Tom($el, { create: false, sortField: { field: 'text', direction: 'asc' } })" wire:model="tecnico_id">
                                        <option value="" disabled>-- Seleccionar un tecnico --</option>
                                        @foreach ($tecnicos as $tecnico)
                                            <option value="{{ $tecnico->id }}">{{ $tecnico->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tecnico_id')
                                    <span class="text-error">{{ $message }}</span>
                                @enderror
                            </label>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                        <label class="block sm:col-span-6">
                            <span> Fecha de emision</span>
                            <span class="relative mt-1.5 flex">
                                <input wire:model="fecha_emision"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="date" />
                            </span>
                            @error('fecha_emision')
                            <span class="text-error">{{ $message }}</span>
                        @enderror
                        </label>
                        <label class="block sm:col-span-6">
                            <span> Fecha prometida</span>
                            <span class="relative mt-1.5 flex">
                                <input wire:model="fecha_prometida"
                                    class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2  placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    type="date" />
                            </span>
                            @error('fecha_prometida') <span class="text-error">{{ $message }}</span> @enderror
                        </label>
                        {{-- <label class="block sm:col-span-6">
                            <span>Tipo de orden:</span>
                            <div class="flex justify-between align-middle gap-6">
                                <select class="mt-1.5 w-full" x-init="$el._tom = new Tom($el, { create: false, sortField: { field: 'text', direction: 'asc' } })" wire:model="orden">
                                    <option value="" disabled>-- Un tipo de orden --</option>
                                    <option value="Instalacion/activacion">Instalacion/activacion</option>
                                    <option value="Internet/redes">Internet/redes</option>
                                    <option value="impresoras">impresoras</option>
                                    <option value="Encendido de Pc">Encendido de Pc</option>
                                    <option value="Arranque de S.O">Arranque de S.O</option>
                                </select>
                            </div>
                            @error('orden') <span class="text-error">{{ $message }}</span> @enderror
                        </label> --}}
                        <label class="block sm:col-span-6">
                            <span>Tipo de orden:</span>
                            <div class="flex justify-between align-middle gap-6">
                                <select class="mt-1.5 w-full" x-init="$el._tom = new Tom($el, { create: false, sortField: { field: 'text', direction: 'asc' } })" wire:model="orden">
                                    <option value="" disabled>-- Un tipo de orden --</option>
                                    <option value="Falla de Hardware">Falla de Hardware</option>
                                    <option value="Falla de Software">Falla de Software</option>
                                    <option value="Activación de Software">Activación de Software</option>
                                    <option value="Limpieza de Soft/Hard">Limpieza de Soft/Hard</option>
                                    <option value="Instalación de SO">Instalación de SO</option>
                                    <option value="Instalación de Programas">Instalación de Programas</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                            @error('orden') <span class="text-error">{{ $message }}</span> @enderror
                        </label>
                        <label class="block sm:col-span-6">
                            <span>Estado de la orden:</span>
                            <div class="flex justify-between align-middle gap-6">
                                <select class="mt-1.5 w-full" x-init="$el._tom = new Tom($el, { create: false, sortField: { field: 'text', direction: 'asc' } })" wire:model="estado">
                                    <option value="" disabled>-- Un tipo estado --</option>
                                    @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            @error('estado') <span class="text-error">{{ $message }}</span> @enderror
                        </label>
                            </div>
                        {{-- <label class="inline-flex items-center space-x-2">
                            <input
                            wire:model="tipo_orden"
                              class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:bg-slate-500 checked:border-slate-500 hover:border-slate-500 focus:border-slate-500 dark:border-navy-400 dark:checked:bg-navy-400"
                              type="checkbox"
                            />
                            <p>Marcar si la consulta fue remota</p>
                        </label> --}}
                    </div>


                    <div class="flex justify-end space-x-2 mt-2">
                        <button wire:click="ShowEquipo"
                            class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Anterior</span>
                        </button>
                        <button
                        wire:click="Guardar" class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>Guardar</span>

                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="hidden sm:col-span-4 sm:block">
        <div class="sticky top-24 mt-3">
            <ol class="steps is-vertical line-space">
                <li
                    @if ($EquipoForm)
                        class="step pb-8 before:bg-primary dark:before:bg-accent"
                    @else
                        class="step pb-8 before:bg-slate-200 dark:before:bg-navy-500"
                    @endif
                >
                    <div
                        @if ($ClienteForm || $EquipoForm)
                            class="step-header rounded-full bg-primary text-white dark:bg-accent"
                        @else
                            class="step-header rounded-full bg-slate-200 text-slate-800 dark:bg-navy-500 dark:text-white"
                        @endif
                    >
                        @if ($EquipoForm)
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                >
                                <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        @else
                            1
                        @endif
                    </div>
                    <button class="ml-4 text-slate-700 dark:text-navy-100">
                        Cliente
                    </button>

                </li>
                <li
                    @if ($TecnicoForm)
                        class="step pb-8 before:bg-primary dark:before:bg-accent"
                    @else
                        class="step pb-8 before:bg-slate-200 dark:before:bg-navy-500"
                    @endif
                >
                    <div
                        @if ($EquipoForm || $TecnicoForm)
                            class="step-header rounded-full bg-primary text-white dark:bg-accent"
                        @else
                            class="step-header rounded-full bg-slate-200 text-slate-800 dark:bg-navy-500 dark:text-white"
                        @endif
                    >
                        @if ($TecnicoForm)
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                >
                                <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        @else
                            2
                        @endif
                    </div>
                    <button class="ml-4 text-slate-700 dark:text-navy-100">
                        Equipo
                    </button>
                </li>
                <li
                    @if (!$TecnicoForm)
                        class="step pb-8 before:bg-slate-200 dark:before:bg-navy-500"
                    @else
                        class="step pb-8 before:bg-primary dark:before:bg-accent"
                    @endif
                >
                    <div
                        @if (!$TecnicoForm)
                            class="step-header rounded-full bg-slate-200 text-slate-800 dark:bg-navy-500 dark:text-white"
                        @else
                            class="step-header rounded-full bg-primary text-white dark:bg-accent"
                        @endif
                    >
                        3
                    </div>
                    <button class="ml-4 text-slate-700 dark:text-navy-100">
                        Tecnico
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>
