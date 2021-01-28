

<template>
  <div class="hello">

    <div class="row">
        <div class="col">            
            <router-link class="btn btn-danger text-white" :to="{name:'register'}">
              <b-icon-arrow-left></b-icon-arrow-left>
                  Regresar al registro
              </router-link>
            <button @click="winner()" class="ml-3 btn btn-primary text-white">Elegir Ganador</button>

            
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <h1 class="text-center">Clientes Registrados {{ customers.length }}</h1>
        </div>
    </div>

    <div class="row">

      <div class="col">
      

        <table class="table table-sm table-condensed nowrap mt-2" cellspacing="0" width="100%">  
          <thead class="thead-light">
                        
              <th>Nombre</th>          
              <th>Cédula</th>          
              <th>Departamento</th>          
              <th>Ciudad</th>          
              <th>Celular</th>          
              <th>Correo Electronico</th>          
              <th>Ganador</th>          
              <th>Habeas data</th>          
              <th>Acciones</th>          
            
          </thead>

          <tbody>
                  <tr :key="`customer_${index}`" v-for="(customer,index) in customers">
                    <td>{{ customer.first_name }} {{ customer.last_name }}</td>
                    <td>{{ customer.identification }}</td>
                    <td>{{ customer.state.name }}</td>
                    <td>{{ customer.city.name }}</td>
                    <td>{{ customer.phone }}</td>
                    <td>{{ customer.mail }}</td>
                    <td>{{ (customer.winner ? '⭐':'') }}</td>
                    <td>{{ (customer.habeas_data ? 'Autorizado': 'No Autorizado') }}</td>
                    <td>

                      <button @click.prevent="remove(customer)" class="btn btn-danger btn-sm" type="button">
                        Borrar
                      </button>
                    </td>
                  </tr>
              </tbody>

        </table>
      </div>
    </div>
    
  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import { BIconArrowLeft } from 'bootstrap-vue'

Vue.component('BIconArrowLeft', BIconArrowLeft)

export default {
  name: 'Home',
  data(){
    return {
        customers:[]
    }
  },
  created(){
    this.getCustomers()
  },
  methods:{
      remove(customer){

          this.$swal({
            title: "Seguro que quiere eliminar este cliente ?",            
            type: 'question',
            customClass: 'bg-body',                
            showCancelButton: true,          
            confirmButtonClass: 'btn btn-success font-weight-light',                
            confirmButtonColor: '#53D190',     
            cancelButtonColor: '#F65F6E',
            confirmButtonText: ('Borrar el registro')         
          })
          .then(async(response) => {
              if (response.value){
                await axios.delete(`/customers/${customer.id}`)  

                this.getCustomers()
              }
          })
          
      },
      async winner(){


          try {
            const response = await axios.post('/customers-random-winner')

            const winner = response.data

            this.$swal({
              title: "Listo",
              html: `Ganador ${winner.first_name} ${winner.last_name} <br> ${winner.mail}`,
              type: 'question',
              customClass: 'bg-body',      
              showCancelButton: true,          
              confirmButtonClass: 'btn btn-success font-weight-light',                
              confirmButtonColor: '#53D190',     
              cancelButtonColor: '#F65F6E',
              confirmButtonText: ('Aceptar y enviar notificación')                 
            })
            .then((response) => {

              if (response.value){
                this.getCustomers()
                axios.post('/customer-send-notification')
              }
            })
            
          } catch (error) {            

            this.$swal({
              title: "Error",
              text: error.response.data.error,
              type: 'error',
              customClass: 'bg-body',                
              confirmButtonClass: 'btn btn-success font-weight-light',                
              confirmButtonColor: '#53D190',        
            })
          }
      },
      async getCustomers(){
          const response = await axios.get('/customers')

          this.customers = response.data
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
