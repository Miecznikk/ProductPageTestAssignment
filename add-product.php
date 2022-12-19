<?php
    include 'includes/autoloader.inc.php';
    $store = new Store();
    if($_POST){
        $store->post_product($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Add Product</title>
</head>
<body style="background-color:hsl(0, 0%, 95%);">
    <div id="app" v-cloak>
        <nav class="shadow navbar navbar-expand-lg navbar-dark bg-dark w-100" style="z-index:2;position:fixed;top:0;left:0;">
            <div class="container-fluid ms-2">
                <span class="navbar-brand fw-bold" style="font-size:1.6rem">ADD PRODUCT</span>
            </div>
            <div class="d-flex me-4">
                <a href="." class="btn btn-outline-success text-nowrap">PRODUCT LIST</a>
            </div>
        </nav>
    
        <div class="container mt-4 mb-5 text-center" style="padding-top:80px;">
            <form @submit.prevent="validate_form()" ref="product_form" id="product_form" method="post" class="shadow m-auto row g-3 w-50" style="background-color:#fff;padding:1rem 2rem 2.5rem 2rem;border-radius:8px;">
                <h3 class="fw-bold">ADD PRODUCT</h3>
                <div class="col-12">
                    <label for="sku" class="form-label">
                        <span v-if="SKUIsValid">SKU</span>
                        <span v-else class="text-danger">SKU already exists or not valid (at least 4 characters)</span>
                    </label>
                    <input :class="{inValid: !SKUIsValid}" class="form-control" v-model="SKU" type="text" name="SKU" id="sku" placeholder="Enter at least 4 characters" required>
                </div>
                <div class="col-12">
                    <label for="name" class="form-label">
                        <span v-if="nameIsValid">Name</span>
                        <span v-else class="text-danger">Name not valid (at least 3 characters)</span>
                    </label>
                    <input :class="{inValid: !nameIsValid}" class="form-control" v-model="name" type="text" name="name" id="name" placeholder="Enter at least 3 characters" required>

                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">
                        <span v-if="priceIsValid">Price</span>
                        <span v-else class="text-danger">Please enter valid price</span>
                    </label>
                    <input :class="{inValid: !priceIsValid}" class="form-control" v-model="price" type="number" step="0.01" name="price" id="price" placeholder="Enter product's price" required>
                </div>
                <div class="col-md-6">
                    <label for="productType" class="form-label">Select Product type</label>
                    <select class="form-select text-dark" v-model="type" id="productType" name="opt" required>
                        <option value="">---</option>
                        <option value="DVD">DVD</option>
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
                <div class="col-12" v-if="type==='Book'">
                    <label for="weight" class="form-label">
                        <span v-if="weightIsValid">Weight</span>
                        <span v-else class="text-danger">Please enter valid weight</span>
                    </label>
                    <input :class="{inValid: !weightIsValid}" class="form-control" v-model="weight" name="weight" id="weight" type="number" step="0.01" placeholder="Please enter book weight in kg" required>
                </div>
                <div class="col-12" v-else-if="type==='DVD'">
                    <label for="size" class="form-label">
                        <span v-if="sizeIsValid">Size</span>
                        <span v-else class="text-danger">Please enter valid size</span>
                    </label>
                    <input :class="{inValid: !sizeIsValid}" class="form-control" v-model="size" name="size" id="size" type="number" step=0.001 placeholder="Please enter DVD size in MB" required>
                </div>
                    
                    <div v-if="type==='Furniture'" class="col-md-4">
                        <label for="height">
                            <span v-if="heightIsValid">Height</span>
                            <span v-else class="text-danger">Please enter valid height</span>
                        </label>
                        <input :class="{inValid:!heightIsValid}" class="form-control" v-model="height" name="height" type="number" step="0.01" placeholder="Enter height" required>
                    </div>
                    <div v-if="type==='Furniture'" class="col-md-4">
                        <label for="width">
                            <span v-if="widthIsValid">Width</span>
                            <span v-else class="text-danger">Please enter valid width</span>
                        </label>    
                        <input :class="{inValid:!widthIsValid}" class="form-control"v-model="width" name="width" type="number" step="0.01" placeholder="Enter width" required>
                    </div>
                    <div v-if="type==='Furniture'" class="col-md-4">
                            <label for="length">
                                <span v-if="lengthIsValid">Length</span>
                                <span v-else class="text-danger">Please enter valid length</span>
                            </label>   
                            <input :class="{inValid:!lengthIsValid}" class="form-control"v-model="length" name="length" type="number" step="0.01" placeholder="Enter length" required>
                
                    </div>
                    <div class="col-12 mt-4">
                        <button class="btn btn-success" type="submit" form="product_form">SAVE</button>
                        <a href="." class="btn btn-danger ms-2">CANCEL</a>
                    </div>
            </form>
        </div>
    </div>
        <?php
            include "includes/footer.inc.php";
        ?>
</body>
</html>
<style>
    [v-cloak]{
        display:none;
    }
</style>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const {createApp} = Vue;

    createApp({
        data(){
            return {
                SKU:'',
                SKUIsValid:true,
                name:'',
                nameIsValid:true,
                price:'',
                priceIsValid:true,
                type:'',
                typeIsValid:true,

                size:'',
                sizeIsValid:true,
                weight:'',
                weightIsValid:true,

                height:'',
                heightIsValid:true,
                width:'',
                widthIsValid:true,
                length:'',
                lengthIsValid:true,
                
                existing_sku: <?php
                    echo json_encode($store->existing_sku());
                ?>

                }
            },
        methods:{
            validate_form(){
                let formIsValid = false;

                this.SKUIsValid = this.SKU.length >= 4 && !(this.existing_sku.find(el => el == this.SKU) == this.SKU)
                
                this.nameIsValid = this.name.length >= 3;
                this.priceIsValid = this.price > 0;
                this.typeIsValid = this.type != '';

                switch(this.type){
                    case 'Book':
                        this.weightIsValid = this.weight > 0;
                        formIsValid = this.SKUIsValid && this.nameIsValid && this.priceIsValid && this.weightIsValid;
                        break;
                    case 'DVD':
                        this.sizeIsValid = this.size > 0;
                        formIsValid = this.SKUIsValid && this.nameIsValid && this.priceIsValid && this.sizeIsValid;
                        break;
                    case 'Furniture':
                        this.heightIsValid = this.height >0;
                        this.widthIsValid = this.width > 0;
                        this.lengthIsValid = this.length > 0;
                        formIsValid =  this.SKUIsValid && this.nameIsValid && this.priceIsValid && this.heightIsValid && this.widthIsValid && this.lengthIsValid;
                        break;
                    default:
                        break;
                }
                if(formIsValid){
                    this.$refs.product_form.submit();
                }
            },
            reset(){
                this.type='';
            },
            border(val){
                return val ? '1px solid red' : '1px solid black';
            }
        }
    }).mount('#app')
</script>

