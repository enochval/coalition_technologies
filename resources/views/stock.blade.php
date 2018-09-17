<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coalition Technologies</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app" class="container mt-5">
    <div class="card">
        <h5 class="card-header">Create Stock</h5>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group">
                            <input type="text" v-model="editedItem.product_name" class="form-control" placeholder="Product name" value="" />
                        </div>
                        <div class="form-group">
                            <input type="number" v-model="editedItem.quantity_in_stock" class="form-control" placeholder="Quantity in stock" value="" />
                        </div>
                        <div class="form-group">
                            <input type="number" v-model="editedItem.price_per_item" class="form-control" placeholder="Price per item" value="" />
                        </div>
                        <div class="form-group">
                            <input type="button" class="btn btn-outline-primary" @click="submit" value="Submit Record" />
                            <input type="button" class="btn btn-outline-warning" @click="close" value="Cancel" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <h5 class="card-header">Stock Records</h5>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity in Stock</th>
                    <th scope="col">Price Per Item ($)</th>
                    <th scope="col">DateTime Submitted</th>
                    <th scope="col">Total Value Number ($)</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody v-if="stocks.length > 0">
                <tr v-for="stock in stocks">
                    <th scope="row">@{{ stock.id }}</th>
                    <td>@{{ stock.product_name }}</td>
                    <td>@{{ stock.quantity_in_stock }}</td>
                    <td>@{{ stock.price_per_item }}</td>
                    <td>@{{ stock.created_at }}</td>
                    <td>@{{ stock.total_value_number.toLocaleString() }}</td>
                    <td @click="edit(stock)"><i class="ml-3 fas fa-marker"></i></td>
                </tr>

                <tr>
                    <th colspan="5">Sum of Total Value Numbers</th>
                    <td>@{{ totalValueNumber.toLocaleString() }}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
