import { required } from "vuelidate/lib/validators";

export default class FormData {
  dataIni = null;

  dataFim = null;

  assuntoId = [];

  usuarioId = null;

  encerradas = false;

  tipoGrafico = null;
  
  setorId = null;

  constructor({
    dataIni = null,
    dataFim = null,
    assuntoId = [],
    usuarioId = null,
    encerradas = false,
    tipoGrafico = null,
    setorId = null,
  }) {
    this.dataIni = dataIni;
    this.dataFim = dataFim;
    this.assuntoId = assuntoId;
    this.usuarioId = usuarioId;
    this.encerradas = encerradas;
    this.tipoGrafico = tipoGrafico;
    this.setorId = setorId;
  }
}

export const FormDataRequired = {
  dataIni: {
    required
  },
  dataFim: {
    required
  },
  usuarioId: {
    required
  },
  tipoGrafico: {
    required
  },
  setorId: {
    required
  },
};
