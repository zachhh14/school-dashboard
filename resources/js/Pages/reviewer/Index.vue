<script setup>
import axios from "axios";
import Dashboard from "../../components/Dashboard.vue";
import Modal from "../../components/Modal.vue";
import { reactive, onMounted,ref } from "vue";

const quizzes = ref([]);
const props = defineProps({
    subject: Object,
});

onMounted(()=>{
    getQuiz();
})

const quizForm = reactive({
    subject_id: props.subject.id,
    quiz_name: "",
});

async function getQuiz(){
    try{
        const response = await axios.get('/api/reviewer/list',{
            params:{
                'subject_id': props.subject.id,
            }
        });

        quizzes.value = response.data;
    } catch(error){
        console.error(error);
    }
}

async function createQuiz(){
    try{
        const response = await axios.post('/create-quiz',{
            ...quizForm
        });

    } catch(error){
        console.error(error);
    }
}
</script>

<template>
    <h1>Quiz for {{ subject.subject_name }}</h1>
    <Dashboard>
        <ul>
            <li v-for="quiz in quizzes">
                {{ quiz.quiz_name }}
            </li>
        </ul>
    </Dashboard>
    <button
        type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#createQuiz"
    >
        Create Quiz
    </button>
    <Modal modalTitle="createQuiz" title="Create Quiz">
        <form @submit.prevent="createQuiz">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label"
                    >Quiz Name</label
                >
                <input
                    type="text"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    v-model="quizForm.quiz_name"
                />
            </div>
            <button
                type="submit"
                data-bs-dismiss="modal"
                class="btn btn-primary"
            >
                Submit

            </button>
        </form>
    </Modal>
</template>
