<template>
    <div class="container">
          <div class="row mt-5" v-if="$gate.isUser()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="text-align:center;">Appointments</h3>
                        <div class="card-tools">
                          
                         </div>
                     </div>
                </div>
            </div>
        </div>


    </div>
</template>
<script>
  export default{
    data(){
      return{
        form: new Form({
                id:'',
                name : '',
                email: '',
                password: '',
                type: '',
                bio: '',
                photo: ''
            })
        }
    },

    methods:{
      newModal(){
            this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
      }
    }
  };
</script>