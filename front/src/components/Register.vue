<template>
  <div class="hello">

    <div class="row">
        <div class="col">            

            <router-link class="btn btn-success text-white" :to="{name:'customers'}">Ganador al azar</router-link>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <h1 class="text-center">Registro de Cliente</h1>
        </div>
    </div>

    <div class="row">

      <div class="col">

          <div class="row">
              <ErrorAlert  :errors="errors"></ErrorAlert>
          </div>

      
            <form class="form">
              <div class="form-group">                       
                    <label for="name">Nombre</label>                                        
                    <input v-model="customer.first_name" class="form-control" type="text">
              </div>

              <div class="form-group">                       
                    <label for="name">Apellido</label>                                        
                    <input v-model="customer.last_name" class="form-control" type="text">
              </div>

              <div class="form-group">                       
                    <label for="name">Cédula</label>                                        
                    <input v-model="customer.identification" class="form-control" type="text">
              </div>

              <div class="form-group">                       
                    <label for="name">Correo</label>                                        
                    <input v-model="customer.mail" class="form-control" type="text">
              </div>

              <div class="form-group">                       
                    <label for="name">Teléfono</label>                                        
                    <input v-model="customer.phone" class="form-control" type="text">
              </div>

              <div class="form-group">                       
                    <label for="name">Departamento</label>                                        
                    <select v-model="customer.state_id" class="form-control">
                        <option :value="state.id" :key="`state_${index}`" v-for="(state,index) in states">{{ state.name }}</option>
                    </select>
              </div>

              <div class="form-group">                       
                    <label for="name">Ciudad</label>                                        
                    <select v-model="customer.city_id" class="form-control">
                        <option :value="city.id" :key="`city_${index}`" v-for="(city,index) in cities">{{ city.name }}</option>
                    </select>
              </div>

            </form>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col text-center">

        <div class="form-group">     

          <p>
            <span class="font-weight-bold">
              Autorizo el tratamiento de mis datos de acuerdo con la finalidad establecida en la política de protección de datos personales
            </span>

            <b-form-checkbox class="mt-3" v-model="customer.habeas_data"  switch >
                <span class="font-weight-bold">
                  Haga click Aqui
                </span>
            </b-form-checkbox>
          </p>
        </div>
        

      </div>
    </div>

    <div class="row mt-5">
      <div class="col text-center">
          <button type="button" @click.prevent="register()" class="btn btn-success btn-lg">Registrar</button>
      </div>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios'
import ErrorAlert from '@/components/ErrorAlert'

export default {
  name: 'Register',  
  components:{
    ErrorAlert
  },
  data(){
    return {
      customer:{
        first_name:null,
        last_name:null,
        identification:null,
        state_id:null,
        city_id:null,
        phone:null,
        mail:null,
        habeas_data:false
      },
      states:[],
      cities:[],
      errors: [],
    }
  },
  created(){

    
    this.getStates()
    this.getCities()
  },
  methods:{
    checkForm(){
            
        this.errors = []
        
        if (!this.customer.first_name) {
            this.errors.push('El nombre es requerido.')
        }          
        
        if (!this.customer.last_name) {
            this.errors.push('El apellido es requerido.')
        }

        if (!this.customer.identification) {
            this.errors.push('La cédula es requerida.')
        }

        if (!this.customer.phone) {
            this.errors.push('El teléfono es requerido.')
        }
        
        if (!this.customer.mail) {
            this.errors.push('El correo es requerido.')
        }

        if (this.errors.length == 0) return true

        return false
    },
    async register(){

      if (!this.checkForm()) return
      
      const toCreate = {
        first_name:  this.customer.first_name,
        last_name:  this.customer.last_name,
        identification:  this.customer.identification,
        state_id:  this.customer.state_id,
        city_id:  this.customer.city_id,
        phone:  this.customer.phone,
        mail:  this.customer.mail,
        habeas_data:  this.customer.habeas_data,
      }

      try {
        await axios.post(`/customers`,toCreate)  

        this.$swal({
            title: "Listo",
            text: "Registro exitoso",
            type: 'success',
            customClass: 'bg-body',                
            confirmButtonClass: 'btn btn-success font-weight-light',                
            confirmButtonColor: '#53D190',                                    
        })  

        this.customer = {
          first_name:null,
          last_name:null,
          identification:null,
          state_id:null,
          city_id:null,
          phone:null,
          mail:null,
          habeas_data:false
        }

      } catch (error) {
        
        if (error.response.data.code == 422){

          const errors = Object.entries(error.response.data.error)

          this.errors = []

          errors.map((error) => {          
            this.errors.push(error[1][0])
          })

          
        }
        else{
            this.$swal({
              title: "Registro Falido",
              text: error.response.data.error,
              type: 'error',
              customClass: 'bg-body',                
              confirmButtonClass: 'btn btn-success font-weight-light',                
              confirmButtonColor: '#53D190',                                    
          })  
        }

        setTimeout(() => {
          this.errors = []
        },2500)
        
      }
      
    },
    async getStates(){
        const response = await axios.get('/states')
        this.states = response.data
    },
    async getCities(){
      const response = await axios.get('/cities')
        this.cities = response.data
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.form-group > label{
  font-weight: bold;
}

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
