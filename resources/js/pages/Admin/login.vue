<template>
    <div class="row">
        <div class="col-md-5 mx-auto rounded-3 my-5 shadow-sm p-5 bg-light">
            <form @submit.prevent="login">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" v-model="form.email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">password</label>
                    <input type="password" class="form-control" v-model="form.password" required>
                    <button type="submit" class="btn btn-primary mt-4 float-end">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { reactive, ref } from 'vue';
import Swal from 'sweetalert2';
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    function showToast(type, message) {
        Toast.fire({
            icon: type,
            title: message
        });
    }
    export default{
        setup(){
            const form = reactive({
                email: 'admin@example.com',
                password:'admin',
            });

            let error = ref('')

            const login = async () => {
                try {
                    const res = await axios.post('/api/admin/login', form);
                    if (res.data.success === true) {
                        showToast('success', res.data.message);
                        localStorage.setItem('token', res.data.data.token);
                    } else {
                        
                    }
                } catch (error) {
                    showToast('error', error.response.data.message);
                }
            };

            return {
                form, login
            } 
        }
    }
    
</script>