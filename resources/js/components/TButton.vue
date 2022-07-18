<template>
    <component :is="this.tag"
                class="flex items-center justify-center whitespace-nowrap space-x-2 text-center
                    active:ring-2 active:ring-offset-1
                    focus:ring-2 focus:ring-offset-1
                    disabled:bg-gray-300 disabled:text-gray-100 disabled:cursor-not-allowed disabled:active:shadow-none
                    duration-200
                    outline-none"
                :class="classObject"
    >
        <slot />
    </component>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {Link},
    props: {
        tag: {
           type: String,
           default: 'button',
        },
        color: {
            type: String,
            default: 'blue',
        },
        size: {
            type: String,
            default: 'base',
        },
        pressable: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            classObject: {
                'bg-blue-500 hover:bg-blue-600 text-blue-50 shadow-sm active:ring-blue-600': this.color === 'blue',
                'bg-white text-gray-800 border border-gray-200 shadow-sm hover:bg-gray-50 active:ring-blue-600': this.color === 'white',
                'bg-red-50 text-red-600 border border-red-300 focus:ring-red-200 active:ring-red-600': this.color === 'red',

                'py-1.5 px-2 text-xs rounded-lg': this.size === 'xs',
                'py-2 px-5 text-sm rounded-lg': this.size === 'base',
                'py-2.5 px-6 text-lg font-medium rounded-xl': this.size === 'lg',

                'transform active:scale-[0.98] active:shadow-none': this.pressable,
            },
        }
    }
}
</script>
