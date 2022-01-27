<template>
    <div class="container" v-if="$store.state.currentShop">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h2>Shop Visits Report</h2>
                <br />
                <h3>
                    Total Shop Visits:
                    <div class="text-line" role="status" v-if="loading"></div>
                    <strong class="text-success" v-else>{{ total }}</strong>
                </h3>
                <div>
                    <label>Select date range:</label>
                    <div class="text-line" role="status" v-if="loading"></div>
                    <DateRangePicker
                        v-else
                        ref="picker"
                        opens="left"
                        :locale-data="{
                            firstDay: 1,
                            format: 'dd-mm-yyyy',
                        }"
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <LineChart :data="data" />
            </div>
        </div>
    </div>
    <div v-else>
        Please select a shop. Report for all your shops is not ready yet.
    </div>
</template>

<script>
import LineChart from "~/components/charts/Line";
import DateRangePicker from "vue2-daterange-picker";

export default {
    name: "owner-shop-visit-report",
    components: {
        LineChart,
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
            return {};
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
            let { currentShop } = this.$store.getters;

            if (currentShop) {
                let shop_id = currentShop.id;
                console.log(currentShop);
                await this.$api
                    .get(`/api/user/shop/${shop_id}/visits`, {
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
            } else {
                // this.loading = false;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
</style>