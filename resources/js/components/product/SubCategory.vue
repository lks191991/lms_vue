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
                <h3 class="card-title">Sub Category List</h3>

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
                      <th>ID</th>
                      <th>Name</th>
					  <th>Category</th>
                      <th>Description</th>
                      <th>Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="subcategory in categories.data" :key="subcategory.id">

                      <td>{{subcategory.id}}</td>
                      <td class="text-capitalize">{{subcategory.name}}</td>
					   <td>{{subcategory.category.name}}</td>
                      <td>{{subcategory.description}}</td>
                      <td>{{subcategory.created_at | myDate}}</td>
                      <td>

                        <a href="#" @click="editModal(subcategory)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                         |
                        <a href="#" @click="deleteCategory(subcategory.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="categories" @pagination-change-page="getResults"></pagination>
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
                    <h5 class="modal-title" v-show="!editmode">Create New Sub Category</h5>
                    <h5 class="modal-title" v-show="editmode">Update Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form @submit.prevent="createUser"> -->

                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
						 <div class="form-group">

                            <label>Category</label>
                            <select class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" v-model="form.category_id">
                              <option 
                                  v-for="(cat,index) in pcategories" :key="index"
                                  :value="index"
                                  :selected="index == form.category_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
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
                categories : {},
                form: new Form({
                    id : '',
                    name: '',
					category_id: '',
                    description: '',
                }),
				pcategories: [],
            }
        },
        methods: {

            getResults(page = 1) {
				this.loading = true
                  this.$Progress.start();
                  
                  axios.get('/api/subcategory?page=' + page).then(({ data }) => {this.categories = data.data;
				  this.loading = false
				  });

                  this.$Progress.finish();
            },
			loadPCategories(){
              axios.get("/api/category/list").then(({ data }) => (this.pcategories = data.data));
			},
            updateCategory(){
                this.$Progress.start();
                this.form.put('/api/subcategory/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');

                    this.loadCategories();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(category){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(category);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadCategories(){
				this.loading = true
                if(this.$gate.isAdmin()){
                    axios.get("/api/subcategory").then(({ data }) => {this.categories = data.data;
					this.loading = false
					});
                }
            },
            
            createCategory(){

                this.form.post('/api/subcategory')
                .then((response)=>{
                    $('#addNew').modal('hide');

                    Toast.fire({
                            icon: 'success',
                            title: response.data.message
                    });

                    this.$Progress.finish();
                    this.loadCategories();
                })
                .catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
             deleteCategory(id){
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
                              this.form.delete('/api/subcategory/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadCategories();
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

            this.$Progress.start();
            this.loadCategories();
            this.$Progress.finish();
			 this.loadPCategories();
        }
    }
</script>


