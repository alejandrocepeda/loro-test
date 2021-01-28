<template>
    <div class="pb-0 alert alert-danger w-100 position-relative" role="alert" v-if="errors.length > 0">
            <button style="color:#fff; right:0; top: 0" @click="close()" type="button" class="btn position-absolute" aria-label="close">
                <span class="mdi-28px mdi mdi-close"></span>
            </button> 

        <b>Por favor, corrija {{ errors.length > 1 ? 'los siguientes errors' : 'el siguiente error' }} </b>                        

        <ul>
        <li :key="`error_${i}`" v-for="(error,i) in errors">{{ error }}</li>
        </ul>                        
        
    </div>
</template>

<script>
export default {
  name: 'Alert',
  data(){
      return {
        //    
      }
  },
  props:{
    errors:{
        type:Array,
        default: () => {
          return []
        }
    }
  },
  methods: {
    close(){
      this.errors = []
    }
  },
}
</script>
