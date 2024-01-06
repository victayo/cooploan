<template>
    <div>
        <div class="card shadow-lg mx-4 card-profile-bottom">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img :src="`https://ui-avatars.com/api/?name=${user.firstname} ${user.lastname}&color=7F9CF5&background=EBF4FF`"
                                alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ user.firstname }} {{ user.lastname }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ user.employment_details.job_title }}, {{ user.employment_details.department }}
                            </p>
                            <p>
                                <span :class="`text-sm font-weight-bold text-capitalize mb-0 font-italic mt-2 p-2 badge ${statusClass}`">{{ user.status }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="btn-group position-relative end-0" v-if="user.status == 'pending'">
                            <button class="btn btn-success" @click="updateStatus('approve')">Approve</button>
                            <button class="btn btn-danger" @click="updateStatus('decline')">Decline</button>
                        </div>
                        <div class="btn-group position-relative end-0">
                            <button class="btn btn-danger" @click="updateStatus('deactivate')" v-if="user.status == 'active'">Deactivate</button>
                            <button class="btn btn-success" @click="updateStatus('activate')"  v-if="user.status == 'inactive'">Activate</button>
                            <button class="btn btn-success" @click="updateStatus('approve')"  v-if="user.status == 'declined'">Approve</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    },

    data(){
        return {
            statusClass: ''
        }
    },

    mounted(){
        this.setStatusClass();
    },

    methods:{
        updateStatus(type){
            let icon, confirmBtn, text, url, status = '';
            switch(type){
                case 'approve':
                    icon = 'success';
                    confirmBtn = 'Approve';
                    text = 'approved';
                    url = `/api/users/${this.user.mainone_id}/approve`;
                    status = 'active';
                break;
                case 'decline':
                    icon = 'error';
                    confirmBtn = 'Decline';
                    text = status = 'declined';
                    url = `/api/users/${this.user.mainone_id}/decline`
                break;
                case 'activate':
                    icon = 'success';
                    confirmBtn = 'Activate';
                    text = 'activated';
                    url = `/api/users/${this.user.mainone_id}/activate`;
                    status = 'active';
                break;
                case 'deactivate':
                    icon = 'error';
                    confirmBtn = 'Deactivate';
                    text = 'deactivated';
                    url = `/api/users/${this.user.mainone_id}/deactivate`;
                    status = 'inactive';
                break;
            }

            this.$swal.fire({
                text: 'Are you sure?',
                icon: icon,
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: confirmBtn,
                cancelButtonText: 'Cancel'
            }).then(response => {
                if(response.isConfirmed){
                    axios.post(url).then(response => {
                        if(response.data.success){
                            this.$swal.fire({
                                toast: true,
                                position: 'top-end',
                                text: `User successfully ${text}`,
                                showConfirmButton: false,
                                icon: 'success',
                                timer: 3000,
                                timerProgressBar: true
                            });
                            this.user.status = status;
                            this.setStatusClass();
                            this.$forceUpdate();
                        }
                    })
                }
            });
        },

        setStatusClass(){
            switch (this.user.status.toLowerCase()){
                case 'active':
                    this.statusClass = 'badge-success';
                    break;
                case 'inactive':
                case 'declined':
                    this.statusClass = 'badge-danger';
                    break;
                case 'pending':
                    this.statusClass = 'badge-info';
                    break;
                default:
                    'badge-black';
            }
        }

    }
}
</script>
