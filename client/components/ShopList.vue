<template>
    <div>
        <b-dropdown
            id="dropdown-1"
            left
            :text="currentShop"
            class="m-md-2"
            :disabled="loading"
        >
            <b-dropdown-item @click="handleClick(null)">
                All Shops
            </b-dropdown-item>
            <b-dropdown-item
                v-for="shop in shops"
                :key="shop.id"
                @click="handleClick(shop)"
            >
                {{ shop.name }}
            </b-dropdown-item>
        </b-dropdown>
    </div>
</template>

<script>
export default {
    name: "shop-list",
    data() {
        return {
            loading: true,
        };
    },
    computed: {
        defaultText() {
            return this.loading ? "Loading Shops" : "All Shops";
        },
        shops() {
            return this.$store.getters.isSuperAdmin
                ? this.$store.state.shops
                : this.$store.getters.loginUserShops;
        },
        currentShop() {
            let { currentShop } = this.$store.state;

            if (this.loading) {
                return this.defaultText;
            }

            return currentShop ? currentShop.name : this.defaultText;
        },
    },
    mounted() {
        this.pullShops();
    },
    methods: {
        handleClick(shop) {
            this.$store.dispatch("changeCurrentShop", shop);
        },
        pullShops() {
            if (this.$store.getters.isSuperAdmin) {
                this.$store.dispatch("fetchShops").then(() => {
                    this.loading = false;
                });
            } else {
                this.loading = false;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
</style>