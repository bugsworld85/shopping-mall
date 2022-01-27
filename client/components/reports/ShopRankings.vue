<template>
    <div>
        <h3>Rankings</h3>
        <ul class="list-group" v-if="loading">
            <li
                class="list-group-item p-2"
                v-for="i in Array.from(Array(5).keys())"
                :key="`list-loader${i}`"
            >
                <div class="text-line" role="status" style="width: 100%"></div>
            </li>
        </ul>
        <ul class="list-group" v-else>
            <li
                class="list-group-item"
                v-for="shop in data"
                :key="`shop-rank-${shop.id}`"
            >
                <div class="row">
                    <div class="col-md-6 text-right">
                        {{ shop.name }}
                    </div>
                    <div class="col-md-6">
                        <div class="progress">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                :style="`width: ${calculatePercentageOfTotal(
                                    shop.visits
                                )}%`"
                                :aria-valuenow="
                                    calculatePercentageOfTotal(shop.visits)
                                "
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                {{ shop.visits }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "shop-rankings",
    props: ["data", "loading"],
    methods: {
        calculatePercentageOfTotal(visits) {
            let highest = this.data[0].visits;

            return Math.floor((visits / highest) * 100);
        },
    },
};
</script>

<style lang="scss" scoped>
</style>