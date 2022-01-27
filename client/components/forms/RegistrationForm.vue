<template>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Welcome to TheShoppingMall Portal!</h1>
            <p class="text-center">
                Open a shop with us and monitor your visits, soon sales. :D
            </p>
            <div class="row">
                <form @submit.prevent="handleFormSubmit" class="col-md-6">
                    <p>
                        <label for="">First Name</label>
                        <input
                            type="email"
                            autocomplete="false"
                            class="form-control"
                        />
                    </p>
                </form>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "registration-form",
    methods: {
        handleFormSubmit() {},
    },
};
</script>

<style lang="scss" scoped>
</style>