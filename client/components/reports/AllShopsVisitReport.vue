<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h2>Shop Visits Report</h2>
                <br />
                <div>
                    <label>Select date range:</label>
                    <div class="text-line" role="status" v-if="loading"></div>
                    <DateRangePicker
                        v-else
                        ref="picker"
                        opens="left"
                        :singleDatePicker="false"
                        :showDropdowns="true"
                        v-model="dateRange"
                        @update="handleApplyRange"
                    >
                        <!-- <template
                            v-slot:input="picker"
                            style="min-width: 350px"
                        >
                            {{ $moment }} -
                            {{ picker.endDate }}
                        </template> -->
                    </DateRangePicker>
                </div>
                <h3>
                    Total Mall Visits:
                    <div class="text-line" role="status" v-if="loading"></div>
                    <strong class="text-success" v-else>{{ total }}</strong>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <ShopRankings :data="report" :loading="loading" />
            </div>
            <div class="col-md-6">
                <PieChart :data="data" v-if="!loading" />
            </div>
        </div>
    </div>
</template>

<script>
import PieChart from "~/components/charts/Pie.js";
import ShopRankings from "~/components/reports/ShopRankings";
import DateRangePicker from "vue2-daterange-picker";

export default {
    name: "all-shops-visit-report",
    components: {
        PieChart,
        ShopRankings,
        DateRangePicker,
    },
    data() {
        return {
            loading: true,
            report: null,
            total: 0,
            dateRange: null,
        };
    },
    computed: {
        data() {
            if (this.loading) return {};

            let names = this.report
                .map((shop) => {
                    return shop.name;
                })
                .slice(0, 5);
            let vists = this.report
                .map((shop) => {
                    return shop.visits;
                })
                .slice(0, 5);

            return {
                labels: names,
                datasets: [
                    {
                        label: "Top 5 Shops",
                        data: vists,
                        backgroundColor: [
                            "#7FFFD4",
                            "#9400D3",
                            "rgb(255, 99, 132)",
                            "rgb(54, 162, 235)",
                            "rgb(255, 205, 86)",
                        ],
                        hoverOffset: 4,
                    },
                ],
            };
        },
    },
    mounted() {
        this.pullReport();
    },
    methods: {
        handleApplyRange(dateRange) {
            this.pullReport({
                start: this.$moment(dateRange.startDate).format("MM-DD-YYYY"),
                end: this.$moment(dateRange.endDate).format("MM-DD-YYYY"),
            });
        },
        async pullReport(params = {}) {
            this.loading = true;

            await this.$api
                .get("/api/shops/visits", {
                    params,
                })
                .then((response) => {
                    this.loading = false;
                    this.report = response.data.data;
                    this.total = response.data.meta.total;
                    if (!this.dateRange) {
                        this.dateRange = {
                            startDate: this.$moment(
                                response.data.meta.date_range.start
                            ),
                            endDate: this.$moment(
                                response.data.meta.date_range.end
                            ),
                        };
                    }
                });
        },
    },
};
</script>

<style lang="scss" scoped>
</style>