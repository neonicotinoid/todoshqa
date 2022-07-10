<template>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-xl md:text-3xl font-bold text-gray-900">
                    {{ project.title }}
                </h1>
                <div v-if="project.description" class="text-xs md:text-sm text-gray-400 mt-2">
                    {{ project.description }}
                </div>
            </div>
            <div>
                <button  class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"
                        >
                </button>
                <button class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"

                >

                </button>
                <button class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"

                >

                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="space-y-4 px-2 md:px-0">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold text-gray-500">
                        Задачи
                    </h2>
                    <div>
                        <select
                            v-model="sorting"
                            class="text-sm px-2 py-1 pr-8 rounded-lg border border-gray-300 shadow-sm">
                            <option value="created_desc">новые сверху</option>
                            <option value="created_asc">новые снизу</option>
                            <option value="deadline">по дэдлайну</option>
                        </select>
                    </div>
                </div>

                <TransitionGroup
                    enter-active-class="transition ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-95"
                    enter-to-class="opacity-100 translate-y-100"
                    leave-active-class="transition ease-in duration-300"
                    leave-from-class="opacity-100 translate-y-100"
                    leave-to-class="opacity-0 translate-y-95"
                appear>
                    <TTask v-for="task in tasks" :task="task" :key="task.id" @openTaskEdit="openTaskEdit"/>
                </TransitionGroup>
            </div>
        </div>
        <ModalTaskEdit
                       v-if="quickTaskEdit"
                       :open="quickTaskEdit"
                       :task-initial="openedTask"
                       @close="quickTaskEdit = false;" />
    </main>
</template>

<script>
import TTask from "@/components/TTask";
import {Inertia} from "@inertiajs/inertia";
import TModal from "@/components/TModal";
import TButton from "@/components/TButton";
import ModalTaskEdit from "@/components/ModalTaskEdit";

export default {
    name: "Project",
    components: {ModalTaskEdit, TButton, TModal, TTask},
    props: {
        errors: {
            type: Object,
        },
        project: {
            type: Object,
        },
        tasks: {
            type: Array,
        },
    },
    data() {
        return {
            sorting: 'created_desc',
            quickTaskEdit: false,
            openedTask: null,
        }
    },
    methods: {
        openTaskEdit(task) {
            this.openedTask = task;
            this.quickTaskEdit = true;
        },
    },
    watch: {
        sorting: {
            handler: function () {
                Inertia.visit(route('project.show', this.project.id), {
                    only: ['tasks'],
                    data: {sorting: this.sorting},
                    preserveState: true,
                });
            },
        },
    },
}
</script>
