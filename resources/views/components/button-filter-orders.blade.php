@props(['technicians'])

<div wire:ignore x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="isShowPopper &amp;&amp; (isShowPopper = false)" class="inline-flex">
  <button 
    x-tooltip="'Filtrar Órdenes'"
    x-ref="popperRef" @click="isShowPopper = !isShowPopper" 
    class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
  >
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter h-4.5 w-4.5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
      <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"></path>
    </svg>
  </button>
  <div x-ref="popperRoot" class="popper-root" :class="isShowPopper &amp;&amp; 'show'" style="position: fixed; inset: auto 0px 0px auto; margin: 0px; transform: translate(-64px, 59px);" data-popper-placement="top-end" data-popper-reference-hidden="">
    <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
      <ul>
        <li>
          <span class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Por Estado</span>
        </li>
      </ul>
      <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
      <ul>
        <li wire:click="$set('status', 0)">
          <a class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none cursor-pointer transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Todas</a>
        </li>
        <li wire:click="$set('status', 5)">
          <a class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none cursor-pointer transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Solucionadas</a>
        </li>
        <li wire:click="$set('status', 1)">
          <a class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none cursor-pointer transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Pendientes</a>
        </li>
      </ul>
      <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
      <ul>
        <li>
          <span class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Por Técnico</span>
        </li>
      </ul>
      <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
      <select
        class="mt-1.5 w-full"
        x-init="$el._tom = new Tom($el,{create: false,maxOptions: 5,sortField: {field: 'text',direction: 'asc'}})"
        placeholder="Técnicos"
        wire:model="technician"
      >
        <option value="0">Todos</option>
        @foreach ($technicians as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>