<template>
    <div>
        <div class="row mb-4">
            <div class="col-5">
                <label class="form-label">Guarantor</label>
                <div class="input-group">
                    <select name="guarantor" class="form-control" v-model="guarantor_model.user" required>
                        <option value="">Select Guarantor</option>
                        <option v-for="user in users" :value="user.mainone_id">{{ user.firstname }} {{ user.lastname }}</option>
                    </select>
                </div>
            </div>
            <div class="col-5">
                <label class="form-label">Amount</label>
                <div class="input-group">
                    <input id="amount" name="amount" class="form-control" type="number" v-model="guarantor_model.amount" min="2000" required>
                </div>
            </div>
            <div class="col-2">
                <button class="btn bg-gradient-danger btn-sm m-0 ms-2" @click.stop.prevent="remove">X</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'users',
        'guarantor',
        'id'
    ],
    data(){
        return {
            guarantor_model: this.guarantor,

        }
    },
    methods: {
        remove(){
            this.$emit('onGuarantorRemoved', {
                id: this.id
            })
        }
    }
}
</script>
