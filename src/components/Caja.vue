<template>
  <panel name="Caja" icon="fas fa-book-reader" class="panel-success">
    <table class="table table-sm">
      <thead>
        <tr>
          <th scope="col">Fecha</th>
          <th scope="col">Detalle</th>
          <th scope="col">Ingreso</th>
          <th scope="col">Egreso</th>
          <th scope="col">Saldo</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(row,index) in ultimos" :key="index">
          <td>{{row.attributes.fecha}}</td>
          <td>{{row.attributes.detalle}}</td>
          <td>{{row.attributes.tipo==='ingreso' ? row.attributes.ingreso : ''}}</td>
          <td>{{row.attributes.tipo==='egreso' ? row.attributes.egreso : ''}}</td>
          <td>{{row.attributes.ingreso_acumulado - row.attributes.egreso_acumulado}}</td>
        </tr>
      </tbody>
      <tfoot v-if="registros.length>0">
        <tr>
          <td colspan="2"></td>
          <td>{{registros[0].attributes.ingreso_acumulado}}</td>
          <td>{{registros[0].attributes.egreso_acumulado}}</td>
          <td>{{registros[0].attributes.ingreso_acumulado - registros[0].attributes.egreso_acumulado}}</td>
        </tr>
      </tfoot>
    </table>
    <button type="button" class="btn btn-primary" @click="({recibo})">Registrar</button>
  </panel>
</template>

<script>
import { SpanishConvertor as Conversor } from "spanish-numbers";

export default {
  path: "/na/caja",
  mixins: [window.workflowMixin, window.ResourceMixin],
  data() {
    return {
      registros: this.$api.recibos.array({sort:'-id'}),
    };
  },
  computed: {
    literal() {
      return Conversor.convert(this.monto);
    },
    ultimos() {
      return this.registros.slice().reverse();
    }
  }
};
</script>
