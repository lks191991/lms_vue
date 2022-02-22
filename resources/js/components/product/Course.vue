<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Courses List</h3>

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
                      <th>Description</th>
                      <th>Category</th>
					  <th>Sub Category</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="product in products.data" :key="product.id">

                      <td>{{product.id}}</td>
                      <td>{{product.name}}</td>
                      <td>{{product.description | truncate(30, '...')}}</td>
                      <td>{{product.category.name}}</td>
					  <td>{{product.subcategory.name}}</td>
                      <td>{{product.price}}</td>
                      <!-- <td><img v-bind:src="'/' + product.photo" width="100" alt="product"></td> -->
                      <td>
                        
                        <a href="#" @click="editModal(product)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteProduct(product.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width:835px">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Create New Course</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form @submit.prevent="editmode ? updateCourse() : createCourse()">
                    <div class="modal-body">
					
					<div class="row">
					<div class="form-group col-md-6">

                            <label>Category</label>
                            <select class="form-control" @change="loadSubCategories(form.category_id)" :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id" enctype="multipart/form-data">
                              <option 
                                  v-for="(cat,index) in categories" :key="index"
                                  :value="index"
                                  :selected="index == form.category_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="category_id"></has-error>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Sub Category</label>
                            <select class="form-control" v-model="form.sub_category_id" :class="{ 'is-invalid': form.errors.has('sub_category_id') }">
                              <option 
                                  v-for="(cat,index) in subcategories" :key="index"
                                  :value="index"
                                  :selected="index == form.sub_category_id">{{ cat }}</option>
                            </select>
                            <has-error :form="form" field="sub_category_id"></has-error>
                        </div>
					
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                       
                        <div class="form-group col-md-3">
                            <label>Price</label>
                            <input v-model="form.price" type="text" name="price"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                            <has-error :form="form" field="price"></has-error>
                        </div>
						
						<div class="form-group col-md-3">

                            <label>Course Type</label>
                            <select class="form-control" v-model="form.course_type" :class="{ 'is-invalid': form.errors.has('course_type') }">
                              <option value="Certified" :selected="'Certified' == form.course_type">Certified</option>
							  <option value="Non-certified" :selected="'Non-certified' == form.course_type">Non-certified</option>
                            </select>
                            <has-error :form="form" field="course_type"></has-error>
                        </div>
						<div class="form-group col-md-12">
                            <label>Demo URL</label>
                            <input v-model="form.demo_url" type="text" name="demo_url"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('demo_url') }">
                            <has-error :form="form" field="demo_url"></has-error>
                        </div>
						<div class="form-group col-md-8">
                            <label>Image</label>
                            <input type="file"  v-on:change="onImageChange" :class="{ 'is-invalid': form.errors.has('banner_image') }" name="banner_image">
                        <has-error :form="form" field="banner_image"></has-error> 
						
						
                        
                        </div>
						 <div class="form-group col-md-4">
                            <img v-bind:src="imagePreview" width="50" height="50" v-show="showPreview"/>
                        </div>
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
    import VueTagsInput from '@johmun/vue-tags-input';

    export default {
      components: {
          VueTagsInput,
        },
        data () {
            return {
                editmode: false,
                products : {},
                form: new Form({
                    id : '',
                    category_id : '',
					sub_category_id : '',
                    name: '',
					price: '',
					course_type: '',
					demo_url: '',
                    description: '',
                    banner_image: null,
                   	status: '',

                }),
                categories: [],
				subcategories: [],
                imagePreview: null,
				showPreview: false,
            }
        },
        methods: {
			onImageChange(event){
    /*
    Set the local file variable to what the user has selected.
    */
    this.form.banner_image = event.target.files[0];

    /*
    Initialize a File Reader object
    */
    let reader  = new FileReader();

    /*
    Add an event listener to the reader that when the file
    has been loaded, we flag the show preview as true and set the
    image to be what was read from the reader.
    */
    reader.addEventListener("load", function () {
        this.showPreview = true;
        this.imagePreview = reader.result;
    }.bind(this), false);

    /*
    Check to see if the file is not empty.
    */
    if( this.form.banner_image ){
        /*
            Ensure the file is an image file.
        */
        if ( /\.(jpe?g|png|gif)$/i.test( this.form.banner_image.name ) ) {

            console.log("here");
            /*
            Fire the readAsDataURL method which will read the file in and
            upon completion fire a 'load' event which we will listen to and
            display the image in the preview.
            */
            reader.readAsDataURL( this.form.banner_image );
        }
    }
},
          getResults(page = 1) {

              this.$Progress.start();
              
              axios.get('api/course?page=' + page).then(({ data }) => (this.products = data.data));

              this.$Progress.finish();
          },
          loadProducts(){

            // if(this.$gate.isAdmin()){
              axios.get("api/course").then(({ data }) => (this.products = data.data));
            // }
          },
          loadCategories(){
              axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
          },
		  loadSubCategories(id){
				axios.get("/api/sub-category/bycategory?category="+id, {
				}).then(({ data }) => (this.subcategories = data.data));
          },
          
          editModal(product){
              this.editmode = true;
              this.form.reset();
              $('#addNew').modal('show');
              this.form.fill(product);
          },
          newModal(){
              this.editmode = false;
              this.form.reset();
              $('#addNew').modal('show');
          },
          createCourse(){
              this.$Progress.start();
				let formData = new FormData()
				formData.append('banner_image', this.form.banner_image)

				_.each(this.form, (value, key) => {
				formData.append(key, value)
				})
              axios.post('api/course',formData)
              .then((data)=>{
                if(data.data.success){
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: data.data.message
                    });
                  this.$Progress.finish();
                  this.loadProducts();

                } else {
                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });

                  this.$Progress.failed();
                }
              })
              .catch(()=>{

                  Toast.fire({
                      icon: 'error',
                      title: 'Some error occured! Please try again'
                  });
              })
          },
          updateCourse(){
              this.$Progress.start();
              this.form.put('api/course/'+this.form.id)
              .then((response) => {
                  // success
                  $('#addNew').modal('hide');
                  Toast.fire({
                    icon: 'success',
                    title: response.data.message
                  });
                  this.$Progress.finish();
                      //  Fire.$emit('AfterCreate');

                  this.loadProducts();
              })
              .catch(() => {
                  this.$Progress.fail();
              });

          },
          deleteProduct(id){
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
                              this.form.delete('api/course/'+id).then(()=>{
                                      Swal.fire(
                                      'Deleted!',
                                      'Your file has been deleted.',
                                      'success'
                                      );
                                  // Fire.$emit('AfterCreate');
                                  this.loadProducts();
                              }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                        }
                  })
          },

        },
        mounted() {
            
        },
        created() {
            this.$Progress.start();

            this.loadProducts();
            this.loadCategories();
            this.$Progress.finish();
        },
        filters: {
            truncate: function (text, length, suffix) {
                return text.substring(0, length) + suffix;
            },
        },
        computed: {
          
        },
    }
</script>
