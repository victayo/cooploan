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
                            <input id="loan_amount" name="amount" class="form-control" type="number" v-model="loan.loan_amount" required>
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
                                    <select name="guarantor" class="form-control" v-model="guarantor.guarantor_id" required>
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

                <div class="d-flex justify-content-end mt-4">
                    <a class="btn bg-gradient-danger m-0 ms-2" href="/loans">Cancel</a>
                    <button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        users: {
            type: Array,
            required: true
        },
        initialLoan: {
            type: Object,
            required: false,
            default: {
                id: 0,
                amount: 0,
                tenure: 12,
                status: 'pending'
            }
        },
        initialGuarantors: {
            type: Array,
            required: false,
            default: []
        }
    },

    data() {
        return {
            loan: _.cloneDeep(this.initialLoan),
            guarantors: _.cloneDeep(this.initialGuarantors),
            removeGuarantors: []
        }
    },

    methods: {
        addGuarantor() {
            this.guarantors.push({
                    id: 0,
                    guarantor_id: '',
                    amount: 0,
                    status: 'pending'
                }
            );
        },

        removeGuarantor(index){
            let guarantor = this.guarantors[index];
            if(guarantor.id){
                if(window.confirm('Are you sure you want to remove this Guarantor?')){
                    this.removeGuarantors.push(guarantor.id);
                }
            }
            this.guarantors.splice(index, 1);
        },

        onSubmit() {
            axios.post('/api/loans', {
                guarantors: this.guarantors,
                loan: this.loan,
                remove: this.removeGuarantors
            }).then((response) => {
                let data = response.data;
                console.log(data);
            }).catch((err) => {
                console.log(err);
            })
        },
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
