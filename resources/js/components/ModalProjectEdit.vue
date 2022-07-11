<template>
    <TModal :showing="open">
        <form @submit.prevent="saveProject">
            <div class="space-y-4">
                <FormGroup label="Название проекта" for="title" :error="this.projectForm.errors.title">
                    <TextInput v-model="projectForm.title" id="title" :is-error="Boolean(this.projectForm.errors.title)"/>
                </FormGroup>

                <FormGroup label="Описание" for="description" :error="this.projectForm.errors.description">
                    <TextareaInput v-model="projectForm.description" id="description" :is-error="Boolean(this.projectForm.errors.description)"/>
                </FormGroup>
            </div>

            <div class="mt-6">
                <TButton>Сохранить</TButton>
            </div>
        </form>

    </TModal>
</template>

<script>
import TModal from "@/components/TModal";
import TextInput from "@/components/Form/TextInput";
import TButton from "@/components/TButton";
import FormGroup from "@/components/Form/FormGroup";
import TextareaInput from "@/components/Form/TextareaInput";
export default {
    name: "ModalProjectEdit",
    components: {TextareaInput, FormGroup, TButton, TextInput, TModal},
    props: {
        open: {
            type: Boolean,
            default: false,
        },
        project: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            projectForm: this.$inertia.form({
                id: this.project.id,
                title: this.project.title,
                description: this.project.description,
            })
        }
    },
    methods: {
        saveProject() {
            this.projectForm.put(route('project.update', this.project.id), {
                onSuccess: () => {this.$emit('close')},
            });
        },
    }
}
</script>

