<template>
    <div class="card mt-4">
        <div class="card-header">
            <h5>New Loan</h5>
        </div>
        <div class="card-body pt-0">
            <form @submit.prevent="onSubmit">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label mt-md-4">Loan Amount</label>
                        <div class="input-group">
                            <input id="loan_amount" name="amount" class="form-control" type="number" v-model="loan.amount" required>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="form-label mt-md-4">Tenure (months)</label>
                        <div class="input-group">
                            <input id="tenure" name="tenure" class="form-control" type="number" v-model="loan.tenure" required>
                        </div>
                    </div>
                </div>

                <fieldset class="mt-4 p-3">
                    <legend>Guarantors</legend>
                    <div class="d-flex justify-content-end">
                        <button class="btn bg-gradient-primary btn-sm" @click.stop.prevent="addGuarantor">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div>
                        <div class="row" v-for="(guarantor, index) in guarantors" :key="index">
                            <div class="col-4">
                                <label class="form-label">Guarantor</label>
                                <div class="input-group">
                                    <select name="guarantor" class="form-control" v-model="guarantor.user" required>
                                        <option value="">Select Guarantor</option>
                                        <option v-for="user in users" :value="user.mainone_id">{{ user.firstname }} {{user.lastname }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Amount</label>
                                <div class="input-group">
                                    <input id="amount" name="amount" class="form-control" type="number" v-model="guarantor.amount" min="2000" required>
                                </div>
                            </div>
                            <div class="col-auto btn-container">
                                <span :class="`badge font-italic ${guarantor.status}`">{{ guarantor.status }}</span>
                            </div>
                            <div class="col-auto btn-container">
                                <button class="btn bg-gradient-danger btn-sm" @click.stop.prevent="removeGuarantor(index)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    props: [
        'users',
        'initialGuarantors'
    ],
    data() {
        return {
            loan: {
                amount: 0,
                tenure: ''
            },
            guarantors: []
        }
    },
    methods: {
        addGuarantor() {
            this.guarantors.push({
                    id: 0,
                    user: '',
                    amount: 0,
                    status: 'pending'
                }
            );
        },

        removeGuarantor(index){
            console.log(index);
        },

        onSubmit() {

        },

        onGuarantorRemoved(event) {
            console.log(event);
        }
    }
}

</script>

<style scoped>
    .btn-container {
        margin-top: 35px;
    }

    .pending{
        background: var(--bs-secondary);
    }

    .approved{
        background: var(--bs-teal);
    }

    .rejected {
        background: var(--bs-danger);
    }

</style>
