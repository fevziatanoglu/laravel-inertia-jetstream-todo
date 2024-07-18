<script setup>
import { ref } from 'vue';

const props = defineProps({
    'todo': Object,
    'toggleTodo': Function,
    'deleteTodo': Function,
    'editTodo': Function

});

let completed = ref(props.todo.completed ? true : false);
let editMode = ref(false);
let newTodo = ref(props.todo.todo);

function toggleTodo() {
    props.toggleTodo(props.todo.id);
}

function deleteTodo() {
    props.deleteTodo(props.todo.id);
}

function editTodo() {
    props.editTodo(props.todo.id, newTodo.value);
    props.todo.todo = newTodo.value;
    editMode.value = false;
}

function toggleEdit() {
    editMode.value = !editMode.value;
}

</script>

<template>
    <div :class="{ 'bg-black': completed, 'bg-yellow-500': !completed }">
        <div v-if="!editMode">
            <h1>{{ todo.todo }}</h1>
            <input v-on:click="toggleTodo" type="checkbox" v-model="completed" :value="completed.value" />
            <button class="bg-red-500 p-2" v-on:click="deleteTodo">x</button>
            <button class="bg-green-500 p-2" v-on:click="toggleEdit">edit</button>
        </div>
        <div v-else>
            <!-- Edit mode -->
            <input type="text" v-model="newTodo">
            <button class="bg-green-500" v-on:click="editTodo">Done</button>
            <button class="bg-red-500" v-on:click.stop="toggleEdit">Cancel</button>
        </div>
    </div>
</template>
