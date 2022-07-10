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
            >
                {{ task.title }}
        </div>
            <div class="flex space-x-1">
                <div v-if="task.description">
                    <span class="px-1.5 py-0.5 bg-gray-100 text-gray-700 text-xs rounded-lg">Note</span>
                </div>
                <div v-if="task.deadline_date">
                <span class="px-1.5 py-0.5 bg-yellow-100 text-yellow-700 text-xs rounded-lg">
                    {{ task.deadline_date }}
                </span>
                </div>
            </div>
        </div>
        <button @click="$emit('openTaskEdit', task)">edit</button>
    </div>

</template>

<script>
import axios from 'axios';
export default {
    name: "TTask",
    props: {
        task: {
            type: Object,
        }
    },
    emits: ['openTaskEdit'],
    methods: {
      toggle() {
          axios.post(route('task.complete', this.task.id)).then(res => (console.log(res)));
      }
    },
}
</script>

