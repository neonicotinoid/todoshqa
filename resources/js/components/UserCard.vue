<template>

    <div  class="flex items-center p-2 border border-gray-200 bg-gray-50 rounded-lg">
        <div class="w-10 h-10 mr-2 rounded-full overflow-hidden">
            <img v-if="user.avatar" :src="user.avatar.original_url">
            <AvatarPlaceholder v-else :fill="user.avatarPlaceholderColor" :initials="user.initials"/>
        </div>
        <div class="text-sm text-gray-800">
            <p>
                {{ user.name }}
            </p>
            <p class="text-gray-400 text-xs font-normal">
                {{ user.email }}
            </p>
        </div>

        <slot name="actions" />

    </div>

</template>

<script>
import AvatarPlaceholder from "@/components/AvatarPlaceholder";
export default {
    name: "UserCard",
    components: {AvatarPlaceholder},
    props: {
        user: {
            type: Object,
            required: true,
        }
    }
}
</script>
