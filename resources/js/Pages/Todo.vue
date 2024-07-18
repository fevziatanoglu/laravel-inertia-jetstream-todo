<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { reactive, ref } from 'vue'
import { usePage } from '@inertiajs/vue3'
import TodoCard from '@/Pages/TodoCard.vue';
import axios from 'axios';


const form = { todo: '' };
const todos = reactive(usePage().props.todos)


function submitTodo() {
    console.log(form.todo);
    axios.post(route('store.todo'), form).then((response) => { todos.unshift(response.data.todo); }).catch((error) => { console.log(error) });
}

function toggleTodo(id, status) {
    const formData = { id }
    console.log(formData);
    axios.put(route('toggle.todo' , id)).then((response) => { console.log(response) }).catch((error) => { console.log(error) });
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

                    <TodoCard v-for="todo in todos" :key="todo.id" :todo="todo" :toggleTodo="toggleTodo" />

                </div>
            </div>
        </div>
    </AppLayout>
</template>
