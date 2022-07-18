<template>
    <div>
        <form class="relative" @submit.prevent="createTask">
            <div class="flex items-center pb-2 border-b border-gray-200">
                <TextInput v-model="taskForm.title" placeholder="Add new task"/>
            </div>
            <div class="absolute right-2 top-3">
                <button class="bg-white rounded-lg shadow-sm border border-slate-200 text-xs text-slate-500 px-2.5 py-1.5 flex items-center">
                    <span>
                    Add
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import TextInput from "@/components/Form/TextInput";

export default {
    name: "NewTaskForm",
    components: {TextInput},
    props: {
        project: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            taskForm: this.$inertia.form({
                project_id: this.project.id,
                title: '',
            }),
        }
    },

    methods: {
        createTask() {
            this.taskForm.post(route('task.store'), {onSuccess: () => this.taskForm.reset('title'),});
        },
    }
}
</script>
