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
                <h3 class="card-title">Questions And AnswersList</h3>

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
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Video</th>
                    <th>Question</th>
                    <th>Option A</th>
                    <th>Option B</th>
                    <th>Option C</th>
                    <th>Option D</th>
                    <th>Right Answer</th>
                    <th>Created</th>
                    <th>Action</th>
                    </tr>
                    <tr>
                    <th><select class="form-control" @change="loadTopics(c_id)"   v-model="c_id" >
							 <option value=""  :selected="courses.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in courses" :key="index"
                                  :value="index"
                                  :selected="index == form.course_id">{{ cat }}</option>
                            </select></th>
                    <th><select class="form-control" v-model="t_id" >
                             <option value="" >Select</option>
								  <option  
                                  v-for="(cat,index) in topics" :key="index"
                                  :value="index"
                                  :selected="index == form.topic_id">{{ cat }}</option>
                            </select></th>
                    <th></th>
                    <th><input v-model="v_name" type="text" name="v_name" class="form-control" ></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="qa in questions.data" :key="qa.id">

                      <td>{{qa.course.name}}</td>
                      <td>{{qa.topic.name}}</td>
                      <td>{{qa.video.name}}</td>
                      <td class="text-capitalize">{{qa.question}}</td>
					   <td>{{qa.ans1}}</td>
                       <td>{{qa.ans2}}</td>
                       <td>{{qa.ans3}}</td>
                       <td>{{qa.ans4}}</td>
                       <td><span class="badge badge-success">{{qa.rightans}}</span></td>
                      <td>{{qa.created_at | myDate}}</td>
                      <td>

                        <a href="javascript:;" @click="editModal(qa)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                         |
                        <a href="javascript:;" @click="deleteData(qa.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="questions" @pagination-change-page="getResults"></pagination>
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
            <div class="modal-dialog" role="document" style="max-width:835px">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New</h5>
                    <h5 class="modal-title" v-show="editmode">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateData() : createData()">
                    <div class="modal-body">
                        <div class="row">
						 <div class="form-group col-md-6">

                            <label>Course</label>
                            <select class="form-control" @change="loadTopics(form.course_id)" :class="{ 'is-invalid': form.errors.has('course_id') }"  v-model="form.course_id" enctype="multipart/form-data">
							 <option value=""  :selected="courses.length == 0">Select</option>
                              <option 
                                  v-for="(cat,index) in courses" :key="index"
                                  :value="index"
                                  :selected="index == form.course_id">{{ cat }}</option>
                            </select>
							<has-error :form="form" field="course_id"></has-error>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Topic</label>
                            <select class="form-control" v-model="form.topic_id" :class="{ 'is-invalid': form.errors.has('topic_id') }">
                             <option value="" >Select</option>
								  <option  
                                  v-for="(cat,index) in topics" :key="index"
                                  :value="index"
                                  :selected="index == form.topic_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="topic_id"></has-error>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Video</label>
                            <select class="form-control" v-model="form.video_id" :class="{ 'is-invalid': form.errors.has('video_id') }">
                             <option value="" >Select</option>
								  <option  
                                  v-for="(cat,index) in topics" :key="index"
                                  :value="index"
                                  :selected="index == form.video_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="video_id"></has-error>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Question</label>
                            <input v-model="form.question" type="text" name="question"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('question') }">
                           <has-error :form="form" field="question"></has-error>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Option A</label>
                            <input v-model="form.ans1" type="text" name="ans1"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('ans1') }">
                            <has-error :form="form" field="ans1"></has-error>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Option B</label>
                            <input v-model="form.ans2" type="text" name="ans2"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('ans2') }">
                            <has-error :form="form" field="ans2"></has-error>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Option C</label>
                            <input v-model="form.ans3" type="text" name="ans3"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('ans3') }">
                            <has-error :form="form" field="ans3"></has-error>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Option D</label>
                            <input v-model="form.ans4" type="text" name="ans4"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('ans4') }">
                            <has-error :form="form" field="ans4"></has-error>
                        </div>
                        <div class="form-group col-md-4">

                            <label>Right Answer</label>
                            <select class="form-control" v-model="form.rightans" :class="{ 'is-invalid': form.errors.has('rightans') }">
                              <option value="" :selected="'' == form.rightans">Select</option>
                              <option value="A" :selected="'A' == form.rightans">A</option>
							  <option value="B" :selected="'B' == form.rightans">B</option>
                              <option value="C" :selected="'C' == form.rightans">C</option>
                              <option value="D" :selected="'D' == form.rightans">D</option>
                            </select>
                            <has-error :form="form" field="rightans"></has-error>
                        </div>
                        
                    </div>
                    
                    	<div class="form-group col-md-12">
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
                questions : {},
                  v_name:'',
                c_id:'',
                t_id:'',
                form: new Form({
                    id : '',
                    course_id: '',
					topic_id: '',
                    video_id: '',
                    question: '',
					ans1: '',
                    ans2: '',
                    ans3: '',
                    ans4: '',
                    rightans: '',
                    status: false,
                }),
				 courses: [],
                topics: [],
            }
        },
        methods: {

            getResults(page = 1) {
				this.loading = true
                  this.$Progress.start();
                  
                  axios.get('/api/questions?page=' + page,{ params: {v_name: this.v_name,c_id: this.c_id,t_id: this.t_id}}).then(({ data }) => {this.questions = data.data;
				  this.loading = false
				  });

                  this.$Progress.finish();
            },
			loadCourses(){
			
              axios.get("/api/course/list").then(({ data }) => (this.courses = data.data));
            },
            loadTopics(id){
			  this.form.topic_id = '';
              this.t_id ='';
				return axios.get("/api/topics/bycourse?course="+id, {
				}).then(({ data }) => {
				this.topics = data.data
				return data.data
				});
          },
		  
			async chieldCategorySelect(){
				
				 let question = this.editVideo;
				
				 let vl = await this.loadTopics(question.course_id);
				 let catCheck = false;
			   _.each(this.topics, (value, key) => {
				  if(key==question.topic_id){
						catCheck = true;
				  } 
				});
			  
			  this.form.topic_id = '';
			  if(catCheck){
				  this.form.topic_id = question.topic_id;
			  } 
			},
            updateData(){
                this.$Progress.start();
                this.form.put('/api/questions/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.getResults();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
             async editModal(question){
			  
              this.editmode = true;
              this.form.reset();
              if(question.status==1)
				{
				question.status = true;
				}
				else
				{
				question.status = false;
				}
                this.form.fill(question);
			  this.editVideo = question;
			  this.chieldCategorySelect();
				
			  $('#addNew').modal('show');
			  //console.log(product);
          },
          newModal(){
              this.editmode = false;
			  this.allerros = [];
              this.form.reset();
              $('#addNew').modal('show');
          },
            
            createData(){

                this.form.post('/api/questions')
                .then((response)=>{
                    $('#addNew').modal('hide');

                    Toast.fire({
                            icon: 'success',
                            title: response.data.message
                    });

                    this.$Progress.finish();
                    this.getResults();
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
             deleteData(id){
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
                              this.form.delete('/api/videos/'+id).then(()=>{
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

        },
        mounted() {
           this.getResults();
        },
    watch: {
        v_name(after, before) {
            this.getResults();
        },
        c_id(after, before) {
            this.getResults();
        },
        t_id(after, before) {
            this.getResults();
        }
    },
        created() {

            this.$Progress.start();
             this.getResults();
            this.loadCourses();
            this.$Progress.finish();
        }
    }
</script>


