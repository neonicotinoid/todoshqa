<div x-data="{isOpen: @entangle('isProjectAccessModalOpen').defer}"
     x-show="isOpen"
     x-cloak
     x-trap="isOpen"
     class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed z-10 inset-0 overflow-y-auto"
    >
        <livewire:project-sharing-window :project="$project"/>

    </div>
</div>
