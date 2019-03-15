<template>
    <v-layout mt-5>
    <v-flex xs12 sm6 offset-sm3>
      <v-card>
        <v-img
          src="https://cdn.vuetifyjs.com/images/cards/desert.jpg"
          aspect-ratio="2.75"
        ></v-img>
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">Kangaroo Valley Safari</h3>
            <div> {{ card_text }} </div>
          </div>
        </v-card-title>
        <v-card-actions ml-5>
          <button style="margin-left:15px;">
          <i class="nav-icon fas fa-thumbs-up" color="blue" style="font-size:25px; color:blue;"></i>
          </button>
        </v-card-actions>
        <v-card-actions>
          <v-btn flat color="orange" @click="newModal">Reserve</v-btn>
          <v-btn flat color="primary">View Profile</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>
                       <form @submit.prevent="editmode ? updateAccount() : createAccount()">
                        <div class="modal-body">
                            <select name="petname" class="form-control">
                                <option>------------Select Petname ---------------</option>
                                <option v-for="pet in pets" :key="pet.id" :value="pet.id">{{pet.petname}}</option>
                            </select><br>
                            <input type="text" name="petbreed" class="form-control" placeholder="Enter pet breed"><br>
                            <input type="number" name="age" class="form-control" placeholder="Enter pet age"><br>
                            <select name="petgender" class="form-control">
                                <option>Select Gender </option>
                                <option value="Male"> Male </option>
                                <option value="Female"> Female </option>
                            </select>
                            <br>
                            <div class="checkbox">
                                <label><input type="checkbox" value="Vaccination">&nbsp;&nbsp;Vaccination</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" value="Haircut">&nbsp;&nbsp;Haircut</label>
                            </div>
                        </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                     </div>
                     </form>
                </div>
            </div>
            </div>
  </v-layout>


</template>
<script>
  export default {
    data () {

      return {
        card_text: 'Lorem ipsum dolor sit amet, brute iriure accusata ne mea. Eos suavitate referrentur ad, te duo agam libris qualisque, utroque quaestio accommodare no qui. Et percipit laboramus usu, no invidunt verterem nominati mel. Dolorem ancillae an mei, ut putant invenire splendide mel, ea nec propriae adipisci. Ignota salutandi accusamus in sed, et per malis fuisset, qui id ludus appareat.',
        pets: {},
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
    mounted(){
        if(this.$gate.isUser()){
            axios.get('api/getPets').then(({data})=> (this.pets = data));
        }
    },
    methods : {
        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        
    }
  };
</script>