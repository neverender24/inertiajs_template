<template>
    <Head>
        <title>Users</title>
    </Head>
        
    <div class="row gap-10 masonry pos-r">
        <div class="peers fxw-nw jc-sb ai-c">
            <h3>Users</h3>
            <div class="peers">
                <div class="peer mR-10">
                    <input v-model="search" type="text" class="form-control form-control-sm" placeholder="Search...">
                </div>
                <div class="peer">
                    <Link class="btn btn-primary btn-sm" href="/users/create">Add User</Link>
                </div>
            </div>
        </div>
        <div class="bgc-white p-20 bd">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users.data" :key="index">
                        <td>{{ user.name }}</td>
                        <td>
                            <Link v-if="user.can.edit" :href="`/users/${user.id}/edit`">Edit</Link>
                            <Link class="mL-4 c-red-500" v-if="user.can.edit" @click="deleteUser(user.id)">Delete</Link>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <pagination :links="users.links" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "@/Shared/Pagination";

export default {
    components: { Pagination },
    props: {
        users: Object,
        filters: Object,
        can: Object,
    },
    data() {
        return {
            search: this.$props.filters.search,
            modal: false,
        };
    },
    watch: {
        search: _.debounce(function (value) {
            this.$inertia.get(
                "/users",
                { search: value },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 300),
    },
    methods: {
        deleteUser(id) {
            this.$inertia.delete("/users/" + id);
        }
    },
};
</script>