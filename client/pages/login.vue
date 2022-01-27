<template>
    <Guest>
        <div class="container-sm">
            <LoginForm />
        </div>
    </Guest>
</template>

<script>
import Guest from "~/layouts/Guest";
import LoginForm from "~/components/forms/LoginForm";

export default {
    auth: "guest",
    components: {
        Guest,
        LoginForm,
    },
};
</script>

<style lang="scss" scoped>
</style>