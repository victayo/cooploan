<template>
    <div>
        <div>
            <div class="table-responsive">
                <table id="users-table" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employee ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Created Date</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        users: {
            type: Array,
            required: true,
            default: []
        },
    },
    data() {
        return {
            usersTable: null,
            usersList: _.cloneDeep(this.users),
            usersTablelist: []
        }
    },
    mounted() {
        this.usersList = this.usersList.map((user) => {
            user.fullname = `${user.firstname} ${user.lastname}`;
            user.created_at = moment(user.created_at).format('LLL');
            return user;
        });

        this.usersTable = new DataTable('#users-table', {
            data: this.usersList,
            info: false,
            columns: [
                {
                    data: 'mainone_id',
                    title: 'Employee ID'
                },
                {
                    data: 'fullname',
                    title: 'Name',
                },
                { data: 'email', title: 'Email'},
                {
                    data: 'status', title: 'Status', render: (data, type, row) => {
                        let label = '';
                        switch(data){
                            case 'active':
                                label = 'badge-success';
                                break;
                            case 'inactive':
                            case 'declined':
                                label = 'badge-danger';
                                break;
                            case 'pending':
                                label = 'badge-info';
                                break;
                            default:
                                label = 'badge-dark';
                        }
                        return `<span class="text-sm font-weight-bold text-capitalize mb-0 font-italic badge-sm ${label}">${data}</span>`;
                    }
                },
                { data: 'created_at', title: 'Created Date' },
                {
                    data: null,
                    title: 'Action',
                    searchable: false,
                    orderable: false,
                    render: (data, type, row) => {
                        let content = `<div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                    <p class="text-sm font-weight-bold mb-0">
                                        <a class="btn bg-gradient-primary btn-sm m-0 ms-2" href="/users/${row.mainone_id}">
                                            <i class="fa fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" title="View User"
                                                aria-hidden="true" data-bs-original-title="View User" aria-label="View User"></i>
                                        </a>
                                    </p>
                                    <p class="text-sm font-weight-bold mb-0 ps-2">
                                        <button class="btn bg-gradient-danger btn-sm m-0 ms-2" onclick="changeText(this)">
                                            <i class="fa fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate user"
                                                aria-hidden="true" data-bs-original-title="Deactivate user"
                                                aria-label="Deactivate user"></i>
                                        </button>
                                    </p>
                                </div>`;
                        return content;
                    }
                }
            ]
        });
    },
    methods: {
        handleButtonClick(cell) {
            console.log(cell);
        }
    }
}
</script>

<style scoped>
</style>
