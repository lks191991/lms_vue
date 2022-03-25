<template>


  <section class="content">
  <div  class="loader-out" v-if="loading">
   <div  class="loader"  ></div>
   </div>
 
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card" v-if="$gate.isAdmin()">
              <div class="card-header">
                <h3 class="card-title">Topic List</h3>

                <div class="card-tools">
                  
                  <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                      <i class="fa fa-plus-square"></i>
                      Add New
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
			 
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
					  <th>Course</th>
                      <th>Description</th>
                      <th>Created</th>
					  <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="data in listData.data" :key="data.id">

                      <td class="text-capitalize">{{data.name}}</td>
					   <td>{{data.course.name}}</td>
                      <td>{{data.description}}</td>
                      <td>{{data.created_at | myDate}}</td>
					  <td :inner-html.prop="data.status | yesno"></td>
                      <td>

                        <a href="#" @click="editModal(data)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                         |
                        <a href="#" @click="deleteResult(data.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="listData" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New Topic</h5>
                    <h5 class="modal-title" v-show="editmode">Update Topic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateResult() : createResult()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
						 <div class="form-group">

                            <label>Course</label>
                            <select class="form-control" :class="{ 'is-invalid': form.errors.has('course_id') }" v-model="form.course_id">
							 <option value=""  :selected="courses.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in courses" :key="index"
                                  :value="index"
                                  :selected="index == form.course_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="course_id"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
						<div class="form-group">
                            <label>Status</label>
                            <toggle-button  :value="form.status" :sync="true" v-model="form.status" :labels="{checked: 'Yes', unchecked: 'No'}"  />
							
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
				loading: false,
                listData : {},
                form: new Form({
                    id : '',
                    name: '',
					course_id: '',
					status: false,
                    description: '',
                }),
				courses: [],
            }
        },
        methods: {
		
            getResults(page = 1) {
				this.loading = true
                  this.$Progress.start();
                  
                  axios.get('/api/topic?page=' + page).then(({ data }) => {this.listData = data.data;
				  this.loading = false
				  });

                  this.$Progress.finish();
            },
			 loadData(){
				this.loading = true
                if(this.$gate.isAdmin()){
                    axios.get("/api/topic").then(({ data }) => {this.listData = data.data;
					this.loading = false
					});
                }
            },
			
			 courseList(){
				 axios.get("/api/course/list").then(({ data }) => (this.courses = data.data));
          },
            updateResult(){
                this.$Progress.start();
                this.form.put('/api/topic/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadData();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(topic){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
				if(topic.status==1)
				{
				this.form.status = true;
				}
				else
				{
					this.form.status = false;
				}
                this.form.fill(topic);
				
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            createResult(){

                this.form.post('/api/topic')
                .then((response)=>{
                    $('#addNew').modal('hide');

                    Toast.fire({
                            icon: 'success',
                            title: response.data.message
                    });

                    this.$Progress.finish();
                    this.loadData();
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
             deleteResult(id){
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
                              this.form.delete('/api/topic/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadData();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
			this.loadData();
            this.$Progress.start();
            this.courseList();
            this.$Progress.finish();
        }
    }
</script>


