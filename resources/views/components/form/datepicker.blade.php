<div x-data="{datepicker: null}"
     x-init="datepicker = new window.Datepicker($refs.datepickerInput, {

     })"
    >
    <input x-ref="datepickerInput"
           x-bind:id="$id('input')"
           class="block mt-1.5 w-full px-2.5 py-2 rounded-lg outline-none border border-gray-300 shadow-sm
                hover:border-purple-300
                placeholder:text-gray-500 placeholder:font-normal
                focus:ring-1 focus:ring-purple-500 focus:border-purple-500 ring-inset
                disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                duration-150"/>
</div>
