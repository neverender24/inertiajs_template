<template>

<div class="row gap-20 masonry pos-r">
    <div class="peers fxw-nw jc-sb ai-c">
        <h3>{{ pageTitle }} users</h3>
        <Link href="/users">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </Link>
    </div>
    <div class="col-md-8">
        <form @submit.prevent="submit()">
            <label for="">Names</label>
            <input type="text" v-model="form.name" class="form-control" autocomplete="chrome-off">
            <div class="fs-6 c-red-500" v-if="form.errors.name">{{ form.errors.name }}</div>
            <label for="">Municipality</label>
            <Select
                v-model="form.municipal_id" 
                :collection="municipals"
            />
            <div class="fs-6 c-red-500" v-if="form.errors.municipality">{{ form.errors.municipality }}</div>
            <label for="">Barangay</label>
            <Select
                v-model="form.barangay_id" 
                :collection="barangays"
            />
            <div class="fs-6 c-red-500" v-if="form.errors.municipality">{{ form.errors.municipality }}</div>
            <label for="">Email</label>
            <input type="text" v-model="form.email" class="form-control" autocomplete="chrome-off">
            <label for="">Password</label>
            <input type="password" v-model="form.password" class="form-control" autocomplete="chrome-off">
            <input type="hidden" v-model="form.id" class="form-control" autocomplete="chrome-off">
            <button type="button" class="btn btn-primary mt-3" @click="submit()" :disabled="form.processing">Save changes</button>
        </form>
    </div>
</div>

</template>
<script>
import { useForm } from "@inertiajs/inertia-vue3";



export default {
    props: {
        editData: Object,
    },
    data() {
        return {
            form: useForm({
                name: "",
                municipal_id:"",
                barangay_id:"",
                email: "",
                password: "",
                id: null
            }),
            municipals:[],
            barangays:[],
            pageTitle: ""
        };
    },
    mounted() {

        if (this.editData !== undefined) {
            this.pageTitle = "Edit"
            this.form.name = this.editData.name
            this.form.email = this.editData.email
            this.form.id = this.editData.id
            this.form.municipal_id = this.editData.municipal_id
            this.form.barangay_id = this.editData.barangay_id
        } else {
            this.pageTitle = "Create"
        }

        this.loadMunicipals()
    },
    watch:{
        'form.municipal_id': function(value) {
            this.loadBarangays(value)
        }
    },

    methods: {
        submit() {
            
            if (this.editData !== undefined) {
                this.form.patch("/users/" + this.form.id, this.form);
            } else {
                this.form.post("/users", this.form);
            }

        },

        loadMunicipals() {
            axios.post('/municipals').then((response) => {
                this.municipals = response.data
            })
        },

        loadBarangays(municipal_id) {
            axios.post('/barangays',{municipal_id:municipal_id}).then((response) => {
                this.barangays = response.data
            })
        }

    },
};
</script>