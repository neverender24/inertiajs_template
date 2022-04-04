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
            <table class="table table-hover">
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
                            <div class="dropdown dropstart" v-if="user.can.edit">
                              <button class="btn btn-secondary btn-sm action-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                  <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                                </svg>
                              </button>
                              <ul class="dropdown-menu action-dropdown" aria-labelledby="dropdownMenuButton1">
                                <li><Link class="dropdown-item" :href="`/users/${user.id}/edit`">Edit</Link></li>
                                <li><hr class="dropdown-divider action-divider"></li>
                                <li><Link class="text-danger dropdown-item" @click="deleteUser(user.id)">Delete</Link></li>
                              </ul>
                            </div>
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
            confirm: false,
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
            let text = "WARNING!\nAre you sure you want to delete the record?";
              if (confirm(text) == true) {
                this.$inertia.delete("/users/" + id);
              }
        }
    },
};
</script>

