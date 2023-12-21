<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import Modal from "../../components/Modal.vue";

const props = defineProps(["quiz"]);

const questionnaires = ref([]);
const quizStart = ref(false);
const excelFile = ref(null);
const answers = ref([null]);

async function getQuestionnaire(id) {
    try {
        const response = await axios.get(`/api/quiz/${id}`);

        questionnaires.value = response.data;
    } catch (error) {
        console.error(error);
    }
}

async function deleteQuestionnaire(id) {
    try {
        const response = await axios.delete(`/api/questionnaire/${id}`);
        if (response) {
            getQuestionnaire(props.quiz.id);
        }
    } catch (error) {
        console.error(error);
    }
}

onMounted(() => {
    getQuestionnaire(props.quiz.id);
});

function redirectTo() {
    window.location.href = `/add-question/${props.quiz.id}`;
}

function startQuiz(boolean = true) {
    quizStart.value = boolean;
}

const uploadFile = async () => {
    const file = excelFile.value.files[0];

    const formData = new FormData();
    formData.append('file', file);

    try {
        const response = await axios.post('/upload/questionnaire', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
            params:{
                'quiz_id': props.quiz.id
            }
        });

        if(response){
            getQuestionnaire(props.quiz.id);
        }
    } catch (error) {
        console.error('Error uploading file:', error);
    }
};

const checkAnswer = async (id, answer) => {
    try {
        const response = await axios.get(`/api/questionnaire/${id}`);

        if(answer === response.data.answer){
            alert('correct');
        } else{
            alert(`wrong answer, correct answer: ${response.data.answer}`)
        }
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <h1 class="text-center mb-2">{{ quiz.quiz_name }}</h1>
    <div v-show="!quizStart">
        <div class="d-flex mb-2 justify-content-center">
            <button
                class="btn btn-light border"
                data-bs-toggle="modal"
                data-bs-target="#importQuestions"
            >
                Import Excel
            </button>
            <button class="btn btn-primary ms-2" @click="redirectTo">
                Add Question
            </button>
            <button class="btn btn-success ms-2" @click="startQuiz">
                Start Quiz
            </button>
        </div>
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-hover text-start">
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
    </div>
    <div v-show="quizStart">
        <div class="d-flex justify-content-center">
            <button class="btn btn-info" @click="startQuiz(false)">Back</button>
        </div>
        <div
            class="card p-4 my-2"
            v-for="(question, index) in questionnaires"
            :key="index"
        >
            <span class="mb-2">{{ question.question }}</span>
            <input
                type="text"
                class="form-control form-control-sm mb-2"
                v-model="answers[index]"
            />
            <div class="d-flex justify-content-end">
                <button
                    type="submit"
                    class="btn btn-primary"
                    @click="checkAnswer(question.id, answers[index])"
                >
                    Submit
                </button>
            </div>
        </div>
    </div>
    <Modal modalTitle="importQuestions" title="Import Excel File">
        <form @submit.prevent="uploadFile">
            <div class="input-group">
                <input
                    type="file"
                    class="form-control"
                    id="inputGroupFile04"
                    aria-describedby="inputGroupFileAddon04"
                    aria-label="Upload"
                    ref="excelFile"
                />
                <button
                    class="btn btn-outline-secondary"
                    type="submit"
                    id="inputGroupFileAddon04"
                >
                    Upload
                </button>
            </div>
        </form>
    </Modal>
</template>
<style scoped>
.cursor-pointer:hover {
    cursor: pointer;
}
</style>
