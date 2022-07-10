<template>
    <TModal :showing="open">
        <form @submit.prevent="saveTask">
            <div>
                <TextInput v-model="taskForm.title" name="title" :is-error="Boolean(this.taskForm.errors.title)"/>
                <div v-if="this.taskForm.errors.title" class="text-sm text-red-500"> {{ this.taskForm.errors.title }}</div>
            </div>
            <div>
                <TextInput v-model="taskForm.description" name="description"/>
            </div>
            <div class="mt-6">
                <TButton>Save changes</TButton>
            </div>
        </form>
    </TModal>
</template>

<script>
import TModal from "@/components/TModal";
import TButton from "@/components/TButton";
import TextInput from "@/components/Form/TextInput";
export default {
    name: "ModalTaskEdit",
    components: {TextInput, TButton, TModal},
    props: {
        taskInitial: {
            type: Object,
        },
        open: {
            type: Boolean,
            default: false,
        }
    },
    mounted() {
        console.log('mounted');
    },
    methods: {
        saveTask() {
            this.taskForm.patch(route('task.update', this.taskInitial.id), {errorBag: 'task'});
        }
    },
    data() {
        return {
            taskForm: this.$inertia.form({
                id: this.taskInitial.id,
                title: this.taskInitial.title,
                description: this.taskInitial.description,
            }),
        }
    },
    watch: {
        open: {
            handler(newValue) {
                if(!newValue) {
                    this.taskForm.clearErrors();
                }
            }
        }
    },
    beforeUnmount() {
        console.log('beforeUnmount');
        this.taskForm.clearErrors();
    }
}
</script>
