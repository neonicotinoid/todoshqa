<template>
    <TModal :showing="open">
        <div>
            <div>
                Проект <span class="text-blue-600">{{project.title}}</span> и все вложенные задачи будут полностью удалены.
                Восстановить их будет невозможно.
            </div>
            <div class="flex justify-between mt-6">
                <TButton color="red" @click="$emit('confirmProjectRemoval')">Понял, удалить проект</TButton>
                <TButton @click.prevent="$emit('close')" class="ml-auto">Отмена</TButton>
            </div>
        </div>
    </TModal>
</template>

<script>
import TButton from "@/components/TButton";
import TModal from "@/components/TModal";
export default {
    name: "ModalProjectRemoveConfirm",
    components: {TButton, TModal},
    emits: ['confirmProjectRemoval', 'close'],
    props: {
        project: {
            type: Object,
            required: true,
        },
        open: {
            type: Boolean,
            default: false,
        }
    }

}
</script>
