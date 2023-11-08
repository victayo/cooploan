<template>
    <div class="row my-3">
        <div class="text-center col-12" v-if="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Calculating Schedule...</span>
            </div>
        </div>
        <div v-else>
            <div class="col-12 table-responsive" v-if="schedules.length">
                <table class="table table-sm small">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Beginning Balance (Principal)</th>
                            <th scope="col">Interest</th>
                            <th scope="col">Principal</th>
                            <th scope="col">Ending Balance (Principal)</th>
                            <th scope="col">Total Monthly Repayment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="(schedule, index) in schedules" :key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ schedule.repayment_date }}</td>
                            <td>{{ schedule.beginning_balance }}</td>
                            <td>{{ schedule.interest }}</td>
                            <td>{{ schedule.principal }}</td>
                            <td>{{ schedule.end_balance }}</td>
                            <td>{{ schedule.monthly_repayment }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        schedules: {
            type: Array,
            required: true,
            default: []
        },
        loading: {
            type: Boolean,
            default: false
        }
    }
}
</script>
