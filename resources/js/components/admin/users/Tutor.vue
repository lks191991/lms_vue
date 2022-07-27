<template>
  <section class="content">
        <div  class="loader-out" v-if="loading"> <div  class="loader"  ></div>   </div>
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Tutor List</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Email Verified?</th>
                      <th>Status</th>
                      <th>Created</th>
                      <th>Action</th>
                    </tr>
                     <tr>
                      <th><input v-model="s_name" type="text" name="s_name" class="form-control" ></th>
                      <th><input v-model="s_email" type="text" name="s_email" class="form-control" ></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="user in users.data" :key="user.id">

                      <td class="text-capitalize">{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.contact}}</td>
                      <td :inner-html.prop="user.email_verified_at | yesno"></td>
                       <td :inner-html.prop="user.status | yesno"></td>
                      <td>{{user.created_at | myDate}}</td>

                      <td>

                        <a href="javascript:;" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="javascript:;" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>


        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New</h5>
                    <h5 class="modal-title" v-show="editmode">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" autocomplete="off">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input v-model="form.email" type="text" name="email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" autocomplete="off">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input v-model="form.contact" type="text" name="contact"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('contact') }" autocomplete="off">
                            <has-error :form="form" field="contact"></has-error>
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                             <Datepicker  v-model="form.dob"    value="form.dob"  :format="'yyyy-MM-dd'" input-class="form-control"  calendar-class="w-auto rounded" 
      wrapper-class="w-auto"  type="date" valueType="format" />
                            <has-error :form="form" field="dob"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="password" name="password"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" autocomplete="off">
                            <has-error :form="form" field="password"></has-error>

                            <input v-model="form.type" type="hidden" name="type" value="user" >
                        </div>
                    <div class="form-group">
                            <label>Status</label>
                            <toggle-button  :value="form.status"  :sync="true" v-model="form.status" :labels="{checked: 'Yes', unchecked: 'No'}"  />
							
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
import Datepicker from 'vuejs-datepicker'
    export default {
         components: {
    Datepicker
  },
        data () {
            return {
                editmode: false,
                loading: false,
                users : {},
                s_name:'',
                s_email:'',
                form: new Form({
                    id : '',
                    type : 'user',
                    name: '',
                    contact:'',
                    dob:'',
                    email: '',
                    password: '',
                    status: false,
                    email_verified_at: '',
                })
            }
        },
        methods: {
           getResults(page = 1) {
                this.loading = true;
                  this.$Progress.start();
                  
                  axios.get('/api/tutors?page=' + page,{ params: {s_name: this.s_name,s_email: this.s_email}}).then(({ data }) => (this.users = data.data));
                    this.loading = false;
                  this.$Progress.finish();
            },
            updateUser(){
                this.$Progress.start();
                this.loading = true;
                // console.log('Editing data');
                this.form.put('/api/user/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.loading = false;
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.getResults();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
               
               
                if(user.status==1)
				{
				user.status = true;
				}
				else
				{
				user.status = false;
				}
                 //console.log(this.form.status);
                  this.form.fill(user);
                  $('#addNew').modal('show');
               
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        // Send request to the server
                         if (result.value) {
                                this.form.delete('/api/user/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        );
                                    // Fire.$emit('AfterCreate');
                                    this.getResults();
                                }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                         }
                    })
            },
          
          createUser(){
                this.loading = true;
              this.form.post('/api/user')
              .then((response)=>{
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: response.data.message
                  });

                  this.$Progress.finish();
                  this.loading = false;
                  this.getResults();

              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          }

        },
        mounted() {
             this.getResults();
        }
        ,
         watch: {
        s_name(after, before) {
            this.getResults();
        },
            s_email(after, before) {
            this.getResults();
        }
    },
      
        created() {

            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        }
    }
</script>
