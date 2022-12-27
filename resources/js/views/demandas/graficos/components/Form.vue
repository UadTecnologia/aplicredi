<template>
    <b-form class="form" @submit.stop.prevent="onSubmit">
        <b-row>
            <b-col md="3">
                <b-form-group
                    id="graficos"
                    label-for="graficos"
                    label="Gráfico"
                >
                    <b-form-select
                        class="form-control"
                        id="graficos"
                        v-model="$v.form.tipoGrafico.$model"
                        :state="validateState('tipoGrafico')"
                        @change="setGrafico()"
                    >
                        <b-form-select-option
                            v-for="g in graficos"
                            :key="g.type"
                            :value="g.type"
                        >
                            {{ g.title }}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>
            </b-col>
            <b-col md="2" v-if="inputValid('dataIni')">
                <b-form-group
                    id="dataIni"
                    label-for="dataIni"
                    label="Data de Início"
                >
                    <b-form-datepicker
                        id="dataIni"
                        :date-format-options="{
                            year: 'numeric',
                            month: 'numeric',
                            day: 'numeric',
                        }"
                        placeholder=" "
                        locale="pt-br"
                        v-model="$v.form.dataIni.$model"
                        :state="validateState('dataIni')"
                    >
                    </b-form-datepicker>
                </b-form-group>
            </b-col>
            <b-col md="2" v-if="inputValid('dataFim')">
                <b-form-group
                    id="dataFim"
                    label-for="dataFim"
                    label="Data Final"
                >
                    <b-form-datepicker
                        id="dataFim"
                        :date-format-options="{
                            year: 'numeric',
                            month: 'numeric',
                            day: 'numeric',
                        }"
                        placeholder=" "
                        locale="pt-br"
                        v-model="$v.form.dataFim.$model"
                        :state="validateState('dataFim')"
                    >
                    </b-form-datepicker>
                </b-form-group>
            </b-col>
            <b-col md="2" v-if="inputValid('setorId')">
                <b-form-group id="setor" label-for="setor" label="Setor">
                    <b-form-select
                        class="form-control"
                        id="setor"
                        v-model="$v.form.setorId.$model"
                        :state="validateState('setorId')"
                        @change="getDadosSetor()"
                    >
                        <b-form-select-option
                            v-for="s in setores"
                            :key="'setor_' + s.id"
                            :value="s.id"
                        >
                            {{ s.descricao }}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>
            </b-col>
            <b-col md="3" v-if="inputValid('usuarioId')">
                <b-form-group
                    id="usuarios"
                    label-for="usuarios"
                    label="Usuário"
                >
                    <b-form-select
                        class="form-control"
                        id="usuarios"
                        v-model="$v.form.usuarioId.$model"
                        :state="validateState('usuarioId')"
                    >
                        <b-form-select-option
                            :key="'usuarios_' + 0"
                            :value="0"
                        >
                            --- TODOS OS USUÁRIOS ---
                        </b-form-select-option>
                        <b-form-select-option
                            v-for="u in usuarios"
                            :key="'usuarios_' + u.id"
                            :value="u.id"
                        >
                            {{ u.nome }}
                        </b-form-select-option>
                    </b-form-select>
                </b-form-group>
            </b-col>
            <b-col
                md="12"
                v-if="inputValid('assuntoId') && assuntos.length > 0"
            >
                <label class="typo__label"
                    >Assunto
                    <small style="font-weight: 400!important">(opcional)</small></label
                >
                <multiselect
                    v-model="assuntosSelected"
                    label="nome"
                    placeholder="Assuntos"
                    :options="assuntos"
                    :searchable="false"
                    :close-on-select="false"
                    :show-labels="false"
                    :multiple="true"
                >
                </multiselect>
            </b-col>
        </b-row>
        <b-row v-if="form.tipoGrafico != null">
            <b-col>
                <b-button type="submit" ref="submit" variant="success"
                    >Consultar</b-button
                >
            </b-col>
        </b-row>
    </b-form>
</template>

<script>
import { validationMixin } from "vuelidate";
import FormData, { FormDataRequired } from "./FormData";
import Multiselect from "vue-multiselect";
import GraficosMixin from "../mixins/GraficosMixin";

export default {
    name: "demandas-graficos-form",
    components: { Multiselect },
    props: {
        action: {
            type: Function,
        },
    },
    mixins: [validationMixin, GraficosMixin],
    validations: {
        form: FormDataRequired,
    },
    methods: {
        validateState(name) {
            const { $dirty, $error } = this.$v.form[name];
            return $dirty ? !$error : null;
        },
        async onSubmit() {
            const submitButton = this.$refs["submit"];
            try {
                this.$v.form.$touch();

                submitButton.classList.add(
                    "spinner",
                    "spinner-light",
                    "spinner-right"
                );

                this.form.assuntoId = [];

                this.assuntosSelected.map((e) => {
                    this.form.assuntoId.push(e.id);
                });

                this.action(this.form);
            } catch (e) {
                console.log(e);
            }
        },
    },
    mounted() {
        this.getSetores();
        this.getGraficos();
        this.form = new FormData({});
    },
};
</script>
