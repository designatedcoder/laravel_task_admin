<script setup>
    import TaskItem from '@/Components/Custom/TaskItem.vue'
    defineProps({
        tasks: Array
    })
</script>

<template>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Last Run</th>
                <th>Average Runtime</th>
                <th>Next Run</th>
                <th>On/Off</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="task in tasks" :key="task.id">
                <TaskItem :task="task" />
            </tr>
        </tbody>
    </table>
</template>
