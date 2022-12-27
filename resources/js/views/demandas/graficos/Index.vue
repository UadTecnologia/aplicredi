<template>
    <div>
        <b-row>
            <b-col>
                <Form :action="renderGrafico" />
            </b-col>
        </b-row>
        <br />
        <b-row>
            <b-col v-if="grafico.option">
                <Grafico :grafico="grafico" />
            </b-col>
        </b-row>
    </div>
</template>

<script>
import Form from "./components/Form.vue";
import Grafico from "./components/Grafico.vue";

export default {
    name: "grafico-demandas",
    data() {
        return {
            grafico: {},
        };
    },
    components: {
        Form,
        Grafico,
    },
    methods: {
        async renderGrafico(request) {
            try {
                this.grafico = {};
                const { data } = await this.$http.post(
                    "/api/demandas/graficos/render",
                    {
                        dataIni: request.dataIni,
                        dataFim: request.dataFim,
                        assuntoIds: request.assuntoId,
                        usuarioIds: [request.usuarioId],
                        tipoGrafico: request.tipoGrafico,
                    }
                );
                this.grafico = data;
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
