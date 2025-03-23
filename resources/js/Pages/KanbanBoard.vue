<template>
    <div class="flex justify-center items-start space-x-6 p-10 bg-gray-200 min-h-screen">
        <KanbanColumn 
            status="To Do" 
            :tasks="tasks.filter(task => task.status === 'To Do')" 
            @update:tasks="updateTaskStatus"
        />
        <KanbanColumn 
            status="In Progress" 
            :tasks="tasks.filter(task => task.status === 'In Progress')" 
            @update:tasks="updateTaskStatus"
        />
        <KanbanColumn 
            status="Done" 
            :tasks="tasks.filter(task => task.status === 'Done')" 
            @update:tasks="updateTaskStatus"
        />
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { router } from '@inertiajs/vue3';
import KanbanColumn from '@/Components/KanbanColumn.vue';

const props = defineProps(['tasks']);

const updateTaskStatus = async (updatedTasks) => {
    await axios.post('/tasks/reorder', { tasks: updatedTasks })
        .then(() => console.log("Reorder successful"))
        .catch(err => console.error("Error reordering:", err));
};
</script>
