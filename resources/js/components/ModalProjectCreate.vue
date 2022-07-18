<template>
    <TModal :showing="open">
        <form @submit.prevent="createProject">
            <div class="space-y-4">
                <FormGroup label="Название проекта" for="id-1" :error="this.projectForm.errors.title">
                    <TextInput v-model="projectForm.title" id="id-1" :is-error="Boolean(this.projectForm.errors.title)"/>
                </FormGroup>

                <FormGroup label="Описание" for="id-2" :error="this.projectForm.errors.description">
                    <TextareaInput v-model="projectForm.description" id="id-2" :is-error="Boolean(this.projectForm.errors.description)"/>
                </FormGroup>
            </div>
            <div class="mt-6">
                <TButton>Создать проект</TButton>
            </div>
        </form>
    </TModal>
</template>

<script>
import TextInput from "@/components/Form/TextInput";
import TModal from "@/components/TModal";
import TButton from "@/components/TButton";
import TextareaInput from "@/components/Form/TextareaInput";
import FormGroup from "@/components/Form/FormGroup";

export default {
    name: "ModalProjectCreate",
    components: {FormGroup, TextareaInput, TButton, TextInput, TModal},
    props: {
        open: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            projectForm: this.$inertia.form({
                title: '',
                description: '',
            })
        }
    },
    methods: {
        createProject() {
            this.projectForm.post(route('project.store'), {
                onSuccess: () => {this.$emit('close');}
            })
        }
    }
}
</script>

<style scoped>

</style>
