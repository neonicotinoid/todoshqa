<template>
    <div>
    <Head>
        <title>
            {{ this.task.title }} – задача
        </title>
    </Head>
        <NavHeader :user="auth.user"/>
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <form class="mt-6" @submit.prevent="saveTask">
                <div class="bg-white shadow rounded-lg p-4">
                    <Link class="inline-flex bg-purple-50 rounded-full pl-2 pr-3 py-0.5 mb-6 items-center text-sm text-purple-600 hover:bg-purple-100 duration-150"
                        :href="route('projects.show', this.task.project.id)">
                        <ChevronLeftIcon class="h-5 w-5"/>
                        {{this.task.project.title}}
                    </Link>
                    <div>
                        <input type="text"
                               v-model="taskForm.title"
                               class="block p-2 w-full rounded-lg text-xl sm:text-2xl md:text-3xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 outline-none border-none"
                               >

                        <div v-if="taskForm.errors.title" class="text-red-500 mt-0.5">
                            {{ taskForm.errors.title }}
                        </div>

                    </div>

                    <div class="mt-6">
                        <label for="description" class="block font-medium text-gray-500 mb-1">Описание задачи:</label>
                        <textarea
                            v-model="taskForm.description"
                            id="description"
                            class="block w-full bg-yellow-50 max-w-screen-sm bg-transparent rounded-lg border border-yellow-200
                            active:border-yellow-400
                            focus:border-yellow-400 focus:ring-0
                            outline-none"
                            ></textarea>
                    </div>

                    <div class="mt-6">
                        <div class="block font-medium text-gray-500 mb-1">
                            Крайний срок для выполнения
                        </div>
                        <div class="bg-gray-100 max-w-xs p-2 flex items-center rounded-lg justify-between">
                            <input v-model="taskForm.deadline_date" class="text-sm border border-gray-200 rounded-lg px-2 py-1.5" type="date"
                            >
                        </div>
                    </div>

                    <div class="mt-6 text-gray-400 text-sm">
                        Задача создана {{this.task.created_at}}
                    </div>

                    <div class="mt-6">
                        <TButton>
                            Сохранить задачу
                        </TButton>
                    </div>
                </div>

            </form>

        </div>
    </div>

</template>

<script>
import {ChevronLeftIcon} from "@heroicons/vue/solid";
import { Link } from '@inertiajs/inertia-vue3';
import NavHeader from "@/components/NavHeader";
import TButton from "@/components/TButton";
import {Head} from "@inertiajs/inertia-vue3";

export default {
    name: "Task",
    components: {TButton, NavHeader, ChevronLeftIcon, Link, Head},
    props: {
        auth: {
            user: {
                type: Object,
            }
        },
        task: {
            type: Object,
        },
    },
    data() {
        return {
            taskForm: this.$inertia.form({
                id: this.task.id,
                title: this.task.title,
                description: this.task.description,
                deadline_date: this.task.deadline_date
            }),
        }
    },
    methods: {
        saveTask() {
            this.taskForm.patch(route('task.update', this.task.id));
        },
    }
}
</script>
