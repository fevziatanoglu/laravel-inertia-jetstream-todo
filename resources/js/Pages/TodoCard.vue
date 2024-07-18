<script setup>
import { ref } from 'vue';

// defineProps(['todo']);
const props = defineProps(
    { 'todo': Object, toggleTodo: Function })

let completed = ref(props.todo.completed ? true : false);

console.log(props.todo);
function toggleTodo() {
    completed.value = !completed.value;

    props.toggleTodo( props.todo.id );
}

</script>

<template>
    <div :class="{ 'bg-black': completed, 'bg-yellow-500': !completed }">
        <h3>{{ todo.todo }}</h3>
        <input v-on:click="toggleTodo" type="checkbox" v-model="completed" :value="completed.value" />
    </div>
</template>
