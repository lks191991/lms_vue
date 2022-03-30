<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Site Setting</h3>

                <div class="card-tools">
                  
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Site Settiing</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>

                      <td class="text-capitalize">All Setting</td>
                      <td>

                        <a href="javascript:;" @click="editModal()">
                            <i class="fa fa-edit blue"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
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
                    <h5 class="modal-title" v-show="!editmode">Create New </h5>
                    <h5 class="modal-title" v-show="editmode">Update </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateTag() : ''">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Contact Email</label>
                            <input v-model="form.contact_email" type="text" name="contact_email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('contact_email') }">
                            <has-error :form="form" field="contact_email"></has-error>
                        </div>
                         <div class="form-group">
                            <label>Admin Email</label>
                            <input v-model="form.admin_email" type="text" name="admin_email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('admin_email') }">
                            <has-error :form="form" field="admin_email"></has-error>
                        </div>
                         <div class="form-group">
                            <label>Contac Number</label>
                            <input v-model="form.contact_number" type="text" name="contact_number"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('contact_number') }">
                            <has-error :form="form" field="contact_number"></has-error>
                        </div>
                         <div class="form-group">
                            <label>Contact Page Address</label>
                            <input v-model="form.contact_page_address" type="text" name="contact_page_address"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('contact_page_address') }">
                            <has-error :form="form" field="contact_page_address"></has-error>
                        </div>
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
</template>

<script>
    export default {
     
        data () {
            return {
                editmode: false,
                setting : {},
                form: new Form({
                    contact_email: '',
                    admin_email: '',
                    contact_number: '',
                    contact_page_address: '',
                })
            }
        },
        methods: {

            updateTag(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.post('/api/settings')
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadTags();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                axios.get("/api/settings").then(({ data }) => {
                    this.setting = data.data;
                    this.form.fill(this.setting);
                    });
                
            }


        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {

            this.$Progress.start();
            this.$Progress.finish();
        }
    }
</script>
