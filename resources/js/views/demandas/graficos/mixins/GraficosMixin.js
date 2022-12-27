export default {
    data() {
        return {
            form: {},
            setores: [],
            usuarios: [],
            assuntos: [],
            assuntosSelected: [],
            graficos: [],
			grafico: {}
        };
    },
    methods: {
        getDadosSetor() {
            this.getAssuntos();
            this.getUsuarios();
        },
        async getAssuntos() {
            try {
                const { data } = await this.$http.post(
                    "/api/demandas/assuntos",
                    {
                        setor_id: this.form.setorId,
                    }
                );
                this.assuntos = data;
            } catch (error) {
                console.log(error);
            }
        },
        async getUsuarios() {
            try {
                const { data } = await this.$http.post(
                    "/api/demandas/usuarios",
                    {
                        setor_id: this.form.setorId,
                    }
                );
                this.usuarios = data;
            } catch (error) {
                console.log(error);
            }
        },
        async getSetores() {
            try {
                const { data } = await this.$http.post("/api/demandas/setores");
                this.setores = data;
            } catch (error) {
                console.log(error);
            }
        },
        async getGraficos() {
            try {
                const { data } = await this.$http.post("/api/demandas/graficos");
                this.graficos = data;
            } catch (error) {
                console.log(error);
            }
        },
		setGrafico() {
			if (this.form.tipoGrafico)  {
				this.grafico = this.graficos.find(g => g.type == this.form.tipoGrafico)
			}
		},
		inputValid(inputName) {
			if (!this.grafico.filters) return false;

			const filter = this.grafico.filters.find(filter => filter.name == inputName);

			return filter ? true : false;
		}
    },
};
