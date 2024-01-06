<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0"></p>
                        <div>
                            <button class="btn btn-primary btn-sm ms-auto" @click="editUser()" v-if="isReadOnly()">Edit</button>
                            <div class="btn-group" v-else>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto" @click="saveUser()" :disabled="updating">
                                    <span v-if="updating">Updating</span>
                                    <span v-else>Save</span>
                                </button>
                                <button class="btn btn-danger btn-sm ms-auto" @click="cancelEdit()" :disabled="updating">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">User Information</p>
                    <div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname" class="form-control-label">First name</label>
                                    <input id="firstname" class="form-control" type="text" name="firstname" v-model="userCopy.firstname" :readonly="isReadOnly()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middlename" class="form-control-label">Middle name</label>
                                    <input id="middlename" class="form-control" type="text" name="middlename"  v-model="userCopy.middlename" :readonly="isReadOnly()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname" class="form-control-label">Last name</label>
                                    <input id="lastname" class="form-control" type="text" name="lastname" v-model="userCopy.lastname" :readonly="isReadOnly()">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-6">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select id="gender" class="form-control" name="gender" v-model="userCopy.gender" required :readonly="isReadOnly()">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <!-- @error('gender')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label">Date of birth</label>
                                <div class="input-group">
                                    <input id="dob" name="dob" class="form-control" type="date" v-model="userCopy.dob" required>
                                    <!-- @error('dob')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label mt-md-4">Monthly Savings</label>
                                <div class="input-group">
                                    <span class="input-group-text">NGN</span>
                                    <input id="save_amount" type="number" class="form-control" name="save_amount" aria-label="Amount"
                                        :min="save_amount" v-model="userCopy.save_amount" required>
                                    <!-- @error('save_amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label mt-md-4">Mainone ID</label>
                                <div class="input-group">
                                    <input id="mainone_id" name="mainone_id" class="form-control" type="text" v-model="userCopy.mainone_id" readonly>
                                    <!-- @error('mainone_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-control-label mt-md-4">Email</label>
                                    <input id="email" class="form-control" type="email" name="email" v-model="userCopy.email" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <label class="form-label mt-md-4">Country</label>
                            <div class="input-group">
                                <input id="country" name="country" class="form-control" type="text" v-model="userCopy.country" required :readonly="isReadOnly()">
                                <!-- @error('country')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label class="form-label mt-4">State</label>
                            <div class="input-group">
                                <input id="state" name="state" class="form-control" type="text" v-model="userCopy.state" required :readonly="isReadOnly()">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label class="form-label mt-4">City</label>
                            <div class="input-group">
                                <input id="city" name="city" class="form-control" type="text" v-model="userCopy.city" required :readonly="isReadOnly()">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label class="form-label mt-4">Phone Number</label>
                            <div class="input-group">
                                <input id="phone" name="phone" class="form-control" type="tel" v-model="userCopy.phone" required :readonly="isReadOnly()">
                                <!-- @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label mt-md-4">Address</label>
                            <div class="input-group">
                                <textarea id="address" rows="3" name="address" class="form-control" v-model="userCopy.address" :readonly="isReadOnly()"></textarea>
                                <!-- @error('address')
                                <div class="invalid-feedback" required>
                                    {{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
                    </div>

                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Employment Details</p>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label mt-md-4">Resumption Date</label>
                            <div class="input-group">
                                <input id="resumption_date" name="resumption_date" class="form-control" type="date"
                                    v-model="userCopy.employment_details.resumption_date" required :readonly="isReadOnly()">
                                <!-- @error('resumption_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label mt-4">Department</label>
                            <div class="input-group">
                                <input id="department" name="department" class="form-control" type="text"
                                    v-model="userCopy.employment_details.department" required :readonly="isReadOnly()">
                                <!-- @error('department')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label class="form-label mt-4">Job Title</label>
                            <div class="input-group">
                                <input id="job_title" name="job_title" class="form-control" type="text"
                                    v-model="userCopy.employment_details.job_title" required :readonly="isReadOnly()">
                                <!-- @error('job_title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror -->
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Next of Kin Information</p>
                    <div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label mt-4">First Name</label>
                                <div class="input-group">
                                    <input id="nok_firstname" name="nok_firstname" class="form-control" type="text"
                                        v-model="userCopy.next_of_kin.firstname" required :readonly="isReadOnly()">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label class="form-label mt-4">Last Name</label>
                                <div class="input-group">
                                    <input id="nok_lastname" name="nok_lastname" class="form-control" type="text"
                                        v-model="userCopy.next_of_kin.lastname" required :readonly="isReadOnly()">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label mt-md-4">Date of birth</label>
                                <div class="input-group">
                                    <input id="nok_dob" name="nok_dob" class="form-control" type="date"
                                        v-model="userCopy.next_of_kin.dob" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label mt-4">Email Address</label>
                                <div class="input-group">
                                    <input id="nok_email" name="nok_email" class="form-control" type="email"
                                        v-model="userCopy.next_of_kin.email" required :readonly="isReadOnly()">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label class="form-label mt-4">Phone</label>
                                <div class="input-group">
                                    <input id="nok_phone" name="nok_phone" class="form-control" type="tel"
                                        v-model="userCopy.next_of_kin.phone" required :readonly="isReadOnly()">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <div class="input-group">
                                    <textarea rows="3" name="nok_address" class="form-control"
                                        v-model="userCopy.next_of_kin.address" required :readonly="isReadOnly()"></textarea>
                                    <!-- @error('nok_address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <user-summary :user="userCopy"></user-summary>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        },
        save_amount: {
            type: Number,
            required: true
        }
    },
    data(){
        return {
            action: 'view',
            userCopy: _.cloneDeep(this.user),
            updating: false
        }
    },

    methods: {
        isReadOnly(){
            return this.action == 'view';
        },

        setToReadonly(){
            this.action = 'view';
        },

        editUser(){
            this.action = 'edit';
        },

        cancelEdit(){
            this.userCopy = _.cloneDeep(this.user);
            this.setToReadonly();
        },
        saveUser(){
            this.updating = true;
            axios.post(`/api/users/${this.user.mainone_id}/edit`, this.userCopy).then(response => {
                let data = response.data;
                if(data.success){
                    this.setToReadonly();
                    this.$swal.fire({
                        title: 'Success',
                        text: 'User successfully updated',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        timer: 5000
                    });
                }
            }).error(err => {
                this.$swal.fire({
                    title: 'Error',
                    text: 'An error occurred while updating the user',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 5000
                });
            }).finally(() => {
                this.updating = false;
            });
        }
    }
}
</script>
