<template>
    <div>
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-end">
                <div class="btn-group" v-if="loan.id">
                    <button class="btn btn-info" @click="doEdit()" v-if="isView()">Edit</button>
                    <button class="btn btn-primary" @click="doView()" v-else>View</button>
                </div>
            </div>
            <div class="card-body pt-0">
                <form @submit.prevent="onSubmit" :disabled="action != 'view'">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <label class="form-label mt-md-4" for="loan_amount">Loan Amount</label>
                            <div class="input-group">
                                <input id="loan_amount" name="amount" class="form-control" type="number" :disabled="isView()"
                                    v-model="loan.loan_amount" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="form-label mt-md-4" for="tenure">Tenure (months)</label>
                            <div class="input-group">
                                <select id="tenure" name="tenure" class="form-control" v-model="loan.tenure" :disabled="isView()" required>
                                    <option value="">Select Tenure</option>
                                    <option v-for="tenure in tenures" :value="tenure.tenure">{{ tenure.tenure }} ({{
                                        tenure.interest }}%)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <fieldset class="mt-4 p-3">
                        <legend>Guarantors</legend>
                        <div class="d-flex justify-content-end" v-if="!isView()">
                            <button class="btn bg-gradient-primary btn-sm" @click.stop.prevent="addGuarantor">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div>
                            <div class="row" v-for="(guarantor, index) in guarantors" :key="index">
                                <div class="col-4">
                                    <label class="form-label" :for="'guarantor-' + index">Guarantor</label>
                                    <div class="input-group">
                                        <select :id="'guarantor-' + index" :name="'guarantor-' + index" class="form-control guarantorSelect"
                                            v-model="guarantor.guarantor_id" required
                                            :disabled="guarantor.status && guarantor.status != 'pending'">
                                            <option value="">Select Guarantor</option>
                                            <option v-for="user in users" :value="user.mainone_id">{{ user.firstname }}
                                                {{ user.lastname }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="form-label" :for="'amount-' + index">Amount</label>
                                    <div class="input-group">
                                        <input :id="'amount-' + index" class="form-control" type="number"
                                            v-model="guarantor.amount" min="2000" required
                                            :readonly="guarantor.status && guarantor.status != 'pending'">
                                    </div>
                                </div>
                                <div class="col-auto btn-container">
                                    <span :class="`badge font-italic ${guarantor.status}`">{{ guarantor.status }}</span>
                                </div>
                                <div class="col-auto btn-container"
                                    v-if="guarantor.status && (guarantor.status == 'pending') && action != 'view'">
                                    <button class="btn bg-gradient-danger btn-sm"
                                        @click.stop.prevent="removeGuarantor(index)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <strong>Total Guarantor Sum: </strong> {{ totalGuarantorAmount().toLocaleString('en-US')
                                    }}
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div>
                        <payment-schedule :schedules="schedules" :loading="fetchingSchedule" :monthlyPayment="monthlyPayment" :totalInterest="totalInterest" :loanApprovalStatus="loan.approval_status"></payment-schedule>
                    </div>

                    <div class="row" v-if="isReadyForApproval() || loan.approval_status == 'approved'">
                        <div class="col-4">
                            <label class="form-label" for="effective_date">Loan Effective Date</label>
                            <div class="input-group">
                                <input id="effective_date" class="form-control" type="date" v-model="loanEffectiveDate" required :readonly="loan.status == 'active'">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4" v-if="action != 'view'">
                        <div>
                            <button class="btn btn-small btn-behance" @click.stop.prevent="getSchedules"
                                :disabled="!loan.loan_amount || !loan.tenure">Preview Repayment Schedule</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm bg-gradient-danger ms-2" href="/loans" :disabled="saving">Cancel</a>
                            <button type="submit" class="btn btn-sm bg-gradient-primary ms-2" :disabled="saving">Save</button>
                        </div>
                    </div>

                </form>
                <div class="d-flex justify-content-end" v-if="isReadyForApproval() && (loan.approval_status != 'approved' && loan.approval_status != 'rejected')">
                    <button @click.stop.prevent="rejectLoan" class="btn btn-sm bg-gradient-danger ms-2">Reject</button>
                    <button @click.stop.prevent="approveLoan" class="btn btn-sm bg-gradient-primary ms-2">Approve</button>
                </div>
            </div>
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
        tenures: {
            type: Array,
            required: true
        },
        initialLoan: {
            type: Object,
            required: false,
            default: {
                id: 0,
                amount: 0,
                tenure: '',
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
            action: 'view',
            removeGuarantors: [],
            schedules: {
                schedule: [],
                monthly_repayment: 0,
                total_interest: 0
            },
            interest: 10,
            totalInterest: 0,
            monthlyPayment: 0,
            loanEffectiveDate: this.initialLoan.effective_date ? this.initialLoan.effective_date : moment().format('YYYY-MM-DD'),
            fetchingSchedule: false,
            saving: false
        }
    },

    mounted() {
        if (this.action == 'view') {
            this.getSchedules();
        }
    },

    methods: {
        addGuarantor() {
            this.guarantors.push({
                id: 0,
                guarantor_id: '',
                amount: 0,
                status: 'pending'
            });
        },

        removeGuarantor(index) {
            let guarantor = this.guarantors[index];
            if (guarantor.id) {
                this.$swal.fire({
                    text: 'Are you sure you want to remove this Guarantor?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then(response => {
                    if(response.isConfirmed){
                        this.removeGuarantors.push(guarantor.id);
                        this.guarantors.splice(index, 1);
                    }
                });
            }else{
                this.guarantors.splice(index, 1);
            }
        },

        isView(){
            return this.action == 'view' && this.loan.status == 'pending';
        },

        doEdit(){
            this.action = 'edit';
        },

        doView(){
            this.action = 'view';
        },

        onSubmit() {
            this.saving = true;
            axios.post('/api/loans', {
                guarantors: this.guarantors,
                loan: this.loan,
                remove: this.removeGuarantors
            }).then((response) => {
                let data = response.data;
                if(data.success){
                    this.$swal.fire({
                        toast: true,
                        position: 'top-end',
                        text: `Loan successfully created`,
                        showConfirmButton: false,
                        icon: 'success',
                        timer: 3000,
                        timerProgressBar: true,
                        didClose: () => {
                            window.location = '/loans';
                        }
                    });
                    this.loan = data.loan;
                    this.guarantors = data.loan_guarantors;
                }else{

                }
            }).catch((err) => {
                console.log(err);
            }).finally(() => {
                this.saving = false;
            })
        },

        getSchedules() {
            if (this.loan.loan_amount && this.interest && this.loan.tenure) {
                this.fetchingSchedule = true;
                let url = '/api/loans/schedule';
                if(this.loan.id){
                    url += `/${this.loan.id}`;
                }
                axios.post(url, {
                    principal: this.loan.loan_amount,
                    interest: this.interest,
                    tenure: this.loan.tenure
                }).then(response => {
                    let data = response.data;
                    if (data.status == 'success') {
                        this.schedules = data.schedule.schedule;
                        this.monthlyPayment = +data.schedule.monthly_payment;
                        this.totalInterest = +data.schedule.total_interest;
                    }
                }).catch(err => {
                    console.error(err);
                }).finally(() => {
                    this.fetchingSchedule = false
                })
            }
        },

        isReadyForApproval() {
            if (!this.guarantors.length) { //there must be a guarantor for the loan
                return false;
            }

            for (let i in this.guarantors) { //no approval must be pending or rejected
                if (this.guarantors[i].status == 'pending' || this.guarantors[i].status == 'rejected') {
                    return false;
                }
            }

            let totalGuarantorAmount = this.totalGuarantorAmount();
            if (totalGuarantorAmount <= (0.5 * this.loan.loan_amount)) { //the total guarantor amount must be at least 50% of the loan amount
                return false;
            }

            return true;
        },

        totalGuarantorAmount() {
            let sum = 0;
            this.guarantors.forEach(guarantor => {
                if(guarantor.status == 'pending' || guarantor.status == 'approved'){// only calculate total for pending and approved guarantee
                    sum += (+guarantor.amount);
                }
            });
            return sum;
        },

        approveLoan() {
            axios.post(`/api/loans/approve/${this.loan.id}`, {
                effective_date: this.loanEffectiveDate
            }).then(response => {
                let data = response.data;
                this.loan = data.loan;
                this.schedules = data.schedule.schedule;
                this.monthlyPayment = +data.schedule.monthly_payment;
                this.totalInterest = +data.schedule.total_interest;
            }).catch(err => {
                    console.error(err);
            });
        },


        rejectLoan() {
            axios.post(`/api/loans/reject/${this.loan.id}`).then(response => {
                let data = response.data;
                this.loan = data.loan;
            }).catch(err => {
                    console.error(err);
            });
        }

    }
}

</script>

<style scoped>
.btn-container {
    margin-top: 35px;
}

.pending {
    background: var(--bs-secondary);
}

.approved {
    background: var(--bs-teal);
}

.rejected {
    background: var(--bs-danger);
}</style>
