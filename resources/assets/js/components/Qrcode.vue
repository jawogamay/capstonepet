<template>
      <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">QR TABLE</h3>
                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add QR <i class="fas fa-money-check fa-fw"></i></button>
                         </div>
                     </div>
             <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>Pet</th>
                        <th>QR CODE</th>
                        <th> Reference Key </th>
                        <th>Created At </th>
                        <th> Action </th>
                        
                        
                  </tr>
                <!--  <tr v-for="post in posts.data" :key="posts.id">
                    <td>{{post.user.name}}</td>
                    <td>{{post.content}}</td>
                    <td>{{post.created_at | myDate}} </td>
                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>

                </tr> -->
                <tr v-for="qr in qrs.data" :key="qr.id">
                    <td> {{qr.reservation.petname}}</td>
                    <td>  <qrcode-vue :value="qr.reference" :size="size" level="H"></qrcode-vue> </td>
                    <td> {{qr.reference}} </td>
                    <td> {{qr.created_at}}</td>
                    <td><button class="btn btn-primary" data-toggle="modal" :data-id ="qr.id" @click = "modalOpen(qr.id)">Scan QR </button></td>
                   <!--  <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue> -->
                </tr>

                  
                </tbody></table>
              </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Post</h5>
                            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>   
                        </div>
                       <form @submit.prevent="createQr()">
                        <div class="modal-body">
                           <!--  <select class="form-control" name="transaction_id" v-model="form.transaction_id">
                                <option value="">---Select Account Name---</option>
                                <option  v-for="account in accounts" :key="account.id" :value="account.id">{{account.account_name}}</option>
                            </select>
                            <br>
                            <input type="text" class="form-control" placeholder="Enter Passenger Name" name="passenger_name" v-model="form.passenger_name"><br>   -->   
                        <!--     <input type="file" name="image" placeholder="Image" class="form-control"> <br>
                            <textarea class="form-control" placeholder="Whats on your mind ?" :class="{'is-invalid': form.errors.has('content') }" style="height:200px;" name="content" v-model="form.content">
                            </textarea>
                            <has-error :form="form" field="content"></has-error> -->
                            <select class="form-control" v-model="form.transaction" name="transaction">
                                <option value="" disabled selected>---Select Account Name---</option>
                                 <option  v-for="account in appointments.data" :key="account.id" :value="account.id">{{account.petname}}</option>
                            </select>
                        </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Post</button>
                     </div>
                     </form>
                </div>
            </div>
            
            </div>


      <div id="viewqr" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <qrcode-vue :value="qrs.reference" size="300" level="H" style="margin:0 auto; text-align:center;"></qrcode-vue>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

    </div>
</template>
<script>
import QrcodeVue from 'qrcode.vue';
    export default{
        data(){
            return{
                appointments:{},
                qrs:{},
                value: 'Try this at home',
                 size: 100,
                 form: new Form({
                    id: '',
                    reference: '',
                    transaction:''
                 })
            }
        },
        mounted(){
            this.loadAppointments();
            this.loadReservation();
        },
        components: {
             QrcodeVue
         },
        methods:{
             loadAppointments(){
                axios.get('api/getAppointments').then(({data})=> this.appointments = data)
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
                modalOpen(id){
                   $('#viewqr').modal('show');
                    console.log('#'+id)
                },
            createQr(){
                this.form.post('api/qr').then((response)=>{
                     this.$Progress.start();
                    Fire.$emit('createdPet');
                     $('#addNew').modal('hide')
                        toast({
                            type: 'success',
                            title: 'Qr added into account successfully'
                        })
                     this.$Progress.finish();
                })
            },
            loadReservation(){
                axios.get('api/loadReserve').then(({data}) => this.qrs = data)
            }
        }
    };
</script>