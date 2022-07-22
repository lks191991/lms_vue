<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Pages List</h3>

                <div class="card-tools">
                  
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="tag in tags.data" :key="tag.id">

                      <td class="text-capitalize">{{tag.title}}</td>
                      <td>{{tag.page_content | stripHTML}}</td>
                      <td>

                        <a href="javascript:;" @click="editModal(tag)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="tags" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New Page</h5>
                    <h5 class="modal-title" v-show="editmode">Update Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateTag() : createTag()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input v-model="form.title" type="text" name="title"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Content</label>
                            
                                    <editor v-model="form.page_content" apiKey="5lycs76uved97db9ag1b1bok1ebcqlgbz0gd701zg1nrrd2e"
                                    referrerpolicy="origin"
                                    :init="{
                                    height: 350,
                                    menubar: false,
                                    plugins: [
                                    'advlist autolink lists link image charmap',
                                    'searchreplace visualblocks code fullscreen',
                                    'print preview anchor insertdatetime media',
                                    'paste code help wordcount table'
                                    ],
                                    toolbar:
                                    'undo redo | formatselect | bold italic | \
                                    alignleft aligncenter alignright | \
                                    bullist numlist outdent indent | help'
                                    }"
                                    >
                                    </editor>
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
    export default {
     
        data () {
            return {
                editmode: false,
                tags : {},
                form: new Form({
                    id : '',
                    title: '',
                    page_content: '',
                })
            }
        },
        methods: {

            getResults(page = 1) {

                  this.$Progress.start();
                  
                  axios.get('/api/page?page=' + page).then(({ data }) => (this.tags = data.data));

                  this.$Progress.finish();
            },
            updateTag(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('/api/page/'+this.form.id)
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
            editModal(tag){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(tag);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadTags(){
                if(this.$gate.isAdmin()){
                    axios.get("/api/page").then(({ data }) => (this.tags = data.data));
                }
            },
            
            createTag(){

                this.form.post('/api/page')
                .then((response)=>{
                    $('#addNew').modal('hide');

                    Toast.fire({
                            icon: 'success',
                            title: response.data.message
                    });

                    this.$Progress.finish();
                    this.loadTags();

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
            console.log('Component mounted.')
        },
        created() {

            this.$Progress.start();
            this.loadTags();
            this.$Progress.finish();
        },
        computed: {
  	strippedHtml() {
        let regex = /(<([^>]+)>)/ig;
        
	return this.form.page_content.rendered.replace(regex, "");
    }
}
    }
</script>
