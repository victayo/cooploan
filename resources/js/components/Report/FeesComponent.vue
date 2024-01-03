<template>
    <div class="card">
        <div class="card-header">
            <h5 v-if="type == 'membership'">Joining Fees</h5>
            <h5 v-else>Loan Processing Fees</h5>
        </div>
        <div class="card-body col-12">
            <div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto my-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <div>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <label :for="'year_'+type" class="col-form-label">Year</label>
                                        </div>
                                        <div class="col-auto w-50">
                                            <select class="form-select" :id="'year_'+type" @change="onYearChange($event)" v-model="year" :disabled="fetching">
                                                <option v-for="y in years" :value="y" :key="y"> {{ y }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center "
                                    data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                    <i class="ni ni-cloud-download-95"></i>
                                    <span class="ms-2">Download</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive" v-if="!fetching">
                <table class="table align-items-center">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Month</th>
                            <th class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">No of Employees</th>
                            <th class="text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(membershipFee, index) in membershipFees" :key="index">
                            <td>{{ membershipFee.month }}</td>
                            <td class="text-center">{{ membershipFee.employees }}</td>
                            <td class="text-center">{{ membershipFee.amount }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bolder">
                            <td>Total</td>
                            <td class="text-center">{{ totalEmployees }}</td>
                            <td class="text-center">{{ totalAmount }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-center m-5" v-else>
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    props: {
        type: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            membershipFees: [],
            year: moment().format('YYYY'),
            years: [],
            totalAmount: 0,
            totalEmployees: 0,
            fetching: false
        }
    },
    created() {
        this.fetchFeesReport();
    },

    mounted() {
        let startYear = 2010;
        while(startYear <= this.year){
            this.years.push(startYear);
            startYear++;
        }
    },

    methods: {
        fetchFeesReport() {
            //init membership fee data
            this.fetching = true;
            let type = this.type == 'membership' ? 'membershipfee' : 'processingfee';
            let startDate = `${this.year}-01-01`;
            let endDate = `${this.year}-12-31`;
            axios.get(`/api/fees/${type}?start_date=${startDate}&end_date=${endDate}`)
                .then((response) => {
                    this.membershipFees = response.data.report;
                    this.membershipFees.forEach(membershipFee => {
                        this.totalAmount += membershipFee.amount;
                        this.totalEmployees += membershipFee.amount;
                    });
                }).catch(err => {
                    console.log('error', err);
                }).finally(() => {
                    this.fetching = false;
                })
        },

        onYearChange(event){
            this.fetchFeesReport();
        }
    }
}
</script>
