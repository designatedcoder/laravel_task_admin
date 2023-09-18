<script setup>
    import { Link, router, useForm } from '@inertiajs/vue3'
    const props = defineProps({
        task: Object
    })
    const deleteTask = () => {
        router.delete(route('tasks.destroy', props.task.id), {
            onBefore: () => confirm('Are you sure?'),
            preserveScroll: true
        })
    }
    const form = useForm({
        isActive: props.task.is_active
    })
    const toggleStatus = () => {
        form.patch(route('tasks.toggle', props.task.id), {
            preserveScroll:true
        })
    }
</script>

<template>
    <td>
        <Link :href="route('tasks.show', task.id)">
            {{ task.description }}
        </Link>
    </td>
    <td>{{ task.lastRun }}</td>
    <td>{{ task.averageRunTime }} seconds</td>
    <td>{{ task.nextRun }}</td>
    <td>
        <form>
            <label class="toggle">
                <input id="task-toggle" type="checkbox" v-model="props.task.is_active" :checked="props.task.is_active" @change.prevent="toggleStatus">
                <span class="labels" data-on="ON" data-off="OFF"></span>
            </label>
            <!-- <input id="task-toggle" type="checkbox" v-model="props.task.is_active" :checked="props.task.is_active" @change.prevent="toggleStatus"> -->
        </form>
    </td>
    <td>
        <form @submit.prevent="deleteTask">
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</template>

<style scoped>
    .toggle {
        --width: 80px;
        --height: calc(var(--width) / 3);

        position: relative;
        display: inline-block;
        width: var(--width);
        height: var(--height);
        box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
        cursor: pointer;
    }

    .toggle input { display: none; }

    .toggle .labels {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-size: 12px;
        font-family: sans-serif;
        transition: all 0.4s ease-in-out;
        overflow: hidden;
    }

    .toggle .labels::after {
        content: attr(data-off);
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        color: #ffffff;
        background-color: #e3342f;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
        transition: all 0.4s ease-in-out;
    }

    .toggle .labels::before {
        content: attr(data-on);
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: calc(var(--width) * -1);
        height: 100%;
        width: 100%;
        color: #ffffff;
        background-color: #4fe132;
        text-align: center;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.4);
        transition: all 0.4s ease-in-out;
    }

    .toggle input:checked~.labels::after { transform: translateX(var(--width)); }

    .toggle input:checked~.labels::before { transform: translateX(var(--width)); }
</style>

