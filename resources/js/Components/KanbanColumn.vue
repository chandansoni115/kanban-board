<template>
    <div class="w-1/3 bg-white p-5 shadow-md rounded-lg">
        <h2 class="text-lg font-bold mb-4 text-gray-700">{{ status }}</h2>

        <!-- ✅ Open Modal on Click -->
        <button @click="showModal = true" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded mb-3 transition">
            + New Task
        </button>

        <!-- ✅ Task Creation Modal -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h2 class="text-lg font-semibold mb-4">Add New Task</h2>
                <textarea 
                    v-model="newTask.description" 
                    placeholder="Enter task Name" 
                    class="w-full p-2 border rounded mb-3 resize-none"
                ></textarea>

                <div class="flex justify-end space-x-2">
                    <button @click="showModal = false" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button @click="addTask" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Add Task</button>
                </div>
            </div>
        </div>

        <!-- ✅ Draggable Task List -->
        <draggable v-model="localTasks" group="tasks" item-key="id" @end="handleDragEnd" class="space-y-3">
            <template #item="{ element }">
                <div class="bg-white p-4 rounded-lg flex justify-between items-center shadow-md border border-gray-300 transition hover:bg-gray-100">
                    <span class="text-gray-800 font-medium">{{ element.title }}</span>
                    <button @click="deleteTask(element.id)" class="text-red-500 hover:text-red-700 font-bold transition">✖</button>
                </div>
            </template>
        </draggable>
    </div>
</template>

<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';
import draggable from 'vuedraggable';

const props = defineProps(['status', 'tasks']);
const emit = defineEmits(['update:tasks']);

const localTasks = ref(props.tasks);
const showModal = ref(false);
const newTask = ref({ description: '' });

watch(() => props.tasks, (newTasks) => {
    localTasks.value = newTasks;
}, { deep: true });

const addTask = async () => {
    if (!newTask.value.description.trim()) {
        alert("Task description is required!");
        return;
    }

    await router.post('/tasks', { 
        title: newTask.value.description, // ✅ Save description as title
        status: props.status, 
        position: localTasks.value.length + 1 
    });

    showModal.value = false;
    newTask.value = { description: '' };
};

const deleteTask = async (taskId) => {
    console.log("Deleting task with ID:", taskId);
    console.log(`DELETE request sent to: /tasks/${taskId}`);

    if (!taskId) {
        console.error("❌ Error: Task ID is undefined.");
        return;
    }

    try {
        await axios.delete(`/tasks/${taskId}`); // ✅ Use axios directly
        console.log("✅ Task deleted successfully.");

        localTasks.value = localTasks.value.filter(t => t.id !== taskId);
        console.log("Updated task list after removing:", localTasks.value);
    } catch (err) {
        console.error("❌ Error deleting task:", err);
    }
};


const handleDragEnd = () => {
    emit('update:tasks', localTasks.value);
};
</script>
