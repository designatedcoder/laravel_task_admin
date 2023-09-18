<script setup>
    import { Link, useForm } from '@inertiajs/vue3'
    import AppLayout from '@/Layouts/AppLayout.vue'
    const form = useForm({
        description: '',
        command: '',
        expression: '',
        notification_email: '',
        dont_overlap: '',
        run_in_maintenance: ''
    })
    const submit = () => {
        form.post(route('tasks.store'))
    }
</script>

<template>
    <AppLayout title="Create a Task">
        <template #header>
            <h2 class="h4 font-weight-bold">Create a Task</h2>
        </template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create New Task</div>

                        <div class="card-body">
                            <form @submit.prevent="submit">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" name="description" v-model="form.description">
                                </div>
                                <div class="form-group">
                                    <label for="command">Command</label>
                                    <input type="text" class="form-control" name="command" v-model="form.command">
                                </div>
                                <div class="form-group">
                                    <label for="command">Cron Expression</label>
                                    <input type="text" class="form-control" name="expression" placeholder="* * * * *" v-model="form.expression">
                                </div>
                                <div class="form-group">
                                    <label for="notification_email">Notifications Email Address</label>
                                    <input type="email" class="form-control" name="notification_email" v-model="form.notification_email">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="dont_overlap" value="1" v-model="form.dont_overlap">
                                    <label for="dont_overlap" class="form-check-label">Don't Overlap</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="run_in_maintenance" value="1" v-model="form.run_in_maintenance">
                                    <label for="run_in_maintenance" class="form-check-label">Run in maintenance</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary">Save Task</button>
                                        <Link :href="route('tasks.index')" class="btn btn-secondary">Cancel</Link>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
