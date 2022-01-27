<template>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#" @click.prevent>
            TheShoppingMall
        </a>
        <div class="w-100 text-left">
            <ShopList />
        </div>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="#" @click.prevent="handleSignOut">
                    Sign out
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
import ShopList from "~/components/ShopList";

export default {
    name: "nav-header",
    components: {
        ShopList,
    },
    methods: {
        handleSignOut() {
            this.$auth.logout();
        },
    },
};
</script>

<style lang="scss" scoped>
</style>