<template>

    <div class="flex bg-white shadow rounded-lg px-4 py-3 border border-transparent hover:bg-gray-50 duration-150">
        <input
        v-model="task.is_completed"
        type="checkbox"
        @change="toggle"
        tabindex="-1"
        class="relative top-0.5 rounded mr-3 h-5 w-5 border-2 border-fuchsia-300 text-fuchsia-600 duration-150 focus:ring-fuchsia-600"
        >

        <div>
            <div class="text-sm md:text-base text-gray-700"
                 :class="{'line-through opacity-80': task.is_completed}"
            >
                {{ task.title }}
        </div>
            <div class="flex space-x-1">
                <div v-if="task.description">
                    <span class="px-1.5 py-0.5 bg-gray-100 text-gray-700 text-xs rounded-lg">Note</span>
                </div>
                <div v-if="task.deadline_date">
                <span class="px-1.5 py-0.5 text-xs rounded-lg" :class="{
                    'bg-yellow-100 text-yellow-700': task.deadline_status === 'inWork',
                    'bg-red-100 text-red-600': task.deadline_status === 'overdued',
                    'bg-gray-100 text-gray-400': task.deadline_status === 'completed',
                    }">
                    {{ task.deadline_date }}
                </span>
                </div>
            </div>
        </div>

        <div class="relative ml-auto">
            <div class="flex space-x-0.5 items-center">
                <button @click="$emit('openTaskEdit', task)">
                    <DotsVerticalIcon class="w-4 h-4 text-gray-300"/>
                </button>

                <a :href="route('task.show', task.id)">
                    <LinkIcon class="w-4 h-4 text-gray-300"/>
                </a>

                <label>
                      <LightBulbIcon class="w-5 h-5 cursor-pointer" :class="{'text-yellow-500': task.isInMyDay, 'text-gray-300': !task.isInMyDay}"/>
                        <input
                            @change="myDay"
                            class="hidden"
                            type="checkbox"
                            v-model="task.isInMyDay"
                        >
                </label>

            </div>

        </div>
    </div>

</template>

<script>
import axios from 'axios';
import {DotsVerticalIcon, LightBulbIcon, LinkIcon} from '@heroicons/vue/solid';
import {Inertia} from "@inertiajs/inertia";
export default {
    name: "TTask",
    components: {DotsVerticalIcon, LightBulbIcon, LinkIcon},
    props: {
        task: {
            type: Object,
        }
    },
    emits: ['openTaskEdit'],
    methods: {
      toggle() {
          this.$inertia.form({}).post(route('task.complete', this.task.id));
      },
      myDay() {
          // this.$inertia.form({}).post(route('task.myday', this.task.id));
          axios.post(route('task.myday', this.task.id)).then(res => (console.log(res)));
      },
    },
}
</script>

