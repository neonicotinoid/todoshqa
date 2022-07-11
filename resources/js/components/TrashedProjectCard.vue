<template>
    <div class="p-4 bg-white border border-gray-200 hover:border-blue-300 rounded-lg duration-150"
    >
        <div class="flex items-center">
            <div>
                <a class="border-b border-blue-200 hover:border-blue-400"
                   :href="route('project.show', project.id)">{{ project.title }}</a>
                <div class="text-sm text-gray-600" v-if="project.description">
                    {{ project.description }}
                </div>
            </div>

            <div class="ml-auto">
                <button @click="confirmRemoveProject">
                    <TrashIcon class="w-5 h-5 text-gray-300"/>
                </button>
            </div>

        </div>

        <ModalProjectRemoveConfirm
            :open="removalConfirmation"
            :project="project"
            @confirmProjectRemoval="removeProject"
        />


    </div>
</template>

<script>
import {TrashIcon} from "@heroicons/vue/solid";
import ModalProjectRemoveConfirm from "@/components/ModalProjectRemoveConfirm";
export default {
    name: "TrashedProjectCard",
    components: {ModalProjectRemoveConfirm, TrashIcon},
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
