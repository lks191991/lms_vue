<template>
  <section class="content">
  <div  class="loader-out" v-if="loading">
   <div  class="loader"  ></div>
   </div>
    <div class="container-fluid">
        <div class="row">

          <div class="col-12">
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Courses List</h3>

                <div class="card-tools">
                  
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
					  <th>Total Watched Hours</th>
					
                    </tr>
                  </thead>
                  <tbody>
                     <tr v-for="product in products" :key="product.id">
                      <td>{{product.name}}</td>
                     <td>{{product.avg}}</td>
                      
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

        <!-- Modal -->

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
				loading: false,
                editProduct : [],
                
				allerros: [],
                categories: [],
				subcategories: [],
                imagePreview: null,
				showPreview: false,
				 imageEditPreview: null,
				showEditPreview: false,
				
            }
        },
        methods: {
         
		   loadData(){
				this.loading = true
                if(this.$gate.isAdmin()){
                    axios.get("/api/course-watch-hours").then(({ data }) => {this.products = data.data;
					this.loading = false
					});
                }
            },
          
        },
        mounted() {
        },
        created() {
            this.$Progress.start();

            this.loadData();
            this.$Progress.finish();
			
        },
        filters: {
            truncate: function (text, length, suffix) {
                return ''//text.substring(0, length) + suffix;
            },
        },
        computed: {
          
        },
    }
</script>
