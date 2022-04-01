<template>
    <div class="row gap-20 masonry pos-r">
        <div class="peers fxw-nw jc-sb ai-c">
            <h3>{{ pageTitle }}</h3>
            <Link href="/" @click="back">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
            </Link>
        </div>
        <div class="col-md-8">
            <form @submit.prevent="submit()">
                
            </form>
        </div>
    </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    data() { 
        return { 
            form: useForm({
                old: "",
                new: "",
                confirm: "",
            }),
            pageTitle: "Settings"
        };
    },
    methods: {
        back() {
            window.history.back();
        },
        submit() {
             this.form.post("/users/update-password", this.form);
        }
    }
}
</script>
