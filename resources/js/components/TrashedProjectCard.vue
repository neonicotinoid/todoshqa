<template>
    <div class="p-4 bg-white border border-gray-200 hover:border-blue-300 rounded-lg duration-150"
    >
        <div class="flex items-center">
            <div>
                <span class="border-b border-blue-200 hover:border-blue-400"
                   >{{ project.title }}</span>
                <div class="text-sm text-gray-600" v-if="project.description">
                    {{ project.description }}
                </div>
            </div>

            <div class="ml-auto flex space-x-4">
                <button @click.prevent="restoreProject" class="flex items-center hover:text-green-600 px-2 py-0.5 border border-green-200 rounded-xl" title="Восстановить проект">
                    <span class="text-sm text-green-500">
                        Восстановить
                    </span>
                    <ViewGridAddIcon class="ml-2 w-5 h-5 text-green-500 duration-150"/>
                </button>
                <button @click="confirmRemoveProject">
                    <TrashIcon class="w-5 h-5 text-red-300 hover:text-red-500 duration-150"/>
                </button>
            </div>

        </div>

        <ModalProjectRemoveConfirm
            :open="removalConfirmation"
            :project="project"
            @confirmProjectRemoval="removeProject"
            @close="removalConfirmation = false;"
        />


    </div>
</template>

<script>
import {TrashIcon, ViewGridAddIcon} from "@heroicons/vue/solid";
import ModalProjectRemoveConfirm from "@/components/ModalProjectRemoveConfirm";
export default {
    name: "TrashedProjectCard",
    components: {ModalProjectRemoveConfirm, TrashIcon, ViewGridAddIcon},
    props: {
        project: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            removalConfirmation: false,
        }
    },
    methods: {
        restoreProject() {
            this.$inertia.post(route('project.restore', this.project.id));
        },
        confirmRemoveProject() {
            this.removalConfirmation = true;
        },
        removeProject() {
            this.$inertia.delete(route('project.force-delete', this.project.id), {
                onSuccess: () => {this.removalConfirmation = false;}
            });
        }
    }
}
</script>
