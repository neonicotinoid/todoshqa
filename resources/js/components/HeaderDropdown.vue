<template>
    <div class="ml-3 relative">
        <div>
            <button type="button"
                    @click="isOpen = !isOpen"

                    class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                    aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>

                <div class="w-8 h-8 bg-gray-100 rounded-full">
                    <div v-if="user.avatar">
                        <img :src="user.avatar.original_url">
                    </div>
                    <div v-else>
                        <AvatarPlaceholder :initials="user.initials" :fill="user.avatarPlaceholderColor"/>
                    </div>
                </div>
            </button>
        </div>
        <div v-if="isOpen"
            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
            <!-- Active: "bg-gray-100", Not Active: "" -->
            <Link :href="route('profile')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
               role="menuitem" tabindex="-1">
                Ваш профиль
            </Link>

            <Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" :href="route('logout')" method="post">
                Logout
            </Link>
        </div>
    </div>
</template>

<script>
import AvatarPlaceholder from "@/components/AvatarPlaceholder";
import { Link } from '@inertiajs/inertia-vue3';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
export default {
    name: "HeaderDropdown",
    components: {AvatarPlaceholder, Link, BreezeResponsiveNavLink},
    props: {
        user: {
            type: Object,
        }
    },
    data() {
        return {
            isOpen: false,
        }
    },
}
</script>
