<template>
    <TModal :showing="open">
        <form @submit.prevent="saveTask">
            <div class="space-y-4">
                <FormGroup label="Задача" for="title">
                    <TextInput v-model="taskForm.title" name="title" id="title" :is-error="Boolean(this.taskForm.errors.title)"/>
                    <div v-if="this.taskForm.errors.title" class="text-sm text-red-500"> {{ this.taskForm.errors.title }}</div>
                </FormGroup>

                <FormGroup label="Заметка" for="note">
                    <NoteTextareaInput id="note" v-model="taskForm.description"/>
                </FormGroup>
            </div>
            <div class="mt-6">
                <div class="bg-gray-50 p-2 flex items-center rounded-lg justify-between">
                    <input v-model="taskForm.deadline_date" class="text-sm border border-gray-200 rounded-lg px-2 py-1.5" type="date"
                    >
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <TButton>Сохранить</TButton>
                <TButton color="red" size="xs" @click.prevent="remove">Удалить задачу</TButton>
            </div>
        </form>
    </TModal>
</template>

<script>
import TModal from "@/components/TModal";
import TButton from "@/components/TButton";
import TextInput from "@/components/Form/TextInput";
import FormGroup from "@/components/Form/FormGroup";
import NoteTextareaInput from "@/components/Form/NoteTextareaInput";
export default {
    name: "ModalTaskEdit",
    components: {NoteTextareaInput, FormGroup, TextInput, TButton, TModal},
    props: {
        taskInitial: {
            type: Object,
        },
        open: {
            type: Boolean,
            default: false,
        }
    },
    methods: {
        saveTask() {
            this.taskForm.patch(route('task.update', this.taskInitial.id), {errorBag: 'task'});
        },
        remove() {
            this.$inertia.form({}).delete(route('task.destroy', this.taskInitial.id), {
                onSuccess: () => this.$emit('close'),
                preserveScroll: true,
            });
        },
    },
    data() {
        return {
            taskForm: this.$inertia.form({
                id: this.taskInitial.id,
                deadline_date: this.taskInitial.deadline_date,
                title: this.taskInitial.title,
                description: this.taskInitial.description,
            }),
        }
    },
    beforeUnmount() {
        this.taskForm.clearErrors();
    }
}
</script>
