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
            <!-- <Select
                v-model="form.municipal_id" 
                :collection="municipals"
                label="name"
                :form="form"
            /> -->
            <v-select 
            v-model="form.municipal_id" 
            :options="municipals"
            :reduce="municipals => municipals.value"
            label="name"
            :resetOnOptionsChange="true"
            @option:selected="loadBarangays"
            >
            </v-select>
            <div class="fs-6 c-red-500" v-if="form.errors.municipal_id">{{ form.errors.municipal_id }}</div>

            <label for="">Barangay</label>
            <!-- <Select
                v-model="form.barangay_id" 
                :collection="barangays"
                :form="form"
                @callMethod="loadBarangays"
                :propName="'barangay_id'"
            /> -->
            <v-select 
            v-model="form.barangay_id" 
            :options="barangays"
            :reduce="barangays => barangays.value"
            label="name"
            :resetOnOptionsChange="true"
            @option:selected="loadPurok"
            >
            </v-select>
            <div class="fs-6 c-red-500" v-if="form.errors.barangay_id">{{ form.errors.barangay_id }}</div>

            <label for="">Purok</label>
            <v-select 
                v-model="form.purok_id" 
                :options="puroks"
                label="name"
                :reduce="puroks => puroks.value"
                :resetOnOptionsChange="true"
            ></v-select>
            
            <div class="fs-6 c-red-500" v-if="form.errors.purok_id">{{ form.errors.purok_id }}</div>

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
                purok_id:"",
                email: "",
                password: "",
                id: null
            }),
            municipals:[],
            barangays:[],
            puroks:[],
            testValue:"",
            pageTitle: "",
            loading:false,
        };
    },
    mounted() {

        if (this.editData !== undefined) {
            this.loading = true
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

        loadBarangays() {
            
            axios.post('/barangays', {municipal_id:this.form.municipal_id}).then((response) => {
                this.barangays = response.data
                this.puroks = []
            })

        },

        loadPurok() {
            this.puroks = [
                {value:"1", name:"test1"},
                {value:"2", name:"test2"},
                {value:"3", name:"test3"},
            ]
        }

    },
};
</script>