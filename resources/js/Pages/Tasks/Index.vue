<script setup>
    import { Link } from '@inertiajs/vue3'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Tasks from '@/Components/Custom/Tasks.vue'
    const props = defineProps({
        tasks: Array
    })
</script>

<template>
    <AppLayout title="Tasks">
        <template #header>
            <h2 class="h4 font-weight-bold">Tasks</h2>
        </template>
    <div class="container">
        <div class="row justify-content-center py-1">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Tasks
                            <Link class="btn btn-primary float-end" :href="route('tasks.create')">New Task</Link>
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="$page.props.flash.status">
                            {{ $page.props.flash.status }}
                        </div>

                        <Tasks :tasks="tasks" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </AppLayout>
</template>
