<template>
    <Head>
        <title>
            {{ this.project.title }}
        </title>
    </Head>
    <NavHeader :user="this.auth.user"/>
    <ProjectHeader :project="this.project"/>

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

                <div>
                    <NewTaskForm :project="this.project" />
                </div>

                <TransitionGroup
                    enter-active-class="transition ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-95"
                    enter-to-class="opacity-100 translate-y-100"
                    leave-active-class="transition ease-in duration-300"
                    leave-from-class="opacity-100 translate-y-100"
                    leave-to-class="opacity-0 translate-y-95"
                appear>
                    <TTask v-for="task in actualTasks" :task="task" :key="task.id" @openTaskEdit="openTaskEdit"/>
                </TransitionGroup>

                <div>
                    <div class="flex justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-500">
                            Законченные задачи
                        </h2>
                    </div>
                    <div class="space-y-4">
                        <TransitionGroup
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="opacity-0 translate-y-95"
                            enter-to-class="opacity-100 translate-y-100"
                            leave-active-class="transition ease-in duration-300"
                            leave-from-class="opacity-100 translate-y-100"
                            leave-to-class="opacity-0 translate-y-95"
                            appear>
                            <TTask v-for="task in completedTasks" :task="task" :key="task.id"
                                   />
                        </TransitionGroup>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>

<script>
import TTask from "@/components/TTask";
import {Inertia} from "@inertiajs/inertia";
import TModal from "@/components/TModal";
import TButton from "@/components/TButton";
import NewTaskForm from "@/components/NewTaskForm";
import NavHeader from "@/components/NavHeader";
import ProjectHeader from "@/components/ProjectHeader";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    name: "Project",
    components: {ProjectHeader, NavHeader, NewTaskForm, TButton, TModal, TTask, Head},
    props: {
        errors: {
            type: Object,
        },
        project: {
            type: Object,
        },
        actualTasks: {
            type: Array,
        },
        completedTasks: {
            type: Array,
        },
        auth: {
            type: Object,
            user: {
                type: Object,
            }
        }
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
            handler() {
                Inertia.visit(route('project.show', this.project.id), {
                    only: ['actualTasks'],
                    data: {sorting: this.sorting},
                    preserveState: true,
                });
            },
        },
    },
}
</script>
