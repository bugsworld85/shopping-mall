<template>
    <div>
        <NavHeader />
        <div class="container-fluid">
            <div class="row">
                <Sidebar />
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <slot></slot>
                </main>
            </div>
        </div>

        <footer></footer>
    </div>
</template>

<script>
import NavHeader from "~/components/NavHeader";
import Sidebar from "~/components/Sidebar";

import "vue2-daterange-picker/dist/vue2-daterange-picker.css";

export default {
    name: "dashboard-layout",
    components: {
        NavHeader,
        Sidebar,
    },
    mounted() {
        this.$api.setHeader(
            "Authorization",
            `Bearer ${this.$auth.$storage.getLocalStorage("token")}`
        );

        this.$store.dispatch("fetchRoles");
        this.$store.dispatch(
            "setLoginUser",
            this.$auth.$storage.getLocalStorage("loginUser")
        );
    },
};
</script>

<style lang="scss" scoped>
</style>