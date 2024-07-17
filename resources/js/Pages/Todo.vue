<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { reactive, ref } from 'vue'
import { usePage } from '@inertiajs/vue3'


const form = {
    todo: ''
};
const todos = reactive(usePage().props.todos)


function submitForm() {
    console.log(form.todo);
    axios.post(route('store.todo'), form).then((response) => {  todos.unshift(response.data.todo);  }).catch((error) => { console.log(error) });
}


</script>

<template>
    <AppLayout title="Todo Page">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo page
            </h2>

            <form @submit.prevent="submitForm" method="post">
                <input v-model="form.todo" type="text" name="todo" id="todo">
                <PrimaryButton type="submit">Add Todo</PrimaryButton>
            </form>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul>
                        <li v-for="todo in todos" :key="todo.id">{{ todo.todo }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
