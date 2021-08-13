<template>
 <!-- Notifications: style can be found in dropdown.less -->
 <li class="dropdown notifications-menu" style="padding-top: 7px;">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 7px; color: white;">
    <i class="fa fa-bell-o" ></i>
    <span class="label label-warning">{{unreadNotifications.length}}</span>
  </a>
  <ul class="dropdown-menu" style="width: auto;position:absolute;transform: inherit!important;">
    <li class="header">Tienes {{unreadNotifications.length}} notificaciones</li>
    <li>
      <!-- inner menu: contains the actual data -->
      <ul class="menu">
        <notification-item  v-if="unreadNotifications.length > 0" v-for="unread in unreadNotifications" :unread="unread" :key="unread.id"></notification-item>
        <div  v-if="unreadNotifications.length == 0" ><p>No hay Notificaciones</p></div>
      </ul>
    </li>
    <!-- <li class="footer"><a href="#">Ver todo</a></li> -->
  </ul>
</li>
</template>

<style>
  
</style>

<script>

import NotificationItem from './NotificationItem.vue'
import axios from 'axios';
export default {
    props: ['userid'],
    components: {NotificationItem},
    data(){
        return {
            unreadNotifications: []
        }
    },
    methods: {
        markNotificationAsRead() {
            if (this.unreadNotifications.length) {
                //axios.get('/markAsRead');
                console.log('th');
            }
        },
        loadData:function () {
            axios.get('/users/notifications').then(({ data }) => {
                this.unreadNotifications = data;
                //console.log(data)
            });
        }
    },
    mounted() {
        this.loadData();
        setInterval(function () {
          this.loadData();
        }.bind(this), 30000); 
        console.log('Component mounted.');
        },

    }

        </script>
