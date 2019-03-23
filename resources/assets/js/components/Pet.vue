  <template>
    <div class="container">
          <div class="row mt-5" v-if="$gate.isUser()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Pets</h3>
                        <div class="card-tools">
                            <button class="btn btn-success"  @click="newModal">Add Pet <i class="fas fa-money-check fa-fw"></i></button>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                      <th> Image </th>
                        <th>Petname</th>
                        <th>Created At </th>
                        <th>Modify</th>
                  </tr>
                 <tr v-for="pet in pets.data" :key="pets.id">
                    <td> <img :src="'/'+pet.image" width="150px"> </td>
                    <td>{{pet.petname}}</td>
                    <td>{{pet.created_at | myDate}} </td>
                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>

                </tr>


                  
                </tbody></table>
              </div>


        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>
                       <form @submit.prevent="createPet()">
                        <div class="modal-body">
                            <input type="file" class="form-control" name="image"  @change="getImage" accept="image/*;capture=camera"><br>
                             <img :src="form.image" alt="User Avatar" width="200" height="200">
                            <input type="text" class="form-control" :class="{'is-invalid': form.errors.has('petname') }" placeholder="Enter petname" v-model="form.petname" name="petname" >
                            <has-error :form="form" field="petname"></has-error>
                        </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button  type="submit" class="btn btn-success">Update</button> -->
                        <button  type="submit" class="btn btn-primary">Create</button>
                     </div>
                     </form>
                </div>
            </div>
            
            </div>
    </div>
</template>
<script>
  export default {
    data(){
      return{
        pets:{},
        form: new Form({
                id:'',
                petname : '',
                image:'',
              
            })
        }
    },
    mounted(){
        if(this.$gate.isUser()){
            this.loadPets();
            this.createdPet();
        }
    },
    methods:{
      newModal(){
            this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
      },
      createPet(){
        this.form.post('api/pets')
                .then((response)=>{
                    this.$Progress.start();
                    Fire.$emit('createdPet');
                     $('#addNew').modal('hide')
                        toast({
                            type: 'success',
                            title: 'Pet added into account successfully'
                        })
                     this.$Progress.finish();
                });
      },
    /*   getProfilePhoto(){

                let image = (this.form.image.length > 200) ? this.form.image : "img/profile/"+ this.form.image ;
                return image;
            },*/
      getImage(e){
          let file = e.target.files[0];
          let reader = new FileReader();

          let limit = 1024*1024*2;
          if(file['size']>limit){
            swal({
              type: 'error',
              title:'Oopss..',
              text:'You are uploading a large file',
            })
            return false;
          }
          reader.onloadend = file => {
            this.form.image=reader.result;
          }
          reader.readAsDataURL(file);
      },
      loadPets(){
        axios.get('api/pets').then(({data}) => this.pets = data);
      },
      createdPet(){
        this.loadPets();
        Fire.$on('createdPet',()=>{
            this.loadPets();
        })
      }

    
  }
};
</script>