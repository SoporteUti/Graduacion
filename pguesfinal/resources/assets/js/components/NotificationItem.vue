<template>
 <li>
   <a  href="#" v-on:click="readNotification(unread.id)">
    <div class="col-lg-8 col-sm-8 col-8">
        <strong>{{ threadUrl }}</strong>
      <div v-if="typeNotification(unread.type) == 0">
        <p>Hay una solicitud de aprobación de tema para el grupo: <strong>{{ unread.data.grupo_codigo }}</strong></p>
      </div>
      <div v-if=" typeNotification(unread.type) == 1">
        
        <p>El grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha solicitado prorroga </p>
      </div>
      <div v-if=" typeNotification(unread.type) == 2">
       
        <p>El grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha solicitado una ratificacion de resultados </p>
      </div>
      <div v-if=" typeNotification(unread.type) == 3">
        
        <p>El grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha solicitado una ratificacion de tribunal </p>
      </div>
      <div v-if=" typeNotification(unread.type) == 4">
        
        <p>Se ha solicitado una reprobacion por abandono en el grupo: <strong>{{ unread.data.grupo_codigo }}</strong></p>
      </div>
      <div v-if=" typeNotification(unread.type) == 5">
        <p>El estudiante <strong>{{ unread.data.alumno_nombre }}</strong> integrante del grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha acumulado un total de <strong>{{ unread.data.num_inasistencias }}</strong> inasistencias</p>
      </div>
      <div v-if=" typeNotification(unread.type) == 6">
        <p><div v-if='unread.data.type==3'>Estimado estudiante </div><div v-else>El estudiante </div><strong>{{ unread.data.alumno_nombre }}</strong> integrante del grupo: <strong>{{ unread.data.grupo_codigo }}</strong> su calidad de egresado esta proxima a finalizar</p>
      </div>
      <div v-if=" typeNotification(unread.type) == 7">
        <p>La defensa de la etapa <strong>{{ unread.data.etapa }}</strong> del grupo: <strong>{{ unread.data.grupo_codigo }}</strong> se realizara la fecha<strong> {{ unread.data.fecha }} </strong></p>
      </div>
      <div v-if=" typeNotification(unread.type) == 8">
        <p><div v-if='unread.data.type==3'>Estimado estudiante </div><div v-else>El estudiante </div><strong>{{ unread.data.alumno_nombre }}</strong> integrante del grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha acumulado un total de <strong>{{ unread.data.num_inasistencias }}</strong> inasistencias</p>
      </div>
      <div v-if=" typeNotification(unread.type) == 9">
        <p> <div v-if='unread.data.type==3'>Estimado estudiante integrante del</div><div v-else>El</div>  grupo: <strong>{{ unread.data.grupo_codigo }}</strong> el periodo <strong>{{ unread.data.periodo }}</strong> para realizar la tesis: <strong>{{ unread.data.tema }}</strong> culminara dentro de un mes</p>
      </div>
      <div v-if=" typeNotification(unread.type) == 10">
        <p> El grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha solicitado cambio de tema de trabajo de graduacion</p>
      </div>
       <div v-if=" typeNotification(unread.type) == 11">
        <p> El grupo: <strong>{{ unread.data.grupo_codigo }}</strong> ha solicitado prorroga a Junta Directiva</p>
      </div>
      <!-- <small class="text-warning"><timeago :datetime="unread.data.created_at.date" :auto-update="60"></timeago></small> -->
    </div>    
  </a>
</li>
</template>

<script>

import axios from 'axios';
export default {
  props:['unread'],
  data(){
    return {
      threadUrl:""
    }
  },
  methods: {
    typeNotification: function(notificationType) {
      if (notificationType == "sispg\\Notifications\\SolicitudAprobacionTema") {
        this.threadUrl='Aprobacion de tema';
        return 0
      }else
      if (notificationType == "sispg\\Notifications\\SolicitudIrorrogaInterna") {
        this.threadUrl='Prorroga Interna';
        return 1
      }else
      if (notificationType == "sispg\\Notifications\\SolicitudRatificacionResultados"){
        this.threadUrl='Ratificacion de Resultados';
        return 2;
      }else
      if (notificationType == "sispg\\Notifications\\SolicitudRatificacionTribunal"){
        this.threadUrl='Ratificacion de Tribunal';
        return 3;
      }else
      if (notificationType == "sispg\\Notifications\\SolicitudReprobacionAbandono"){
        this.threadUrl='Reprobacion por Abandono';
        return 4;
      }else
      if (notificationType == "sispg\\Notifications\\NotificacionInasistencia"){
        this.threadUrl='Reprobacion por Inasistencia';
        return 5;
      }else
      if (notificationType == "sispg\\Notifications\\NotificacionCalidadEgresadoPorCaducar") {
        this.threadUrl='Calidad Egresado Por Caducar';
        return 6;
      } else if (notificationType == "sispg\\Notifications\\NotificacionDefensa") {
        this.threadUrl='Proxima Defensa';
        return 7;
      }else if (notificationType == "sispg\\Notifications\\NotificacionReprobacionDefinitiva") {
        this.threadUrl='Reprobacion Definitiva';
        return 8;
      }else if (notificationType == "sispg\\Notifications\\NotificacionVencimientoPeriodoTesis") {
          this.threadUrl='Vencimiento del Periodo de Tesis';
          return 9;
        }else if (notificationType == "sispg\\Notifications\\SolicitudCambioTema") {
          this.threadUrl='Cambio de tema';
          return 9;
        }else if (notificationType == "sispg\\Notifications\\SolicitudPJD") {
          this.threadUrl='Prorroga Junta Directiva';
          return 10;
        }
    },
    readNotification: function (notification_id) {
      axios.get('/users/notifications/read/'+notification_id).then(({ data }) => {
        window.location = data.data.url_location;
      });
    }
  },
  mounted(){
    
  }

}
</script>
