<template>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Welcome to TheShoppingMall Portal!</h1>
            <h2 class="text-center">
                Open a shop with us and monitor your visits,<br />soon sales. :D
            </h2>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        Login now and see your sales dropping! <br />You know I
                        am kidding, right? ...right?
                    </p>
                </div>
                <form @submit.prevent="handleFormSubmit" class="col-md-6">
                    <p>
                        <label for="">Email Address</label>
                        <input
                            type="email"
                            autocomplete="false"
                            class="form-control"
                            v-model="email"
                        />
                    </p>
                    <p>
                        <label for="">Password</label>
                        <input
                            type="password"
                            autocomplete="false"
                            class="form-control"
                            v-model="password"
                        />
                    </p>
                    <p class="text-danger" v-if="error !== null">{{ error }}</p>
                    <p>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            disabled
                            v-if="submitting"
                        >
                            Login
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary text-center"
                            v-else
                        >
                            Login
                        </button>
                        or <nuxt-link to="/register">Register</nuxt-link>
                    </p>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "login-form",
    data() {
        return {
            submitting: false,
            email: null,
            password: null,
            error: null,
        };
    },
    methods: {
        async handleFormSubmit() {
            this.error = null;
            this.submitting = true;

            await this.$auth
                .loginWith("laravelSanctum", {
                    data: {
                        email: this.email,
                        password: this.password,
                    },
                })
                .then((response) => {
                    this.$auth.$storage.setLocalStorage(
                        "token",
                        response.data.token
                    );
                    this.$auth.$storage.setLocalStorage(
                        "loginUser",
                        response.data.user
                    );
                })
                .catch(({ response }) => {
                    this.submitting = false;
                    if (response) {
                        this.error = response.data.message;
                    }
                });
        },
    },
};
</script>

<style lang="scss" scoped>
</style>