<template>
    <Dashboard>
        <TitleArea title="Dashboard" />

        <AllShopsVisitReport v-if="$store.getters.isSuperAdmin" />

        <OwnerShopVisitReport v-if="$store.getters.isStoreOwner" />
    </Dashboard>
</template>

<script>
import Dashboard from "~/layouts/Dashboard";
import TitleArea from "~/components/TitleArea";
import AllShopsVisitReport from "~/components/reports/AllShopsVisitReport";
import OwnerShopVisitReport from "~/components/reports/OwnerShopVisitReport";

export default {
    auth: true,
    components: {
        Dashboard,
        TitleArea,
        AllShopsVisitReport,
        OwnerShopVisitReport,
    },
};
</script>

<style lang="scss" scoped>
</style>