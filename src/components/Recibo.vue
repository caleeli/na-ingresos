<template>
  <panel :name="'RECIBO #' + recibo.numero" icon="fas fa-book-reader" class="panel-success">
    <div class="row">
      <div class="col">
        <select class="col form-control" v-model="recibo.tipo">
          <option value="ingreso">Ingreso</option>
          <option value="egreso">Egreso</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Fecha</label>
          <datetime type="date" v-model="recibo.fecha"></datetime>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label>Monto</label>
          <div class="input-group">
            <input
              v-model="recibo.monto"
              type="number"
              class="form-control"
              aria-label="Monto en Bs."
            />
            <div class="input-group-append">
              <span class="input-group-text">Bs</span>
            </div>
          </div>
          <small class="form-text text-muted">{{literal}}</small>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>{{tipo==='egreso' ? 'Entregué a' : 'Recibí de'}}</label>
          <input
            v-model="recibo.persona"
            name="persona"
            placeholder="nombre"
            type="text"
            class="form-control"
          />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Detalle</label>
          <textarea v-model="recibo.detalle" class="form-control"></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Teléfono</label>
          <div class="input-group">
            <input
              v-model="recibo.telefono"
              type="number"
              class="form-control"
              aria-label="telefono con whatsapp"
            />
            <div class="input-group-append">
              <span class="input-group-text text-success">
                <i class="fab fa-whatsapp-square"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label>Usuario que lo registra</label>
          <select-box v-model="recibo.usuario_id" :data="usuarios" filter-by="attributes.name">
            <template slot-scope="{row}">{{row.attributes.name}}</template>
          </select-box>
        </div>
      </div>
    </div>
    <button type="button" class="btn btn-primary" @click="completeTask({recibo})">Registrar</button>
  </panel>
</template>

<script>
import { SpanishConvertor as Conversor } from "spanish-numbers";

export default {
  path: "/na/recibo",
  mixins: [window.workflowMixin, window.ResourceMixin],
  data() {
    return {
      apiIndex: {
        'recibo.numero': {$api:"recibos", $call:'siguiente'},
      },
      recibo: this.processData('recibo', {
        numero: "",
        tipo: "ingreso",
        fecha: moment().format('YYYY-MM-DD'),
        monto: "",
        persona: "",
        detalle: "",
        telefono: "",
        usuario_id: window.userId
      }),
      usuarios: this.$api.users.array()
    };
  },
  computed: {
    literal() {
      try {
        return Conversor.convert(this.monto);
      } catch (e) {
        return "";
      }
    }
  }
};
</script>
