<template>
    <section>
        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
            Product Created successfully.
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Variants</h6>
                    </div>
                    <div class="card-body">
                        <div class="row" v-for="(item,index) in product_variant">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Option</label>
                                    <select v-model="item.option" class="form-control">
                                        <option v-for="variant in variants"
                                                :value="variant.id">
                                            {{ variant.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label v-if="product_variant?.length != 1" @click="product_variant.splice(index,1); checkVariant"
                                           class="float-right text-primary"
                                           style="cursor: pointer;">Remove</label>
                                    <label v-else for="">.</label>
                                    <input-tag v-model="item.tags" @input="checkVariant" class="form-control"></input-tag>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" v-if="product_variant?.length < variants?.length && product_variant?.length < 3">
                        <button @click="newVariant" class="btn btn-primary">Add another option</button>
                    </div>

                    <div class="card-header text-uppercase">Preview</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Variant</td>
                                    <td>Price</td>
                                    <td>Stock</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="variant_price in product_variant_prices">
                                    <td>{{ variant_price.title }}</td>
                                    <td>
                                        <input type="text" class="form-control" v-model="variant_price.price">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" v-model="variant_price.stock">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button @click="saveProduct" type="submit" class="btn btn-lg btn-primary">Save</button>
        <button type="button" class="btn btn-secondary btn-lg">Cancel</button>
    </section>
</template>

<script>
// import InputTag from 'vue-input-tag'

export default {
    // components: {
    //     InputTag
    // },

    data(){
        return {
            variants:[
                {title:"Color"},
                {title:"Size"},
                {title:"Pack"},
            ],
            success:false,
            product_variant_prices:[],
            product_variant: [],
        }
    },

    methods: {
        checkVariant() {
            let tags = [];
            this.product_variant_prices = [];
            this.product_variant.filter((item) => {
                tags.push(item.tags);
            })

            this.getCombn(tags).forEach(item => {
                this.product_variant_prices.push({
                    title: item,
                    price: 0,
                    stock: 0
                })
            })
        },

        newVariant() {
            let all_variants = this.variants.map(el => el.id)
            let selected_variants = this.product_variant.map(el => el.option);
            let available_variants = all_variants.filter(entry1 => !selected_variants.some(entry2 => entry1 == entry2))
            // console.log(available_variants)

            this.product_variant.push({
                option: available_variants[0],
                tags: []
            })
        },
        getCombn(arr, pre) {
            pre = pre || '';
            if (!arr?.length) {
                return pre;
            }
            let self = this;
            let ans = arr[0].reduce(function (ans, value) {
                return ans.concat(self.getCombn(arr.slice(1), pre + value + '/'));
            }, []);
            return ans;
        },
        saveProduct(){
            alert("save product");
        }
    }

/*    data() {
        return {
            product_name: '',
            product_sku: '',
            description: '',
            images: [],
            product_variant: [
                {
                    option: this.variants[0].id,
                    tags: []
                }
            ],
            product_variant_prices: [],
            success: false,
            dropzoneOptions: {
                url: "http://localhost:8000/api/product",
                thumbnailWidth: 150,
                maxFilesize: 2,
                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,
                headers: {"My-Awesome-Header": "header value"}
            }
        }
    },
    methods: {
        uploaded: async function(file,response){
            console.log(response)
        },
        addfile: async function(file){
            // this.images = this.$refs.myVueDropzone.getAcceptedFiles();
            this.images.push(file);
            console.log(this.images)
        },
        // sending: async function(file, xhr, formData){
        //     formData.append('title', this.product_name);
        //     console.log(formData.file)
        // },

        // it will push a new object into product variant
        newVariant() {
            let all_variants = this.variants.map(el => el.id)
            let selected_variants = this.product_variant.map(el => el.option);
            let available_variants = all_variants.filter(entry1 => !selected_variants.some(entry2 => entry1 == entry2))
            // console.log(available_variants)

            this.product_variant.push({
                option: available_variants[0],
                tags: []
            })
        },

        // check the variant and render all the combination
        checkVariant() {
            let tags = [];
            this.product_variant_prices = [];
            this.product_variant.filter((item) => {
                tags.push(item.tags);
            })

            this.getCombn(tags).forEach(item => {
                this.product_variant_prices.push({
                    title: item,
                    price: 0,
                    stock: 0
                })
            })
        },

        // combination algorithm
        getCombn(arr, pre) {
            pre = pre || '';
            if (!arr.length) {
                return pre;
            }
            let self = this;
            let ans = arr[0].reduce(function (ans, value) {
                return ans.concat(self.getCombn(arr.slice(1), pre + value + '/'));
            }, []);
            return ans;
        },

        // store product into database
        saveProduct() {
            console.log(this.product_variant)

            let product = new FormData();
            product.append('title', this.product_name);
            product.append('sku', this.product_sku);
            product.append('description', this.description);
            for (let x = 0; x < this.images.length; x++){
                product.append('product_image[]', this.images[x]);
            }
            for (let x = 0; x < this.product_variant.length; x++){
                product.append('product_variant[]', JSON.stringify(this.product_variant[x]));
            }
            for (let x = 0; x < this.product_variant_prices.length; x++){
                product.append('product_variant_prices[]', JSON.stringify(this.product_variant_prices[x]));
            }

            // let product = {
            //     title: this.product_name,
            //     sku: this.product_sku,
            //     description: this.description,
            //     product_image: this.images,
            //     product_variant: this.product_variant,
            //     product_variant_prices: this.product_variant_prices
            // }

            console.log(product)

            axios.post('/product', product).then(response => {
                this.success = true;
                setTimeout(() => {
                    this.success = false;
                }, 3000);
                console.log(response.data);
            }).catch(error => {
                this.success = false;
                console.log(error);
            })
        },

    },
    mounted() {
        console.log('Component mounted.')
    },*/
}
</script>
