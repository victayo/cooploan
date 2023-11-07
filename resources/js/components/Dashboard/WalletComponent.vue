<template>
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                    <div class="numbers">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Savings</p>
                        <h5 class="font-weight-bolder">
                            ₦{{ walletBalance }}
                        </h5>
                        <!-- <p class="mb-0">
                            <span class="text-success text-sm font-weight-bolder">+55%</span>
                            since yesterday
                        </p> -->
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user'],
    data(){
        return {
            walletBalance: this.user.wallet ? (+this.user.wallet.balance).toLocaleString('en-US') : '0.00'
        }
    }
}
</script>
