<script setup>
import axios from 'axios';
import { ref, reactive } from 'vue';

const props = defineProps([
    'quiz'
]);

const errors = ref([])
const quizForm = reactive({
    quiz_id: props.quiz.id,
    question: '',
    answer: '',
})

async function addQuestion(){
    try {
        const response = await axios.post('/api/questionnaire',{
            ...quizForm
        })
        if(response){
            window.location.href = `/quiz/${props.quiz.id}`;
        }
    } catch (error) {
        errors.value = error.response.data.errors;
    }
}
</script>

<template>
    <h1>Create</h1>
    <form @submit.prevent="addQuestion">
        <input type="hidden" v-model="quizForm.quiz_id" >
        <div class="mb-3">
            <label
                for="question"
                class="form-label"
            >
                Question
            </label>
            <input
                type="text"
                class="form-control"
                id="question"
                aria-describedby="question"
                v-model="quizForm.question"
            />
            <span
                class="text-danger"
                v-if="errors?.question"
            >
                {{ errors.question[0] }}
            </span>
        </div>
        <div class="mb-3">
            <label
                for="answer"
                class="form-label"
            >
                Answer
            </label>
            <input
                type="text"
                class="form-control"
                id="answer"
                aria-describedby="answer"
                v-model="quizForm.answer"
            />
            <span
                class="text-danger"
                v-if="errors?.answer"
            >
                {{ errors.answer[0] }}
            </span>
        </div>
        <button type="reset" class="btn btn-danger me-2">Reset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>
