<template>
    <b-row v-if="grafico.option">
        <b-col>
            <div
                id="main"
                :style="
                    'width: ' +
                    grafico.width +
                    '; height: ' +
                    grafico.height +
                    ';'
                "
            ></div>
        </b-col>
    </b-row>
</template>

<script>
export default {
    name: "grafico-demandas",
    props: {
        grafico: {},
    },
    mounted() {
        if (this.grafico.option) {
            var myChart = echarts.init(document.getElementById("main"));
            myChart.setOption(this.grafico.option);
        }
    },
};
</script>
