<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { reactive, ref } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import TodoCard from '@/Pages/TodoCard.vue';
import axios from 'axios';

const form = { todo: '' };
const todos = reactive(usePage().props.todos)

function update(response) {
    router.visit('');
    console.log(response);
}




async function submitTodo() {
    const response = await axios.post(route('store.todo'), form);
    update(response);
}

async function deleteTodo(id) {
    const formData = { id }
    const response = await axios.delete(route('delete.todo', id))
    update(response);
}

async function toggleTodo(id) {
    const formData = { id }
    const response = await axios.put(route('toggle.todo', id));
    // update(response);
}



function editTodo(id, newTodo) {
    const formData = { id, newTodo }
    axios.put(route('edit.todo', formData));
}




</script>

<template>
    <AppLayout title="Todo Page">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Todo page
            </h2>

            <form @submit.prevent="submitTodo" method="post">
                <input v-model="form.todo" type="text" name="todo" id="todo">
                <PrimaryButton type="submit">Add Todo</PrimaryButton>
            </form>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <TodoCard v-for="todo in todos" :key="todo.id" :todo="todo" :deleteTodo="deleteTodo"
                        :editTodo="editTodo" :toggleTodo="toggleTodo" />

                </div>
            </div>
        </div>
    </AppLayout>
</template>
