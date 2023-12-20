<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const props = defineProps([
    'quiz'
])

const questionnaires = ref([]);

async function getQuestionnaire(id){
    try {
        const response = await axios.get(`/api/quiz/${id}`);

        questionnaires.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

async function deleteQuestionnaire(id){
    try {
        const response = await axios.delete(`/api/questionnaire/${id}`);

        if (response){
            getQuestionnaire(props.quiz.id);
        }
    } catch (error) {
        console.error(error)
    }
}

onMounted(()=>{
    getQuestionnaire(props.quiz.id);
})

function redirectTo() {
    window.location.href = `/add-question/${props.quiz.id}`;

}

</script>
<template>
    <h1 class="text-center mb-2">{{ quiz.quiz_name }}</h1>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">Question</th>
                <th scope="col">Answer</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="table-hover">
            <tr v-for="question in questionnaires">
                <td class="w-75">{{ question.question }}</td>
                <td class="w-25">{{ question.answer }}</td>
                <td>
                    <button
                    class="btn btn-danger"
                    @click="deleteQuestionnaire(question.id)"
                >
                    Delete
                </button>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary" @click="redirectTo">Add Question</button>
    <button class="btn btn-success ms-2">Import Excel</button>
</template>
<style scoped>
.cursor-pointer:hover{
    cursor: pointer;
}
</style>
